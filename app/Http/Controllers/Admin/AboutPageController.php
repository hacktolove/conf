<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AboutPageController extends Controller
{
    public function index()
    {
        return view('admin.about-page.edit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'about_page_title' => 'nullable|string|max:255',
            'about_page_title_ar' => 'nullable|string|max:255',
            'about_page_subtitle' => 'nullable|string|max:500',
            'about_page_subtitle_ar' => 'nullable|string|max:500',
            'about_page_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_badge_text' => 'nullable|string|max:255',
            'about_badge_text_ar' => 'nullable|string|max:255',
            'about_value_innovation_title' => 'nullable|string|max:255',
            'about_value_innovation_title_ar' => 'nullable|string|max:255',
            'about_value_innovation_description' => 'nullable|string|max:1000',
            'about_value_innovation_description_ar' => 'nullable|string|max:1000',
            'about_value_innovation_icon' => 'nullable|string|max:100',
            'about_value_community_title' => 'nullable|string|max:255',
            'about_value_community_title_ar' => 'nullable|string|max:255',
            'about_value_community_description' => 'nullable|string|max:1000',
            'about_value_community_description_ar' => 'nullable|string|max:1000',
            'about_value_community_icon' => 'nullable|string|max:100',
            'about_value_excellence_title' => 'nullable|string|max:255',
            'about_value_excellence_title_ar' => 'nullable|string|max:255',
            'about_value_excellence_description' => 'nullable|string|max:1000',
            'about_value_excellence_description_ar' => 'nullable|string|max:1000',
            'about_value_excellence_icon' => 'nullable|string|max:100',
        ]);

        // Handle image upload
        if ($request->hasFile('about_page_image')) {
            $imagePath = $request->file('about_page_image')->store('about', 'public');
            SiteSetting::set('about_page_image', $imagePath, 'image', 'about');
            Cache::forget('setting_about_page_image');
        }

        // Update text fields
        $textFields = [
            'about_page_title',
            'about_page_subtitle',
            'about_badge_text',
            'about_value_innovation_title',
            'about_value_innovation_description',
            'about_value_innovation_icon',
            'about_value_community_title',
            'about_value_community_description',
            'about_value_community_icon',
            'about_value_excellence_title',
            'about_value_excellence_description',
            'about_value_excellence_icon',
        ];

        foreach ($textFields as $field) {
            $value = $request->input($field);
            $valueAr = $request->input($field . '_ar', null);
            
            if ($value !== null || $valueAr !== null) {
                SiteSetting::set($field, $value ?? '', 'text', 'about', $valueAr);
                Cache::forget('setting_' . $field);
            }
        }

        SiteSetting::clearCache();
        
        return redirect()->route('admin.about-page.index')->with('success', 'About page content updated successfully.');
    }
}

