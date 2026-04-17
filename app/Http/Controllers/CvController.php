<?php

namespace App\Http\Controllers;

use App\Models\CvSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Browsershot\Browsershot;

class CvController extends Controller
{
    private function loadUserData(Request $request): array
    {
        $user = $request->user()->load([
            'profile', 'experiences', 'educations', 'skills', 'hobbies', 'cvSetting'
        ]);

        $cvSetting = $user->cvSetting ?? new CvSetting([
            'template_name'   => 'classic',
            'primary_color'   => '#2563eb',
            'secondary_color' => '#64748b',
        ]);

        return compact('user', 'cvSetting');
    }

    public function index(Request $request): View
    {
        ['user' => $user, 'cvSetting' => $cvSetting] = $this->loadUserData($request);
        
        $template = 'templates.' . $cvSetting->template_name;
        $forPdf   = false;

        return view($template, compact('user', 'cvSetting', 'forPdf'));
    }

    public function preview(Request $request): View
    {
        ['user' => $user, 'cvSetting' => $cvSetting] = $this->loadUserData($request);

        // Permettre la prévisualisation d'un template via query string (sans sauvegarder)
        $allowedSlugs = array_column(CvSetting::availableTemplates(), 'slug');
        $allowedColors = ['#2563eb', '#64748b', '#ef4444', '#f97316', '#8b5cf6', '#06b6d4', '#10b981', '#ec4899'];

        if ($request->filled('template') && in_array($request->query('template'), $allowedSlugs)) {
            $cvSetting->template_name = $request->query('template');
        }
        // SECURITY FIX: Use whitelist instead of regex to prevent XSS
        if ($request->filled('primary') && in_array($request->query('primary'), $allowedColors)) {
            $cvSetting->primary_color = $request->query('primary');
        }
        if ($request->filled('secondary') && in_array($request->query('secondary'), $allowedColors)) {
            $cvSetting->secondary_color = $request->query('secondary');
        }

        $template = 'templates.' . $cvSetting->template_name;
        $forPdf   = false;

        return view($template, compact('user', 'cvSetting', 'forPdf'));
    }

    public function download(Request $request)
    {
        ['user' => $user, 'cvSetting' => $cvSetting] = $this->loadUserData($request);
        $template = 'templates.' . $cvSetting->template_name;
        $forPdf   = true;

        // Ajouter le paramètre forPdf à la requête pour l'accessor photo_url
        $request->merge(['forPdf' => true]);

        // Générer le HTML de la vue
        $html = view($template, compact('user', 'cvSetting', 'forPdf'))->render();

        // Créer un fichier temporaire pour le PDF
        $nameSlug = str($user->name)->slug();
        if (empty($nameSlug)) {
            $nameSlug = 'cv-' . time();
        }
        $filename = $nameSlug . '.pdf';
        $path = storage_path('app/public/' . $filename);
        
        // Créer le dossier s'il n'existe pas
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        try {
            // Générer le PDF avec Browsershot
            Browsershot::html($html)
                ->showBackground()
                ->printBackground(true)
                ->format('A4')
                ->margins(0, 0, 0, 0)
                // SECURITY FIX: Remove noSandbox() - sandbox must be enabled
                ->waitUntilNetworkIdle()
                ->links()
                ->disableJavascript()
                ->save($path);
        } catch (\Exception $e) {
            // En cas d'erreur, nettoyer et retourner une réponse d'erreur
            if (file_exists($path)) {
                unlink($path);
            }
            return back()->with('error', 'La génération du PDF a échoué. Veuillez réessayer.');
        }

        return response()->download($path, $filename, [
            'Content-Type' => 'application/pdf',
        ])->deleteFileAfterSend(true);
    }
}
