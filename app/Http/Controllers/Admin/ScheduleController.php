<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Event;
use App\Models\Speaker;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['event', 'speaker'])->orderBy('schedule_date')->orderBy('start_time')->paginate(15);
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
            'speaker_id' => 'nullable|exists:speakers,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'schedule_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'venue' => 'nullable|string|max:255',
            'day_label' => 'nullable|string|max:100',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Schedule::create($validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $events = Event::active()->orderBy('title')->get();
        $speakers = Speaker::active()->orderBy('name')->get();
        return view('admin.schedules.edit', compact('schedule', 'events', 'speakers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'speaker_id' => 'nullable|exists:speakers,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'schedule_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'venue' => 'nullable|string|max:255',
            'day_label' => 'nullable|string|max:100',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $schedule->update($validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
