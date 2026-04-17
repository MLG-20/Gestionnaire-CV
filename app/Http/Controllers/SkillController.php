<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(Request $request): View
    {
        $skills = $request->user()->skills;
        return view('skills.index', compact('skills'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'level' => ['required', 'in:debutant,intermediaire,avance,expert'],
        ]);

        $validated['user_id'] = $request->user()->id;
        Skill::create($validated);

        return redirect()->route('dashboard.skills.index')->with('success', 'Compétence ajoutée.');
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        abort_if($skill->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'level' => ['required', 'in:debutant,intermediaire,avance,expert'],
        ]);

        $skill->update($validated);

        return redirect()->route('dashboard.skills.index')->with('success', 'Compétence mise à jour.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        abort_if($skill->user_id !== auth()->id(), 403);
        $skill->delete();
        return redirect()->route('dashboard.skills.index')->with('success', 'Compétence supprimée.');
    }
}
