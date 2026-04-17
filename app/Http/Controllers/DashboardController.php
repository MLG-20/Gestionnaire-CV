<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user()->load([
            'profile', 'experiences', 'educations', 'skills', 'hobbies', 'cvSetting'
        ]);

        $steps = [
            ['label' => 'Coordonnées',                'route' => 'dashboard.profile.edit',      'done' => $user->profile !== null],
            ['label' => 'Photo de profil',             'route' => 'dashboard.profile.edit',      'done' => $user->photo_path !== null],
            ['label' => 'Expériences professionnelles','route' => 'dashboard.experiences.index', 'done' => $user->experiences->isNotEmpty()],
            ['label' => 'Formations',                  'route' => 'dashboard.educations.index',  'done' => $user->educations->isNotEmpty()],
            ['label' => 'Compétences',                 'route' => 'dashboard.skills.index',      'done' => $user->skills->isNotEmpty()],
            ['label' => 'Loisirs',                     'route' => 'dashboard.hobbies.index',     'done' => $user->hobbies->isNotEmpty()],
            ['label' => 'Personnalisation du CV',      'route' => 'dashboard.cv-settings.edit',  'done' => $user->cvSetting?->template_name !== null],
        ];

        $completedSteps = collect($steps)->where('done', true)->count();

        return view('pages.dashboard.index', compact('user', 'steps', 'completedSteps'));
    }
}
