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
            --cv-primary: {{ $cvSetting->primary_color ?? '#1e3a5f' }};
            --cv-secondary: {{ $cvSetting->secondary_color ?? '#2d5986' }};
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
            background: var(--cv-primary, #1e3a5f);
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
    <div class="cv-container" style="font-family: Arial, sans-serif; width: 210mm; min-height: 297mm; background: white; margin: 0; padding: 10mm; box-sizing: border-box;">

        {{-- ===== EN-TÊTE PLEINE LARGEUR ===== --}}
        <div class="section-spacing" style="background: var(--cv-primary, #1e3a5f); padding: 18px 24px 22px; position: relative;">
            <div style="display: table; width: 100%;">
                <div style="display: table-cell; vertical-align: middle;">
                    <div class="main-name" style="font-size: 22pt; font-weight: 900; color: white; letter-spacing: 1px; line-height: 1.1;">{{ $user->name }}</div>
                    @if($user->profile?->professional_summary)
                    <div class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.7); letter-spacing: 2px; text-transform: uppercase; margin-top: 6px;">
                        {{ mb_strtoupper(mb_substr(strip_tags($user->profile->professional_summary), 0, 60)) }}
                    </div>
                    @endif
                    <div style="height: 3px; width: 50px; background: var(--cv-secondary, #64b5f6); margin-top: 10px;"></div>
                </div>
                <div style="display: table-cell; vertical-align: middle; text-align: right; width: 140px;">
                    @if($user->photo_url)
                    <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                         style="width: 120px; height: 120px; border-radius: 50%; border: 4px solid rgba(255,255,255,0.6); object-fit: cover; display: inline-block; box-shadow: 0 8px 24px rgba(0,0,0,0.35);">
                    @endif
                </div>
            </div>
        </div>

        {{-- ===== CORPS DEUX COLONNES ===== --}}
        <div style="display: table; width: 100%; height: 297mm;">

            {{-- COLONNE GAUCHE (65%) --}}
            <div style="display: table-cell; width: 135mm; padding: 24px 24px 24px 24px; vertical-align: top; background: white; height: 100%;">

                {{-- A PROPOS --}}
                @if($user->profile?->professional_summary)
                <div class="section-spacing" style="margin-bottom: 8px; padding: 6px;">
                    <div style="display: table; width: 100%; margin-bottom: 6px;">
                        <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                            <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #1e3a5f); text-transform: uppercase; letter-spacing: 0.5px;">A Propos de Moi</span>
                        </div>
                        <div style="display: table-cell; vertical-align: middle; padding-left: 8px;">
                            <div style="height: 2px; background: #e5e7eb;"></div>
                        </div>
                    </div>
                    <p class="description-text" style="font-size: 9pt; color: #4b5563; line-height: 1.4; margin: 0;">{{ $user->profile->professional_summary }}</p>
                </div>
                @endif

                {{-- EXPÉRIENCES --}}
                @if($user->experiences->isNotEmpty())
                <div class="section-spacing" style="margin-bottom: 8px; padding: 6px;">
                    <div style="display: table; width: 100%; margin-bottom: 6px;">
                        <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                            <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #1e3a5f); text-transform: uppercase; letter-spacing: 0.5px;">Expérience</span>
                        </div>
                        <div style="display: table-cell; vertical-align: middle; padding-left: 8px;">
                            <div style="height: 2px; background: #e5e7eb;"></div>
                        </div>
                    </div>
                    @foreach($user->experiences as $experience)
                    <div class="item-spacing" style="display: table; width: 100%; margin-bottom: 6px;">
                        {{-- Année gauche --}}
                        <div style="display: table-cell; vertical-align: top; width: 55px; padding-right: 8px; text-align: right;">
                            <div class="description-text" style="font-size: 9pt; color: #9ca3af; line-height: 1.3; font-style: italic;">{{ $experience->date_range }}</div>
                        </div>
                        {{-- Ligne verticale --}}
                        <div style="display: table-cell; vertical-align: top; width: 3px; padding-right: 8px;">
                            <div style="width: 2px; background: var(--cv-primary, #1e3a5f); height: 100%; min-height: 25px;"></div>
                        </div>
                        {{-- Contenu --}}
                        <div style="display: table-cell; vertical-align: top;">
                            <div style="font-size: 10pt; font-weight: 700; color: #1f2937;">{{ $experience->job_title }}</div>
                            <div style="font-size: 10pt; color: var(--cv-primary, #1e3a5f); font-weight: 600; margin: 1px 0;">{{ $experience->company }}@if($experience->location) &mdash; {{ $experience->location }}@endif</div>
                            @if($experience->description)
                            <div class="description-text" style="font-size: 9pt; color: #6b7280; line-height: 1.3; margin-top: 2px;">{{ $experience->description }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- FORMATION --}}
                @if($user->educations->isNotEmpty())
                <div class="section-spacing" style="margin-bottom: 8px; padding: 6px;">
                    <div style="display: table; width: 100%; margin-bottom: 6px;">
                        <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                            <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #1e3a5f); text-transform: uppercase; letter-spacing: 0.5px;">Formation</span>
                        </div>
                        <div style="display: table-cell; vertical-align: middle; padding-left: 8px;">
                            <div style="height: 2px; background: #e5e7eb;"></div>
                        </div>
                    </div>
                    @foreach($user->educations as $education)
                    <div class="item-spacing" style="display: table; width: 100%; margin-bottom: 6px;">
                        <div style="display: table-cell; vertical-align: top; width: 55px; padding-right: 8px; text-align: right;">
                            @if($education->graduation_year)
                            <div class="description-text" style="font-size: 9pt; font-style: italic;">{{ $education->graduation_year }}</div>
                            @endif
                        </div>
                        <div style="display: table-cell; vertical-align: top; width: 3px; padding-right: 8px;">
                            <div style="width: 2px; background: var(--cv-primary, #1e3a5f); height: 100%; min-height: 20px;"></div>
                        </div>
                        <div style="display: table-cell; vertical-align: top;">
                            <div style="font-size: 10pt; font-weight: 700; color: #1f2937;">{{ $education->degree }}</div>
                            <div style="font-size: 10pt; color: var(--cv-primary, #1e3a5f); font-weight: 600;">{{ $education->school }}</div>
                            @if($education->field_of_study)<div class="description-text" style="font-size: 9pt; color: #9ca3af;">{{ $education->field_of_study }}</div>@endif
                            @if($education->description)<div class="description-text" style="font-size: 9pt; color: #6b7280; margin-top: 2px; line-height: 1.3;">{{ $education->description }}</div>@endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- LOISIRS --}}
                @if($user->hobbies->isNotEmpty())
                <div class="section-spacing" style="margin-bottom: 8px; padding: 6px;">
                    <div style="display: table; width: 100%; margin-bottom: 6px;">
                        <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                            <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #1e3a5f); text-transform: uppercase; letter-spacing: 0.5px;">Centres d'intérêt</span>
                        </div>
                        <div style="display: table-cell; vertical-align: middle; padding-left: 8px;">
                            <div style="height: 2px; background: #e5e7eb;"></div>
                        </div>
                    </div>
                    @foreach($user->hobbies as $hobby)
                    <span class="description-text" style="display: inline-block; background: #f3f4f6; color: #374151; font-size: 9pt; padding: 2px 8px; border-radius: 10px; margin: 2px 3px 2px 0;">{{ $hobby->name }}</span>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- COLONNE DROITE (35%) --}}
            <div style="display: table-cell; width: 63mm; padding: 24px 20px; vertical-align: top; background: #f8fafc; border-left: 1px solid #e5e7eb; height: 100%;">

                {{-- COMPÉTENCES --}}
                @if($user->skills->isNotEmpty())
                <div class="section-spacing" style="margin-bottom: 14px; padding: 10px;">
                    <div style="margin-bottom: 10px; padding-bottom: 6px; border-bottom: 2px solid var(--cv-primary, #1e3a5f);">
                        <span class="section-title" style="font-size: 13pt; font-weight: 700; color: var(--cv-primary, #1e3a5f); text-transform: uppercase; letter-spacing: 1px;">Compétences</span>
                    </div>
                    @foreach($user->skills as $skill)
                    <div class="item-spacing" style="margin-bottom: 10px;">
                        <div style="display: table; width: 100%; margin-bottom: 4px;">
                            <div style="display: table-cell; font-size: 11pt; color: #1f2937; font-weight: 600;">{{ $skill->name }}</div>
                            <div style="display: table-cell; text-align: right; font-size: 11pt; color: #9ca3af;">{{ $skill->level_label }}</div>
                        </div>
                        <div class="skill-bar" style="background: #e5e7eb; height: 6px; border-radius: 3px;">
                            <div class="skill-fill" style="background: var(--cv-primary, #1e3a5f); height: 6px; border-radius: 3px; width: {{ $skill->level_percentage }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- LANGUES (comme compétences) --}}
                @if($user->profile?->linkedin_url || $user->profile?->github_url)
                <div style="margin-bottom: 14px;">
                    <div style="margin-bottom: 10px; padding-bottom: 6px; border-bottom: 2px solid var(--cv-primary, #1e3a5f);">
                        <span style="font-size: 16px; font-weight: 700; color: var(--cv-primary, #1e3a5f); text-transform: uppercase; letter-spacing: 1px;">Réseaux</span>
                    </div>
                    @if($user->profile->linkedin_url)
                    <div style="font-size: 12px; color: #374151; margin-bottom: 6px;">
                        <span style="font-weight: 700; color: var(--cv-primary, #1e3a5f);">LinkedIn</span><br>{{ $user->profile->linkedin_url }}
                    </div>
                    @endif
                    @if($user->profile->github_url)
                    <div style="font-size: 12px; color: #374151; margin-bottom: 6px;">
                        <span style="font-weight: 700; color: var(--cv-primary, #1e3a5f);">GitHub</span><br>{{ $user->profile->github_url }}
                    </div>
                    @endif
                    @if($user->profile->website_url)
                    <div style="font-size: 12px; color: #374151; margin-bottom: 6px;">
                        <span style="font-weight: 700; color: var(--cv-primary, #1e3a5f);">Site web</span><br>{{ $user->profile->website_url }}
                    </div>
                    @endif
                </div>
                @endif

                {{-- CONTACT ENCADRÉ --}}
                <div style="background: var(--cv-primary, #1e3a5f); padding: 14px; border-radius: 4px;">
                    <div style="font-size: 16px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; text-align: center;">Contact</div>
                    @if($user->profile?->phone)
                    <div style="font-size: 12px; color: rgba(255,255,255,0.85); margin-bottom: 6px; text-align: center;">{{ $user->profile->phone }}</div>
                    @endif
                    @if($user->email)
                    <div style="font-size: 12px; color: rgba(255,255,255,0.85); margin-bottom: 6px; text-align: center; word-break: break-all;">{{ $user->email }}</div>
                    @endif
                    @if($user->profile?->address)
                    <div style="font-size: 12px; color: rgba(255,255,255,0.85); text-align: center; line-height: 1.4;">{{ $user->profile->address }}</div>
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
