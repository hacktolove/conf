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
        foreach ($request->settings as $key => $value) {
            if ($request->hasFile("settings.$key")) {
                $file = $request->file("settings.$key");
                $value = $file->store('settings', 'public');
                SiteSetting::set($key, $value, 'image', 'general');
                Cache::forget('setting_' . $key);
            } elseif ($value !== null && $value !== '') {
                // Only update text settings, skip file inputs that weren't uploaded
                if (!in_array($key, ['site_logo'])) {
                    SiteSetting::set($key, $value);
                }
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
