<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Get all setting keys from both English and Arabic inputs
        $allKeys = array_unique(array_merge(
            array_keys($request->settings ?? []),
            array_keys($request->settings_ar ?? [])
        ));

        foreach ($allKeys as $key) {
            if ($request->hasFile("settings.$key")) {
                $file = $request->file("settings.$key");
                $value = $file->store('settings', 'public');
                SiteSetting::set($key, $value, 'image', 'general');
                Cache::forget('setting_' . $key);
            } elseif (!in_array($key, ['site_logo'])) {
                // Handle text settings
                $value = $request->input("settings.$key");
                $valueAr = $request->input("settings_ar.$key", null);
                
                // Convert datetime-local format (Y-m-d\TH:i) to datetime format (Y-m-d H:i:s) for storage
                if ($key === 'speaker_reveal_date' && $value) {
                    $value = date('Y-m-d H:i:s', strtotime($value));
                }
                
                // Allow empty values for speaker_reveal_speaker_id and speaker_reveal_date to allow clearing
                $allowEmpty = in_array($key, ['speaker_reveal_speaker_id', 'speaker_reveal_date']);
                
                // Determine the type based on the key
                $settingType = ($key === 'speaker_reveal_date') ? 'datetime' : 'text';
                
                // Only update if at least one value is provided, or if empty values are allowed
                if ($allowEmpty || ($value !== null && $value !== '')) {
                    SiteSetting::set($key, $value ?? '', $settingType, 'general', $valueAr);
                } elseif ($valueAr !== null && $valueAr !== '') {
                    // Update only Arabic if English is empty but Arabic is provided
                    $existing = SiteSetting::where('key', $key)->first();
                    $existingValue = $existing ? $existing->value : '';
                    SiteSetting::set($key, $existingValue, $settingType, 'general', $valueAr);
                }
            }
        }

        Cache::flush();
        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
