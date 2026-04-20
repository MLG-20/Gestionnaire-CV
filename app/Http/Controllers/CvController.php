<?php

namespace App\Http\Controllers;

use App\Models\CvSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

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
        
        // Permettre le téléchargement d'un template spécifique via query string
        $allowedSlugs = array_column(CvSetting::availableTemplates(), 'slug');
        if ($request->filled('template') && in_array($request->query('template'), $allowedSlugs)) {
            $cvSetting->template_name = $request->query('template');
        }
        
        $template = 'templates.' . $cvSetting->template_name;
        $forPdf   = true;

        // Ajouter le paramètre forPdf à la requête pour l'accessor photo_url
        $request->merge(['forPdf' => true]);

        try {
            // Générer le PDF avec DomPDF
            $pdf = Pdf::loadView($template, compact('user', 'cvSetting', 'forPdf'))
                ->setPaper('a4')
                ->setOption('margin-top', 0)
                ->setOption('margin-right', 0)
                ->setOption('margin-bottom', 0)
                ->setOption('margin-left', 0)
                ->setOption('isPhpEnabled', false)
                ->setOption('isRemoteEnabled', false)
                ->setOption('dpi', 96)
                ->setOption('enable-local-file-access', true);

            $nameSlug = str($user->name)->slug();
            if (empty($nameSlug)) {
                $nameSlug = 'cv-' . time();
            }
            $filename = $nameSlug . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            return back()->with('error', 'La génération du PDF a échoué. Veuillez réessayer.');
        }
    }
}
        } catch (\Exception $e) {
            return back()->with('error', 'La génération du PDF a échoué. Veuillez réessayer.');
        }
    }
}
