<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - {{ $user->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }

        :root {
            --cv-primary: {{ $cvSetting->primary_color ?? '#00ACC1' }};
            --cv-secondary: {{ $cvSetting->secondary_color ?? '#64748b' }};
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            color: #1f2937;
            line-height: 1.4;
        }

        @page {
            margin: 0;
            size: A4 portrait;
        }

        @if(!($forPdf ?? false))
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
            overflow: hidden;
        }
        @endif

        .cv-container {
            width: 210mm;
            height: 297mm;
            margin: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            overflow: hidden;
            display: table;
        }

        .cv-sidebar {
            display: table-cell;
            width: 63mm;
            background: var(--cv-primary, #00ACC1);
            vertical-align: top;
            padding: 12mm 12mm;
            overflow: hidden;
        }

        .cv-content {
            display: table-cell;
            vertical-align: top;
            padding: 0;
            overflow: hidden;
        }

        .cv-header {
            background: #1a1a2e;
            padding: 15mm 18mm;
            color: white;
        }

        .cv-body {
            padding: 14mm 16mm;
            overflow: hidden;
        }

        .section-title {
            font-size: 11pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 2px solid var(--cv-primary, #00ACC1);
        }

        .main-name {
            font-size: 20pt;
            font-weight: 900;
            color: white;
            letter-spacing: 1px;
            line-height: 1.1;
        }

        .profession {
            font-size: 8pt;
            color: var(--cv-primary, #00ACC1);
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .description-text {
            font-size: 10pt;
            line-height: 1.4;
        }

        .section-spacing {
            margin-bottom: 10px;
        }

        .item-spacing {
            margin-bottom: 8px;
        }

        .skill-bar {
            height: 5px;
            border-radius: 2px;
            background: rgba(0,0,0,0.25);
            margin-top: 2px;
        }

        .skill-fill {
            height: 5px;
            border-radius: 2px;
            background: white;
        }

        .long-links {
            word-break: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
        }

        .icon-row {
            display: block;
            margin-bottom: 4px;
            font-size: 10pt;
            line-height: 1.4;
            color: rgba(255,255,255,0.9);
        }

        .icon-row svg {
            display: inline;
            vertical-align: middle;
            margin-right: 3px;
            flex-shrink: 0;
        }

        .icon-row a {
            color: inherit;
            text-decoration: none;
            word-break: break-word;
        }
    </style>
</head>
<body>
    @if(!($forPdf ?? false))
    <div class="cv-page-wrapper">
    @endif
    @php
        $githubText = $user->profile?->github_url ?
            basename(rtrim($user->profile->github_url, '/')) : '';
        $linkedinText = $user->profile?->linkedin_url ?
            basename(rtrim($user->profile->linkedin_url, '/')) : '';
    @endphp
    <div class="cv-container">

        {{-- SIDEBAR CYAN --}}
        <div class="cv-sidebar">
            <div style="background: rgba(0,0,0,0.15); padding: 8px 12px; margin: -12mm -12mm 10mm -12mm; text-align: center;">
                <span style="font-size: 10pt; font-weight: 700; letter-spacing: 2px; color: white; text-transform: uppercase;">CURRICULUM</span>
            </div>

            {{-- Photo --}}
            @if($user->photo_url)
            <div style="text-align: center; margin-bottom: 10mm;">
                <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                     style="width: 130px; height: 130px; border-radius: 50%; border: 4px solid rgba(255,255,255,0.5); object-fit: cover; box-shadow: 0 8px 24px rgba(0,0,0,0.35);">
            </div>
            @endif

            {{-- CONTACT --}}
            <div style="background: rgba(0,0,0,0.15); padding: 10px 12px; margin: 0 -12mm 10mm -12mm;">
                <div style="padding: 0 12px;">
                    <div style="font-size: 10pt; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Contact</div>
                    @if($user->email)
                    <div class="icon-row" style="font-size: 9pt; margin-bottom: 3px;">✉ {{ $user->email }}</div>
                    @endif
                    @if($user->profile?->address)
                    <div class="icon-row" style="font-size: 9pt; margin-bottom: 3px;">📍 {{ $user->profile->address }}</div>
                    @endif
                    @if($user->profile?->phone)
                    <div class="icon-row" style="font-size: 9pt; margin-bottom: 3px;">📱 {{ $user->profile->phone }}</div>
                    @endif
                </div>
            </div>

            {{-- SKILLS --}}
            @if($user->skills->isNotEmpty())
            <div style="margin-bottom: 10mm;">
                <div style="font-size: 10pt; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Compétences</div>
                @foreach($user->skills as $skill)
                <div style="margin-bottom: 6px;">
                    <div style="font-size: 9pt; color: white; margin-bottom: 2px; font-weight: 500;">{{ $skill->name }}</div>
                    <div class="skill-bar">
                        <div class="skill-fill" style="width: {{ $skill->level_percentage }}%;"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- RÉSEAUX --}}
            @if($user->profile?->linkedin_url || $user->profile?->github_url)
            <div>
                <div style="font-size: 10pt; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Réseaux</div>
                @if($user->profile?->linkedin_url)
                <div style="font-size: 9pt; margin-bottom: 3px;"><a href="{{ $user->profile->linkedin_url }}" target="_blank" style="color: white; text-decoration: none;">LinkedIn</a></div>
                @endif
                @if($user->profile?->github_url)
                <div style="font-size: 9pt;"><a href="{{ $user->profile->github_url }}" target="_blank" style="color: white; text-decoration: none;">GitHub</a></div>
                @endif
            </div>
            @endif

            {{-- LOISIRS --}}
            @if($user->hobbies->isNotEmpty())
            <div style="margin-top: 10mm;">
                <div style="font-size: 10pt; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Loisirs</div>
                @foreach($user->hobbies as $hobby)
                <div style="font-size: 9pt; color: white; margin-bottom: 3px;">{{ $hobby->name }}</div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- CONTENU DROIT --}}
        <div class="cv-content">
            <div class="cv-header">
                <div class="main-name">{{ strtoupper($user->name) }}</div>
                @if($user->profile?->profession)
                <div class="profession">{{ mb_strtoupper($user->profile->profession) }}</div>
                @endif
            </div>

            <div class="cv-body">
                {{-- À PROPOS --}}
                @if($user->profile?->professional_summary)
                <div class="section-spacing">
                    <div class="section-title">À propos</div>
                    <p class="description-text" style="margin: 0;">{{ $user->profile->professional_summary }}</p>
                </div>
                @endif

                {{-- FORMATION --}}
                @if($user->educations->isNotEmpty())
                <div class="section-spacing">
                    <div class="section-title">Formation</div>
                    @foreach($user->educations as $education)
                    <div class="item-spacing">
                        <div style="font-weight: 700;">{{ $education->school }}</div>
                        <div style="font-size: 10pt; color: var(--cv-primary, #00ACC1); font-weight: 600;">@if($education->graduation_year){{ $education->graduation_year }} — @endif{{ $education->degree }}</div>
                        @if($education->description)
                        <div class="description-text">{{ $education->description }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- EXPÉRIENCES --}}
                @if($user->experiences->isNotEmpty())
                <div class="section-spacing">
                    <div class="section-title">Expérience</div>
                    @foreach($user->experiences as $experience)
                    <div class="item-spacing">
                        <div style="font-weight: 700;">{{ $experience->company }}</div>
                        <div style="font-size: 10pt; color: var(--cv-primary, #00ACC1); font-weight: 600;">{{ $experience->date_range }} — {{ $experience->job_title }}</div>
                        @if($experience->description)
                        <div class="description-text">{{ $experience->description }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
    @if(!($forPdf ?? false))
    </div>
    @endif
</body>
</html>
