<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - {{ $user->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        /* Correction pour l'impression des couleurs de fond - BROWSERSHOT */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        html, body {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        :root {
            --cv-primary: {{ $cvSetting->primary_color ?? '#2563eb' }};
            --cv-secondary: {{ $cvSetting->secondary_color ?? '#64748b' }};
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 13px;
            color: #1f2937;
            line-height: 1.5;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        @page {
            margin: 0;
            size: A4 portrait;
        }
        @if(!($forPdf ?? false))
        /* Aperçu navigateur : page A4 centrée sur fond gris */
        body {
            background: #e5e7eb;
            padding: 24px;
            min-height: 100vh;
        }
        .cv-page-wrapper {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            box-shadow: 0 4px 24px rgba(0,0,0,0.18);
            background: white;
        }
        @endif
    </style>
    @stack('styles')
    
    <!-- Style additionnel pour garantir l'impression des couleurs avec Browsershot -->
    <style>
    * {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
    </style>
</head>
<body>
    @if(!($forPdf ?? false))
    <div class="cv-page-wrapper">
        @yield('content')
    </div>
    @else
        @yield('content')
    @endif
</body>
</html>
