<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(Request $request): View
    {
        $experiences = $request->user()->experiences;
        return view('experiences.index', compact('experiences'));
    }

    public function create(): View
    {
        return view('experiences.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'job_title'   => ['required', 'string', 'max:255'],
            'company'     => ['required', 'string', 'max:255'],
            'location'    => ['nullable', 'string', 'max:255'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_current'  => ['boolean'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        $validated['user_id']   = $request->user()->id;
        $validated['is_current'] = $request->boolean('is_current');
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        Experience::create($validated);

        return redirect()->route('dashboard.experiences.index')->with('success', 'Expérience ajoutée avec succès.');
    }

    public function edit(Experience $experience): View
    {
        $this->authorizeOwner($experience);
        return view('experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $this->authorizeOwner($experience);

        $validated = $request->validate([
            'job_title'   => ['required', 'string', 'max:255'],
            'company'     => ['required', 'string', 'max:255'],
            'location'    => ['nullable', 'string', 'max:255'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_current'  => ['boolean'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $experience->update($validated);

        return redirect()->route('dashboard.experiences.index')->with('success', 'Expérience mise à jour.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $this->authorizeOwner($experience);
        $experience->delete();
        return redirect()->route('dashboard.experiences.index')->with('success', 'Expérience supprimée.');
    }

    private function authorizeOwner(Experience $experience): void
    {
        abort_if($experience->user_id !== auth()->id(), 403);
    }
}
