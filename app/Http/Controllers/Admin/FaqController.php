<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->paginate(15);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'question_ar' => 'nullable|string|max:500',
            'answer' => 'required|string',
            'answer_ar' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'category_ar' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'question_ar' => 'nullable|string|max:500',
            'answer' => 'required|string',
            'answer_ar' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'category_ar' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
