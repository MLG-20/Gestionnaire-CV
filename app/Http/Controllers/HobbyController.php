<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HobbyController extends Controller
{
    public function index(Request $request): View
    {
        $hobbies = $request->user()->hobbies;
        return view('hobbies.index', compact('hobbies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['user_id'] = $request->user()->id;
        Hobby::create($validated);

        return redirect()->route('dashboard.hobbies.index')->with('success', 'Loisir ajouté.');
    }

    public function update(Request $request, Hobby $hobby): RedirectResponse
    {
        abort_if($hobby->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $hobby->update($validated);

        return redirect()->route('dashboard.hobbies.index')->with('success', 'Loisir mis à jour.');
    }

    public function destroy(Hobby $hobby): RedirectResponse
    {
        abort_if($hobby->user_id !== auth()->id(), 403);
        $hobby->delete();
        return redirect()->route('dashboard.hobbies.index')->with('success', 'Loisir supprimé.');
    }
}
