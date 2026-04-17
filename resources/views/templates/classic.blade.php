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
            --cv-primary: {{ $cvSetting->primary_color ?? '#1e40af' }};
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
            line-height: 1.5;
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
            padding: 15mm 12mm;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .cv-header-section {
            padding: 0 0 12px 0;
            margin-bottom: 10px;
            border-bottom: 2px solid var(--cv-primary, #1e40af);
            flex-shrink: 0;
        }

        .cv-body-section {
            flex: 1;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 0 8px;
        }

        .section-title {
            font-size: 12pt;
            font-weight: 700;
            color: var(--cv-primary, #1e40af);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            border-bottom: 1px solid var(--cv-primary, #1e40af);
            padding-bottom: 4px;
        }

        .main-name {
            font-size: 20pt;
            font-weight: 900;
            color: #1f2937;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .profession {
            font-size: 14px;
            color: var(--cv-primary, #1e40af);
            font-weight: 600;
            margin-bottom: 6px;
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

        .job-title {
            font-size: 11pt;
            font-weight: 700;
            color: #1f2937;
        }

        .company-name {
            font-size: 10pt;
            color: var(--cv-primary, #1e40af);
            font-weight: 600;
            margin: 2px 0;
        }

        .date-range {
            font-size: 10pt;
            color: #9ca3af;
            white-space: nowrap;
        }

        .skill-bar {
            height: 5px;
            border-radius: 2px;
            background: #e5e7eb;
            margin-top: 2px;
        }

        .skill-fill {
            height: 5px;
            border-radius: 2px;
            background: var(--cv-primary, #1e40af);
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

        .two-column {
            display: table;
            width: 100%;
            border-spacing: 0;
        }

        .col-main {
            display: table-cell;
            width: 65%;
            padding-right: 8px;
            vertical-align: top;
        }

        .col-side {
            display: table-cell;
            width: 35%;
            padding-left: 8px;
            border-left: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .phone-info, .email-info, .address-info {
            font-size: 10pt;
            color: #6b7280;
            margin-bottom: 2px;
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

        {{-- ===== HEADER ===== --}}
        <div class="cv-header-section">
            <div class="two-column">
                {{-- Photo --}}
                <div style="display: table-cell; width: 150px; vertical-align: top; padding-right: 20px;">
                    @if($user->photo_url)
                    <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                         style="width: 130px; height: 130px; object-fit: cover; border: 4px solid var(--cv-primary, #00ACC1); border-radius: 4px; box-shadow: 0 8px 24px rgba(0,0,0,0.25);">
                    @endif
                </div>
                {{-- Infos --}}
                <div style="display: table-cell; vertical-align: top;">
                    <div class="main-name">{{ strtoupper($user->name) }}</div>
                    @if($user->profile?->profession)
                    <div class="profession">{{ mb_strtoupper($user->profile->profession) }}</div>
                    @endif

                    {{-- Contact Info --}}
                    <div style="font-size: 10pt;">
                        @if($user->profile?->phone)
                        <div class="phone-info">📱 {{ $user->profile->phone }}</div>
                        @endif
                        @if($user->email)
                        <div class="email-info">✉ {{ $user->email }}</div>
                        @endif
                        @if($user->profile?->address)
                        <div class="address-info">📍 {{ $user->profile->address }}</div>
                        @endif
                    </div>

                    {{-- Links --}}
                    @if($user->profile?->linkedin_url || $user->profile?->github_url)
                    <div style="margin-top: 3px;">
                        @if($user->profile?->linkedin_url)
                        <span style="font-size: 9pt; margin-right: 8px;"><a href="{{ $user->profile->linkedin_url }}" target="_blank" style="color: #0077b5; text-decoration: none;">LinkedIn</a></span>
                        @endif
                        @if($user->profile?->github_url)
                        <span style="font-size: 9pt;"><a href="{{ $user->profile->github_url }}" target="_blank" style="color: #333; text-decoration: none;">GitHub</a></span>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ===== BODY ===== --}}
        <div class="cv-body-section">

            {{-- À PROPOS --}}
            @if($user->profile?->professional_summary)
            <div class="section-spacing">
                <div class="section-title">À propos</div>
                <p class="description-text" style="margin: 0;">{{ $user->profile->professional_summary }}</p>
            </div>
            @endif

            {{-- DUAL COLUMN --}}
            <div class="two-column" style="flex: 1;">

                {{-- COLONNE PRINCIPALE --}}
                <div class="col-main">

                    {{-- EXPÉRIENCES --}}
                    @if($user->experiences->isNotEmpty())
                    <div class="section-spacing">
                        <div class="section-title">Expériences</div>
                        @foreach($user->experiences as $experience)
                        <div class="item-spacing" style="padding-left: 8px; border-left: 2px solid var(--cv-primary, #1e40af);">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 1px;">
                                <div class="job-title">{{ $experience->job_title }}</div>
                                <div class="date-range">{{ $experience->date_range }}</div>
                            </div>
                            <div class="company-name">{{ $experience->company }}@if($experience->location), {{ $experience->location }}@endif</div>
                            @if($experience->description)
                            <div class="description-text">{{ $experience->description }}</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif

                    {{-- FORMATION --}}
                    @if($user->educations->isNotEmpty())
                    <div class="section-spacing">
                        <div class="section-title">Formation</div>
                        @foreach($user->educations as $education)
                        <div class="item-spacing" style="padding-left: 8px; border-left: 2px solid var(--cv-primary, #1e40af);">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 1px;">
                                <div class="job-title">{{ $education->degree }}</div>
                                @if($education->graduation_year)
                                <div class="date-range">{{ $education->graduation_year }}</div>
                                @endif
                            </div>
                            <div class="company-name">{{ $education->school }}</div>
                            @if($education->field_of_study)
                            <div style="font-size: 10pt; color: #9ca3af;">{{ $education->field_of_study }}</div>
                            @endif
                            @if($education->description)
                            <div class="description-text">{{ $education->description }}</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- COLONNE DROITE --}}
                <div class="col-side">

                    {{-- COMPÉTENCES --}}
                    @if($user->skills->isNotEmpty())
                    <div class="section-spacing">
                        <div class="section-title" style="margin-bottom: 6px;">Compétences</div>
                        @foreach($user->skills as $skill)
                        <div class="item-spacing">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 1px;">
                                <div style="font-size: 10pt; font-weight: 600;">{{ $skill->name }}</div>
                                <div style="font-size: 9pt; color: #9ca3af;">{{ $skill->level_label }}</div>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-fill" style="width: {{ $skill->level_percentage }}%;"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    {{-- LOISIRS --}}
                    @if($user->hobbies->isNotEmpty())
                    <div class="section-spacing">
                        <div class="section-title">Loisirs</div>
                        @foreach($user->hobbies as $hobby)
                        <div style="font-size: 9pt; color: #374151; margin-bottom: 3px;">✦ {{ $hobby->name }}</div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(!($forPdf ?? false))
    </div>
    @endif
</body>
</html>
