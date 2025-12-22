<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::orderBy('order')->paginate(15);
        return view('admin.pricing-plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.pricing-plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'duration' => 'nullable|string|max:100',
            'duration_ar' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'features_ar' => 'nullable|array',
            'features_ar.*' => 'string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'button_text' => 'nullable|string|max:100',
            'button_text_ar' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['features'] = array_filter($request->input('features', []));
        if ($request->has('features_ar')) {
            $validated['features_ar'] = array_filter($request->input('features_ar', []));
        }

        PricingPlan::create($validated);

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing plan created successfully.');
    }

    public function edit(PricingPlan $pricingPlan)
    {
        return view('admin.pricing-plans.edit', compact('pricingPlan'));
    }

    public function update(Request $request, PricingPlan $pricingPlan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'duration' => 'nullable|string|max:100',
            'duration_ar' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'features_ar' => 'nullable|array',
            'features_ar.*' => 'string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'button_text' => 'nullable|string|max:100',
            'button_text_ar' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['features'] = array_filter($request->input('features', []));
        if ($request->has('features_ar')) {
            $validated['features_ar'] = array_filter($request->input('features_ar', []));
        }

        $pricingPlan->update($validated);

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing plan updated successfully.');
    }

    public function destroy(PricingPlan $pricingPlan)
    {
        $pricingPlan->delete();
        return redirect()->route('admin.pricing-plans.index')->with('success', 'Pricing plan deleted successfully.');
    }
}
