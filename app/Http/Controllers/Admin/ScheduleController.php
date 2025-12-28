<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Event;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['event', 'speakers'])->orderBy('schedule_date')->orderBy('start_time')->paginate(15);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $events = Event::active()->orderBy('title')->get();
        $speakers = Speaker::active()->orderBy('name')->get();
        return view('admin.schedules.create', compact('events', 'speakers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'speaker_ids' => 'nullable|array',
            'speaker_ids.*' => 'exists:speakers,id',
            'title' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'schedule_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'venue' => 'nullable|string|max:255',
            'venue_ar' => 'nullable|string|max:255',
            'day_label' => 'nullable|string|max:100',
            'day_label_ar' => 'nullable|string|max:100',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'allow_download' => 'boolean',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['allow_download'] = $request->boolean('allow_download');

        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = $request->file('pdf_file')->store('schedules/pdfs', 'public');
        }

        $schedule = Schedule::create($validated);
        
        // Sync speakers
        $schedule->speakers()->sync($request->input('speaker_ids', []));

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $events = Event::active()->orderBy('title')->get();
        $speakers = Speaker::active()->orderBy('name')->get();
        $schedule->load('speakers');
        return view('admin.schedules.edit', compact('schedule', 'events', 'speakers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'speaker_ids' => 'nullable|array',
            'speaker_ids.*' => 'exists:speakers,id',
            'title' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'schedule_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'venue' => 'nullable|string|max:255',
            'venue_ar' => 'nullable|string|max:255',
            'day_label' => 'nullable|string|max:100',
            'day_label_ar' => 'nullable|string|max:100',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'allow_download' => 'boolean',
            'remove_pdf' => 'boolean',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['allow_download'] = $request->boolean('allow_download');

        // Handle PDF file upload
        if ($request->hasFile('pdf_file')) {
            // Delete old PDF if exists
            if ($schedule->pdf_file && Storage::disk('public')->exists($schedule->pdf_file)) {
                Storage::disk('public')->delete($schedule->pdf_file);
            }
            $validated['pdf_file'] = $request->file('pdf_file')->store('schedules/pdfs', 'public');
        } elseif ($request->boolean('remove_pdf')) {
            // Remove PDF if checkbox is checked
            if ($schedule->pdf_file && Storage::disk('public')->exists($schedule->pdf_file)) {
                Storage::disk('public')->delete($schedule->pdf_file);
            }
            $validated['pdf_file'] = null;
        }

        $schedule->update($validated);
        
        // Sync speakers
        $schedule->speakers()->sync($request->input('speaker_ids', []));

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
