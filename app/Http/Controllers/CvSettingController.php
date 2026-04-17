<?php

namespace App\Http\Controllers;

use App\Models\CvSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CvSettingController extends Controller
{
    public function edit(Request $request): View
    {
        $user      = $request->user();
        $cvSetting = $user->cvSetting ?? CvSetting::firstOrCreate(['user_id' => $user->id]);
        $templates = CvSetting::availableTemplates();

        return view('cv-settings.edit', compact('cvSetting', 'templates'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'template_name'   => ['required', 'string', 'in:' . implode(',', array_column(CvSetting::availableTemplates(), 'slug'))],
            'primary_color'   => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'secondary_color' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
        ]);

        $user = $request->user();
        $user->cvSetting()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('dashboard.cv-settings.edit')->with('success', 'Personnalisation sauvegardée.');
    }
}
