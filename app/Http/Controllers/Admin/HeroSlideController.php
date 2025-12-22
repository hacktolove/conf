<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('order')->paginate(15);
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'subtitle_ar' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'button_text' => 'nullable|string|max:100',
            'button_text_ar' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'button_text_2' => 'nullable|string|max:100',
            'button_text_2_ar' => 'nullable|string|max:100',
            'button_link_2' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'is_selected' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_selected'] = $request->boolean('is_selected');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('hero', 'public');
        }

        // If this slide is being selected, deselect all others
        if ($validated['is_selected']) {
            HeroSlide::query()->update(['is_selected' => false]);
        }

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide created successfully.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'subtitle_ar' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'button_text' => 'nullable|string|max:100',
            'button_text_ar' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'button_text_2' => 'nullable|string|max:100',
            'button_text_2_ar' => 'nullable|string|max:100',
            'button_link_2' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'is_selected' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_selected'] = $request->boolean('is_selected');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('hero', 'public');
        }

        // If this slide is being selected, deselect all others
        if ($validated['is_selected']) {
            HeroSlide::where('id', '!=', $heroSlide->id)->update(['is_selected' => false]);
        }

        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $heroSlide->delete();
        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide deleted successfully.');
    }

    public function select(HeroSlide $heroSlide)
    {
        // Deselect all other slides
        HeroSlide::where('id', '!=', $heroSlide->id)->update(['is_selected' => false]);
        
        // Select this slide
        $heroSlide->update(['is_selected' => true]);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide selected successfully.');
    }
}
