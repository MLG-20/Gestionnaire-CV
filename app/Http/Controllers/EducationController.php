<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(Request $request): View
    {
        $educations = $request->user()->educations;
        return view('educations.index', compact('educations'));
    }

    public function create(): View
    {
        return view('educations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'degree'          => ['required', 'string', 'max:255'],
            'school'          => ['required', 'string', 'max:255'],
            'field_of_study'  => ['nullable', 'string', 'max:255'],
            'graduation_year' => ['nullable', 'integer', 'min:1950', 'max:2100'],
            'description'     => ['nullable', 'string', 'max:1000'],
        ]);

        $validated['user_id'] = $request->user()->id;
        Education::create($validated);

        return redirect()->route('dashboard.educations.index')->with('success', 'Formation ajoutée avec succès.');
    }

    public function edit(Education $education): View
    {
        $this->authorizeOwner($education);
        return view('educations.edit', compact('education'));
    }

    public function update(Request $request, Education $education): RedirectResponse
    {
        $this->authorizeOwner($education);

        $validated = $request->validate([
            'degree'          => ['required', 'string', 'max:255'],
            'school'          => ['required', 'string', 'max:255'],
            'field_of_study'  => ['nullable', 'string', 'max:255'],
            'graduation_year' => ['nullable', 'integer', 'min:1950', 'max:2100'],
            'description'     => ['nullable', 'string', 'max:1000'],
        ]);

        $education->update($validated);

        return redirect()->route('dashboard.educations.index')->with('success', 'Formation mise à jour.');
    }

    public function destroy(Education $education): RedirectResponse
    {
        $this->authorizeOwner($education);
        $education->delete();
        return redirect()->route('dashboard.educations.index')->with('success', 'Formation supprimée.');
    }

    private function authorizeOwner(Education $education): void
    {
        abort_if($education->user_id !== auth()->id(), 403);
    }
}
