<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - {{ $user->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        html, body {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            margin: 0;
            padding: 0;
        }
        :root {
            --cv-primary: {{ $cvSetting->primary_color ?? '#374151' }};
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
        html, body {
            margin: 0;
            padding: 0;
            width: 210mm;
            height: 297mm;
        }
        .cv-container {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 13mm;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            overflow: hidden;
        }
        .section-title {
            font-size: 13pt;
            font-weight: bold;
        }
        .main-name {
            font-size: 22pt;
            font-weight: bold;
        }
        .description-text {
            font-size: 10pt;
        }
        .section-spacing {
            margin-bottom: 12px;
            padding: 10px;
        }
        .item-spacing {
            margin-bottom: 10px;
        }
        .skill-bar {
            height: 6px;
            border-radius: 3px;
            background: #e0e0e0;
        }
        .skill-fill {
            height: 6px;
            border-radius: 3px;
            background: var(--cv-primary, #1a1a1a);
        }
        .long-links {
            word-break: break-all;
            overflow: hidden;
            max-width: 100%;
        }
    </style>
</head>
<body>
    @if(!($forPdf ?? false))
    <div class="cv-page-wrapper">
    @endif
    <div class="cv-container" style="font-family: Arial, sans-serif; width: 210mm; min-height: 297mm; background: white; margin: 0; padding: 10mm; box-sizing: border-box; color: #1a1a1a;">

        {{-- ===== HEADER MINIMALISTE ===== --}}
        <div class="section-spacing" style="display: table; width: 100%; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #1a1a1a;">
            <div style="display: table-cell; vertical-align: middle;">
                <div class="main-name" style="font-size: 22pt; font-weight: 900; color: #1a1a1a; letter-spacing: 2px; line-height: 1.1;">{{ strtoupper($user->name) }}</div>
                @if($user->profile?->profession)
                <div class="description-text" style="font-size: 10pt; color: #6b7280; letter-spacing: 2px; text-transform: uppercase; margin-top: 6px;">
                    {{ mb_strtoupper($user->profile->profession) }}
                </div>
                @endif
            </div>
            <div style="display: table-cell; vertical-align: middle; text-align: right; width: 140px;">
                @if($user->photo_url)
                <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                     style="width: 110px; height: 110px; border-radius: 50%; border: 4px solid var(--cv-primary, #3b82f6); object-fit: cover; display: inline-block; box-shadow: 0 8px 24px rgba(0,0,0,0.25);">
                @endif
            </div>
        </div>



        {{-- ===== A PROPOS ===== --}}
        @if($user->profile?->professional_summary)
        <div class="section-spacing" style="margin-bottom: 8px; padding: 6px;">
            <div class="section-title" style="font-size: 13pt; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; color: var(--cv-primary, #374151); margin-bottom: 8px;">Profil</div>
            <p class="description-text" style="font-size: 10pt; color: #4b5563; line-height: 1.5; margin: 0; padding-left: 14px; border-left: 2px solid var(--cv-primary, #374151);">{{ $user->profile->professional_summary }}</p>
        </div>
        @endif

        {{-- ===== DEUX COLONNES ===== --}}
        <div style="display: table; width: 100%;">

            {{-- GAUCHE --}}
            <div style="display: table-cell; width: 130mm; padding-right: 24px; vertical-align: top;">

                @if($user->experiences->isNotEmpty())
                <div class="section-spacing" style="margin-bottom: 10px; padding: 8px;">
                    <div class="section-title" style="font-size: 14pt; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; color: var(--cv-primary, #374151); margin-bottom: 8px;">Expériences</div>
                    @foreach($user->experiences as $experience)
                    <div class="item-spacing" style="margin-bottom: 8px;">
                        <div style="display: table; width: 100%; margin-bottom: 2px;">
                            <div style="display: table-cell; font-size: 11pt; font-weight: 700; color: #1a1a1a;">{{ $experience->job_title }}</div>
                            <div style="display: table-cell; text-align: right; font-size: 11pt; color: #1a1a1a; white-space: nowrap;">{{ $experience->date_range }}</div>
                        </div>
                        <div style="font-size: 11pt; color: #1a1a1a; margin-bottom: 3px;">{{ $experience->company }}@if($experience->location) &mdash; {{ $experience->location }}@endif</div>
                        @if($experience->description)
                        <div class="description-text" style="font-size: 10pt; color: #1a1a1a; line-height: 1.4;">{{ $experience->description }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                @if($user->educations->isNotEmpty())
                <div class="section-spacing" style="margin-bottom: 10px; padding: 8px;">
                    <div class="section-title" style="font-size: 14pt; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; color: var(--cv-primary, #374151); margin-bottom: 8px;">Formation</div>
                    @foreach($user->educations as $education)
                    <div class="item-spacing" style="margin-bottom: 8px;">
                        <div style="display: table; width: 100%; margin-bottom: 2px;">
                            <div style="display: table-cell; font-size: 11pt; font-weight: 700; color: #1a1a1a;">{{ $education->degree }}</div>
                            @if($education->graduation_year)
                            <div style="display: table-cell; text-align: right; font-size: 11pt; color: #1a1a1a; white-space: nowrap;">{{ $education->graduation_year }}</div>
                            @endif
                        </div>
                        <div style="font-size: 11pt; color: #1a1a1a; margin-bottom: 2px;">{{ $education->school }}</div>
                        @if($education->field_of_study)<div class="description-text" style="font-size: 10pt; color: #1a1a1a;">{{ $education->field_of_study }}</div>@endif
                        @if($education->description)<div class="description-text" style="font-size: 10pt; color: #1a1a1a; line-height: 1.4; margin-top: 2px;">{{ $education->description }}</div>@endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- DROITE --}}
            <div style="display: table-cell; vertical-align: top; padding-left: 20px; border-left: 1px solid #e5e7eb;">

                @if($user->email || $user->profile?->phone || $user->profile?->address)
                <div class="section-spacing" style="margin-bottom: 6px; padding: 4px;">
                    <div class="section-title" style="font-size: 13pt; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; color: var(--cv-primary, #374151); margin-bottom: 6px;">Contact</div>
                    @if($user->email)<div style="font-size: 9pt; color: #1a1a1a; margin-bottom: 2px;">{{ $user->email }}</div>@endif
                    @if($user->profile?->phone)<div style="font-size: 9pt; color: #1a1a1a; margin-bottom: 2px;">{{ $user->profile->phone }}</div>@endif
                    @if($user->profile?->address)<div style="font-size: 9pt; color: #1a1a1a;">{{ $user->profile->address }}</div>@endif
                </div>
                @endif

                @if($user->profile?->linkedin_url || $user->profile?->github_url)
                <div class="section-spacing" style="margin-bottom: 6px; padding: 4px;">
                    <div class="section-title" style="font-size: 13pt; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; color: var(--cv-primary, #374151); margin-bottom: 6px;">Réseaux</div>
                    @if($user->profile?->linkedin_url)<div style="margin-bottom: 2px;"><a href="{{ $user->profile->linkedin_url }}" style="color: #1a1a1a; text-decoration: none; font-size: 9pt; font-weight: 600;">LinkedIn</a></div>@endif
                    @if($user->profile?->github_url)<div><a href="{{ $user->profile->github_url }}" style="color: #1a1a1a; text-decoration: none; font-size: 9pt; font-weight: 600;">GitHub</a></div>@endif
                </div>
                @endif

                @if($user->skills->isNotEmpty())
                <div class="section-spacing" style="margin-bottom: 6px; padding: 4px;">
                    <div class="section-title" style="font-size: 13pt; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; color: var(--cv-primary, #374151); margin-bottom: 6px;">Compétences</div>
                    @foreach($user->skills as $skill)
                    <div class="item-spacing" style="margin-bottom: 6px;">
                        <div style="display: table; width: 100%; margin-bottom: 2px;">
                            <div style="display: table-cell; font-size: 10pt; color: #1a1a1a;">{{ $skill->name }}</div>
                            <div style="display: table-cell; text-align: right; font-size: 10pt; color: #1a1a1a;">{{ $skill->level_label }}</div>
                        </div>
                        <div class="skill-bar" style="background: #f3f4f6; height: 5px;">
                            <div class="skill-fill" style="background: var(--cv-primary, #374151); height: 5px; width: {{ $skill->level_percentage }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                @if($user->hobbies->isNotEmpty())
                <div class="section-spacing" style="margin-bottom: 0; padding: 4px;">
                    <div class="section-title" style="font-size: 13pt; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; color: var(--cv-primary, #374151); margin-bottom: 6px;">Intérêts</div>
                    @foreach($user->hobbies as $hobby)
                    <div class="description-text" style="font-size: 9pt; color: #1a1a1a; margin-bottom: 4px; letter-spacing: 0.3px;">{{ $hobby->name }}</div>
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
