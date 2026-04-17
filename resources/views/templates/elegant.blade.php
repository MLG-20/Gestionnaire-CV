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
            --cv-primary: {{ $cvSetting->primary_color ?? '#7c3aed' }};
            --cv-secondary: {{ $cvSetting->secondary_color ?? '#5b21b6' }};
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
            background: var(--cv-primary, #7c3aed);
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

        {{-- ===== HEADER ÉLÉGANT ===== --}}
        <div class="section-spacing" style="background: var(--cv-primary, #7c3aed); padding: 18px 24px;">
            <div style="display: table; width: 100%;">
                <div style="display: table-cell; vertical-align: middle;">
                    <div style="font-size: 10pt; font-weight: 400; color: rgba(255,255,255,0.65); letter-spacing: 4px; text-transform: uppercase; margin-bottom: 6px;">Curriculum Vitæ</div>
                    <div class="main-name" style="font-size: 22pt; font-weight: 900; color: white; letter-spacing: 3px; line-height: 1.1;">{{ strtoupper($user->name) }}</div>
                    @if($user->profile?->profession)
                    <div style="height: 2px; width: 40px; background: rgba(255,255,255,0.4); margin: 10px 0;"></div>
                    <div class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.75); letter-spacing: 2px; text-transform: uppercase;">
                        {{ mb_strtoupper($user->profile->profession) }}
                    </div>
                    @endif
                </div>
                <div style="display: table-cell; vertical-align: middle; text-align: right; width: 95px;">
                    @if($user->photo_url)
                    <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                         style="width: 120px; height: 120px; border-radius: 50%; border: 5px solid rgba(255,255,255,0.6); object-fit: cover; display: inline-block; box-shadow: 0 8px 24px rgba(0,0,0,0.35);">
                    @endif
                </div>
            </div>
        </div>

        {{-- ===== CORPS ===== --}}
            <div class="section-spacing" style="padding: 18px 24px;">

            {{-- A PROPOS --}}
            @if($user->profile?->professional_summary)
            <div class="section-spacing" style="margin-bottom: 14px; padding: 16px 20px; border: 1px solid #e5e7eb; border-left: 4px solid var(--cv-primary, #7c3aed);">
                <p class="description-text" style="font-size: 10pt; color: #4b5563; line-height: 1.5; margin: 0; font-style: italic;">{{ $user->profile->professional_summary }}</p>
            </div>
            @endif

            {{-- DEUX COLONNES --}}
            <div style="display: table; width: 100%; height: 297mm;">

                {{-- GAUCHE --}}
                <div style="display: table-cell; width: 132mm; padding-right: 22px; vertical-align: top; height: 100%;">

                    @if($user->experiences->isNotEmpty())
                    <div class="section-spacing" style="margin-bottom: 8px; padding: 6px;">
                        <div style="display: table; width: 100%; margin-bottom: 6px;">
                            <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                                <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #7c3aed); text-transform: uppercase; letter-spacing: 1.5px;">Expériences</span>
                            </div>
                            <div style="display: table-cell; vertical-align: middle; padding-left: 6px;">
                                <div style="height: 1px; background: var(--cv-primary, #7c3aed); opacity: 0.3;"></div>
                            </div>
                        </div>
                        @foreach($user->experiences as $experience)
                        <div class="item-spacing" style="margin-bottom: 5px; padding-left: 8px; border-left: 2px solid var(--cv-primary, #7c3aed);">
                            <div style="display: table; width: 100%; margin-bottom: 1px;">
                                <div style="display: table-cell; font-size: 10pt; font-weight: 700; color: #1f2937;">{{ $experience->job_title }}</div>
                                <div style="display: table-cell; text-align: right; font-size: 9pt; color: #9ca3af; white-space: nowrap;">{{ $experience->date_range }}</div>
                            </div>
                            <div style="font-size: 10pt; color: var(--cv-primary, #7c3aed); font-weight: 600; margin-bottom: 2px;">{{ $experience->company }}@if($experience->location) &mdash; {{ $experience->location }}@endif</div>
                            @if($experience->description)
                            <div class="description-text" style="font-size: 9pt; color: #6b7280; line-height: 1.3;">{{ $experience->description }}</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if($user->educations->isNotEmpty())
                    <div class="section-spacing" style="margin-bottom: 8px; padding: 6px;">
                        <div style="display: table; width: 100%; margin-bottom: 6px;">
                            <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                                <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #7c3aed); text-transform: uppercase; letter-spacing: 1.5px;">Formation</span>
                            </div>
                            <div style="display: table-cell; vertical-align: middle; padding-left: 6px;">
                                <div style="height: 1px; background: var(--cv-primary, #7c3aed); opacity: 0.3;"></div>
                            </div>
                        </div>
                        @foreach($user->educations as $education)
                        <div class="item-spacing" style="margin-bottom: 5px; padding-left: 8px; border-left: 2px solid var(--cv-primary, #7c3aed);">
                            <div style="display: table; width: 100%;">
                                <div style="display: table-cell; font-size: 10pt; font-weight: 700; color: #1f2937;">{{ $education->degree }}</div>
                                @if($education->graduation_year)
                                <div style="display: table-cell; text-align: right; font-size: 9pt; color: #9ca3af; white-space: nowrap;">{{ $education->graduation_year }}</div>
                                @endif
                            </div>
                            <div style="font-size: 10pt; color: var(--cv-primary, #7c3aed); font-weight: 600; margin-bottom: 1px;">{{ $education->school }}</div>
                            @if($education->field_of_study)<div class="description-text" style="font-size: 9pt; color: #9ca3af;">{{ $education->field_of_study }}</div>@endif
                            @if($education->description)<div class="description-text" style="font-size: 9pt; color: #6b7280; margin-top: 1px; line-height: 1.3;">{{ $education->description }}</div>@endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- DROITE --}}
                <div style="display: table-cell; width: 63mm; vertical-align: top; padding-left: 10px; border-left: 1px solid #f3f4f6; height: 100%;">

                    @if($user->skills->isNotEmpty())
                    <div class="section-spacing" style="margin-bottom: 8px; padding: 6px;">
                        <div style="display: table; width: 100%; margin-bottom: 6px;">
                            <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                                <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #7c3aed); text-transform: uppercase; letter-spacing: 1.5px;">Compétences</span>
                            </div>
                            <div style="display: table-cell; vertical-align: middle; padding-left: 6px;">
                                <div style="height: 1px; background: var(--cv-primary, #7c3aed); opacity: 0.3;"></div>
                            </div>
                        </div>
                        @foreach($user->skills as $skill)
                        <div class="item-spacing" style="margin-bottom: 5px;">
                            <div style="display: table; width: 100%; margin-bottom: 2px;">
                                <div style="display: table-cell; font-size: 10pt; color: #374151; font-weight: 600;">{{ $skill->name }}</div>
                                <div style="display: table-cell; text-align: right; font-size: 9pt; color: #9ca3af;">{{ $skill->level_label }}</div>
                            </div>
                            <div class="skill-bar" style="background: #f3f0ff; height: 4px; border-radius: 2px;">
                                <div class="skill-fill" style="background: var(--cv-primary, #7c3aed); height: 4px; border-radius: 2px; width: {{ $skill->level_percentage }}%;"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if($user->hobbies->isNotEmpty())
                    <div class="section-spacing" style="padding: 6px; margin-bottom: 8px;">
                        <div style="display: table; width: 100%; margin-bottom: 6px;">
                            <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                                <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #7c3aed); text-transform: uppercase; letter-spacing: 1.5px;">Loisirs</span>
                            </div>
                            <div style="display: table-cell; vertical-align: middle; padding-left: 6px;">
                                <div style="height: 1px; background: var(--cv-primary, #7c3aed); opacity: 0.3;"></div>
                            </div>
                        </div>
                        @foreach($user->hobbies as $hobby)
                        <span class="description-text" style="display: inline-block; background: #f3f0ff; color: var(--cv-primary, #7c3aed); font-size: 8pt; padding: 2px 8px; border-radius: 8px; margin: 2px 2px 2px 0; font-weight: 600;">{{ $hobby->name }}</span>
                        @endforeach
                    </div>
                    @endif

                    {{-- CONTACT --}}
                    @if($user->email || $user->profile?->phone || $user->profile?->address)
                    <div class="section-spacing" style="padding: 6px; margin-bottom: 8px;">
                        <div style="display: table; width: 100%; margin-bottom: 6px;">
                            <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                                <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #7c3aed); text-transform: uppercase; letter-spacing: 1.5px;">Contact</span>
                            </div>
                            <div style="display: table-cell; vertical-align: middle; padding-left: 6px;">
                                <div style="height: 1px; background: var(--cv-primary, #7c3aed); opacity: 0.3;"></div>
                            </div>
                        </div>
                        @if($user->email)
                        <div class="long-links" style="font-size: 9pt; color: #6b7280; margin-bottom: 3px; word-break: break-all; line-height: 1.2;">✉ {{ $user->email }}</div>
                        @endif
                        @if($user->profile?->phone)
                        <div style="font-size: 9pt; color: #6b7280; margin-bottom: 3px;">📱 {{ $user->profile->phone }}</div>
                        @endif
                        @if($user->profile?->address)
                        <div class="long-links" style="font-size: 9pt; color: #6b7280; word-break: break-all; line-height: 1.2;">📍 {{ $user->profile->address }}</div>
                        @endif
                    </div>
                    @endif

                    {{-- RÉSEAUX --}}
                    @if($user->profile?->linkedin_url || $user->profile?->github_url)
                    <div class="section-spacing" style="padding: 6px;">
                        <div style="display: table; width: 100%; margin-bottom: 6px;">
                            <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                                <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #7c3aed); text-transform: uppercase; letter-spacing: 1.5px;">Réseaux</span>
                            </div>
                            <div style="display: table-cell; vertical-align: middle; padding-left: 6px;">
                                <div style="height: 1px; background: var(--cv-primary, #7c3aed); opacity: 0.3;"></div>
                            </div>
                        </div>
                        @if($user->profile?->linkedin_url)
                        <div class="long-links" style="font-size: 9pt; color: #6b7280; margin-bottom: 3px; word-break: break-all;">in <a href="{{ $user->profile->linkedin_url }}" target="_blank" style="color: var(--cv-primary, #7c3aed); text-decoration: none; font-weight: 600;">LinkedIn</a></div>
                        @endif
                        @if($user->profile?->github_url)
                        <div class="long-links" style="font-size: 9pt; color: #6b7280; word-break: break-all;">gh <a href="{{ $user->profile->github_url }}" target="_blank" style="color: var(--cv-primary, #7c3aed); text-decoration: none; font-weight: 600;">GitHub</a></div>
                        @endif
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
