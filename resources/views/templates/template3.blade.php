@extends('layouts.cv')

@section('content')
@php
    $profile = $user->profile;

    /* Skill level → bars filled (1–4) */
    $levelBars = [
        'debutant'      => 1,
        'intermediaire' => 2,
        'avance'        => 3,
        'expert'        => 4,
    ];

    /* SVG donut helpers — circumference ≈ 2π×15.9 ≈ 100 */
    $languages = [
        ['label' => 'Français', 'pct' => 100, 'color' => '#00d4d4'],
        ['label' => 'Anglais',  'pct' => 75,  'color' => '#00aaaa'],
    ];

    /* GitHub/LinkedIn text extraction */
    $githubText = $profile?->github_url ?
        basename(rtrim($profile->github_url, '/')) : '';
    $linkedinText = $profile?->linkedin_url ?
        basename(rtrim($profile->linkedin_url, '/')) : '';
@endphp

<style>
.icon-row {
  display: block;
  margin-bottom: 6px;
  font-size: 10pt;
  line-height: 1.8;
}

.icon-row svg {
  display: inline;
  vertical-align: middle;
  margin-right: 4px;
}

.icon-row a {
  color: inherit;
  text-decoration: none;
  vertical-align: middle;
  word-break: break-all;
}
</style>

{{-- ─────────────────────────────────────────────────────────────────────────
     PAGE WRAPPER — 3 table-cells : left | zigzag | right
     ───────────────────────────────────────────────────────────────────────── --}}
<div style="font-family: Arial, Helvetica, sans-serif; display: table; table-layout: fixed;
            width: 210mm; height: 297mm; background: #00d4d4; margin: 0; padding: 0; overflow: hidden;">

    {{-- ══════════════════════════════════════════════════════════
         COLONNE GAUCHE — fond cyan #00d4d4
         ══════════════════════════════════════════════════════════ --}}
    <div style="display: table-cell; width: 70mm; background: #00d4d4;
                vertical-align: top; padding: 18px 13px 18px 14px;">

        {{-- Label discret en haut --}}
        <div style="font-size: 6.5pt; color: rgba(255,255,255,0.85); letter-spacing: 3px;
                    text-transform: uppercase; font-weight: 700; margin-bottom: 14px;">
            Curriculum&nbsp;Vitae
        </div>

        {{-- ── Photo ── --}}
        <div style="text-align: center; margin-bottom: 16px;">
            @if($user->photo_url)
                <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                     style="width: 140px; height: 140px; border: 5px solid #ffffff;
                            display: inline-block; object-fit: cover; box-shadow: 0 8px 24px rgba(0,0,0,0.3);">
            @else
                <div style="width: 140px; height: 140px; border: 5px solid #ffffff;
                            background: rgba(255,255,255,0.3); display: inline-block; box-shadow: 0 8px 24px rgba(0,0,0,0.3);"></div>
            @endif
        </div>

        {{-- ── CONTACT ── --}}
        <div style="background: #1a1a1a; border-radius: 7px; padding: 12px 11px; margin-bottom: 11px;">
            <div style="font-size: 8.5pt; font-weight: 700; color: #00d4d4; text-transform: uppercase;
                        letter-spacing: 1.5px; margin-bottom: 10px; padding-bottom: 6px;
                        border-bottom: 2px solid #00d4d4;">Contact</div>

            @if($user->email)
            <div class="icon-row" style="color: #ffffff; font-size: 9pt; margin-bottom: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#00d4d4">
                    <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1
                    0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                </svg>
                {{ $user->email }}
            </div>
            @endif

            @if($profile?->phone)
            <div class="icon-row" style="color: #ffffff; font-size: 9pt; margin-bottom: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#00d4d4">
                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27
                    -.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1
                    1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55
                    0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                </svg>
                {{ $profile->phone }}
            </div>
            @endif

            @if($profile?->address)
            <div class="icon-row" style="color: #ffffff; font-size: 9pt; margin-bottom: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#00d4d4">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75
                    7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12
                    -2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                {{ $profile->address }}
            </div>
            @endif

            @if($profile?->website_url)
            <div class="icon-row" style="color: #ffffff; font-size: 9pt; margin-bottom: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#00d4d4">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48
                    10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62
                    .08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26
                    -.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0
                    1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41
                    0 2.08-.8 3.97-2.1 5.39z"/>
                </svg>
                <a href="{{ $profile->website_url }}" target="_blank" style="color: #ffffff; text-decoration: none;">{{ $profile->website_url }}</a>
            </div>
            @endif

            @if($profile?->github_url)
            <div class="icon-row" style="color: #ffffff; font-size: 9pt; margin-bottom: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#00d4d4">
                    <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207
                    11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416
                    -4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745
                    .083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07
                    1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604
                    -2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381
                    1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322
                    3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138
                    3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242
                    2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807
                    5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319
                    .192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373
                    -12-12-12z"/>
                </svg>
                <a href="{{ $profile->github_url }}" target="_blank" style="color: #ffffff; text-decoration: none;">{{ $githubText }}</a>
            </div>
            @endif

            @if($profile?->linkedin_url)
            <div class="icon-row" style="color: #ffffff; font-size: 9pt;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#0077b5">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037
                    -1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414
                    v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37
                    4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065
                    2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452z
                    M22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24
                    1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774
                    23.2 0 22.222 0h.003z"/>
                </svg>
                <a href="{{ $profile->linkedin_url }}" target="_blank" style="color: #0077b5; text-decoration: none;">{{ $linkedinText }}</a>
            </div>
            @endif
        </div>

        {{-- ── COMPÉTENCES — style escalier ── --}}
        @if($user->skills->isNotEmpty())
        <div style="background: #1a1a1a; border-radius: 7px; padding: 11px 10px; margin-bottom: 11px;">
            <div style="font-size: 8pt; font-weight: 700; color: #00d4d4; text-transform: uppercase;
                        letter-spacing: 1.5px; margin-bottom: 9px; padding-bottom: 5px;
                        border-bottom: 1px solid #333;">Compétences</div>

            @foreach($user->skills as $skill)
            @php $filled = $levelBars[$skill->level] ?? 2; @endphp
            <div style="margin-bottom: 9px;">
                <div style="font-size: 8pt; color: #ffffff; margin-bottom: 4px;">{{ $skill->name }}</div>
                {{-- Escalier : 4 barres de hauteurs croissantes (4px, 6px, 9px, 12px) --}}
                <div style="display: table; border-collapse: separate; border-spacing: 3px 0;">
                    @for($b = 0; $b < 4; $b++)
                    <div style="display: table-cell; vertical-align: bottom;">
                        <div style="width: 10px; height: {{ 4 + ($b * 3) }}px;
                                    background: {{ $b < $filled ? '#ffffff' : '#444444' }};
                                    border-radius: 1px;"></div>
                    </div>
                    @endfor
                    <div style="display: table-cell; vertical-align: middle; padding-left: 5px;">
                        <span style="font-size: 6.5pt; color: rgba(255,255,255,0.55);">{{ $skill->level_label }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- ── LANGUES — donuts SVG ── --}}
        <div style="background: #1a1a1a; border-radius: 7px; padding: 11px 10px;">
            <div style="font-size: 8pt; font-weight: 700; color: #00d4d4; text-transform: uppercase;
                        letter-spacing: 1.5px; margin-bottom: 10px; padding-bottom: 5px;
                        border-bottom: 1px solid #333;">Langues</div>

            <div style="display: table; width: 100%;">
                @foreach($languages as $lang)
                @php
                    $arc    = $lang['pct'];      /* stroke-dasharray value (over ≈100) */
                    $gap    = 100 - $arc;
                @endphp
                <div style="display: table-cell; text-align: center; padding: 0 4px;">
                    <svg width="54" height="54" viewBox="0 0 36 36"
                         xmlns="http://www.w3.org/2000/svg">
                        {{-- Piste de fond --}}
                        <circle cx="18" cy="18" r="15.9"
                                fill="#2a2a2a"
                                stroke="#333333" stroke-width="3.2"/>
                        {{-- Arc de progression --}}
                        <circle cx="18" cy="18" r="15.9"
                                fill="none"
                                stroke="{{ $lang['color'] }}" stroke-width="3.2"
                                stroke-dasharray="{{ $arc }} {{ $gap }}"
                                stroke-dashoffset="25"
                                stroke-linecap="round"/>
                        {{-- Pourcentage centré --}}
                        <text x="18" y="21" text-anchor="middle"
                              font-size="7" font-weight="bold"
                              fill="#ffffff" font-family="Arial">{{ $lang['pct'] }}%</text>
                    </svg>
                    <div style="font-size: 7.5pt; color: #ffffff; margin-top: 3px;">{{ $lang['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

    </div>{{-- /col-left --}}

    {{-- ══════════════════════════════════════════════════════════
         SÉPARATEUR ZIGZAG (40px)
         CSS gradient : fonctionne dans dompdf 2.x / CPDF
         ══════════════════════════════════════════════════════════ --}}
    <div style="display: table-cell; width: 13mm; vertical-align: top;
                background-color: #1a1a1a;
                background-image:
                    linear-gradient(135deg, #00d4d4 25%, transparent 25%),
                    linear-gradient(225deg, #00d4d4 25%, transparent 25%),
                    linear-gradient(315deg, #00d4d4 25%, transparent 25%),
                    linear-gradient( 45deg, #00d4d4 25%, transparent 25%);
                background-size: 18px 18px;
                background-position: 0 0, 0 0, 0 0, 0 0;">
    </div>

    {{-- ══════════════════════════════════════════════════════════
         COLONNE DROITE — fond blanc
         ══════════════════════════════════════════════════════════ --}}
    <div style="display: table-cell; background: #ffffff; vertical-align: top;">

        {{-- ── Header noir pleine largeur ── --}}
        <div style="background: #1a1a1a; padding: 22px 18px 16px 18px;">
            <div style="font-size: 22pt; font-weight: 900; color: #ffffff;
                        text-transform: uppercase; letter-spacing: 2px; line-height: 1.1;">
                {{ $user->name }}
            </div>
            @if($profile?->profession)
            <div style="font-size: 9pt; color: #aaaaaa; margin-top: 5px; letter-spacing: 1px;">
                {{ $profile->profession }}
            </div>
            @endif
        </div>

        {{-- ── CONTENU PRINCIPAL ── --}}
        <div style="padding: 14px 16px 14px 14px;">

            {{-- À PROPOS DE MOI --}}
            @if($profile?->professional_summary)
            <div style="margin-bottom: 13px;">
                <div style="font-size: 9.5pt; font-weight: 700; color: #1a1a1a;
                            text-transform: uppercase; letter-spacing: 1px;
                            border-bottom: 2px solid #00d4d4; padding-bottom: 3px; margin-bottom: 7px;">
                    À propos de moi
                </div>
                <div style="font-size: 8.5pt; color: #555555; line-height: 1.55;">
                    {{ $profile->professional_summary }}
                </div>
            </div>
            @endif

            {{-- FORMATION --}}
            @if($user->educations->isNotEmpty())
            <div style="margin-bottom: 13px;">
                <div style="font-size: 9.5pt; font-weight: 700; color: #1a1a1a;
                            text-transform: uppercase; letter-spacing: 1px;
                            border-bottom: 2px solid #00d4d4; padding-bottom: 3px; margin-bottom: 8px;">
                    Formation
                </div>
                @foreach($user->educations as $edu)
                <div style="display: table; width: 100%; margin-bottom: 9px;">
                    {{-- Bande gauche colorée --}}
                    <div style="display: table-cell; width: 4px; background: #00d4d4;
                                border-radius: 2px; vertical-align: stretch;"></div>
                    <div style="display: table-cell; padding-left: 10px; vertical-align: top;">
                        <div style="font-size: 9pt; font-weight: 700; color: #1a1a1a;">{{ $edu->school }}</div>
                        <div style="font-size: 8pt; font-weight: 700; color: #333333; margin-top: 1px;">
                            @if($edu->graduation_year)<span>{{ $edu->graduation_year }}</span>@endif
                            @if($edu->degree)<span>&nbsp;&#8212;&nbsp;{{ $edu->degree }}</span>@endif
                            @if($edu->field_of_study)<span>&nbsp;&#183;&nbsp;{{ $edu->field_of_study }}</span>@endif
                        </div>
                        @if($edu->description)
                        <div style="font-size: 8pt; color: #777777; margin-top: 2px; line-height: 1.45;">
                            {{ $edu->description }}
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- EXPÉRIENCES --}}
            @if($user->experiences->isNotEmpty())
            <div style="margin-bottom: 13px;">
                <div style="font-size: 9.5pt; font-weight: 700; color: #1a1a1a;
                            text-transform: uppercase; letter-spacing: 1px;
                            border-bottom: 2px solid #00d4d4; padding-bottom: 3px; margin-bottom: 8px;">
                    Expériences
                </div>
                @foreach($user->experiences as $exp)
                <div style="display: table; width: 100%; margin-bottom: 10px;">
                    <div style="display: table-cell; width: 4px; background: #00d4d4;
                                border-radius: 2px; vertical-align: stretch;"></div>
                    <div style="display: table-cell; padding-left: 10px; vertical-align: top;">
                        <div style="font-size: 9pt; font-weight: 700; color: #1a1a1a;">{{ $exp->company }}</div>
                        <div style="font-size: 8pt; font-weight: 700; color: #333333; margin-top: 1px;">
                            {{ $exp->date_range }}
                            @if($exp->job_title)<span>&nbsp;&#183;&nbsp;{{ $exp->job_title }}</span>@endif
                            @if($exp->location)<span style="font-weight: 400; color: #888888;">&nbsp;&#183;&nbsp;{{ $exp->location }}</span>@endif
                        </div>
                        @if($exp->description)
                        <div style="font-size: 8pt; color: #777777; margin-top: 2px; line-height: 1.45;">
                            {{ $exp->description }}
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- LOISIRS --}}
            @if($user->hobbies->isNotEmpty())
            <div>
                <div style="font-size: 9.5pt; font-weight: 700; color: #1a1a1a;
                            text-transform: uppercase; letter-spacing: 1px;
                            border-bottom: 2px solid #00d4d4; padding-bottom: 3px; margin-bottom: 8px;">
                    Loisirs
                </div>
                <div>
                    @foreach($user->hobbies as $hobby)
                    <span style="display: inline-block; background: #f3f3f3; color: #444444;
                                 font-size: 8pt; padding: 3px 9px; margin: 0 4px 4px 0;
                                 border-radius: 3px; border: 1px solid #e0e0e0;">
                        {{ $hobby->name }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

        </div>{{-- /padding wrapper --}}

        {{-- Filigrane bas : "CURRICULUM VITAE" --}}
        <div style="text-align: right; padding-right: 8px; padding-bottom: 6px;">
            <span style="font-size: 6pt; color: #e8e8e8; letter-spacing: 4px;
                         text-transform: uppercase; font-weight: 700;">
                CURRICULUM VITAE
            </span>
        </div>

    </div>{{-- /col-right --}}

</div>{{-- /page-wrapper --}}
@endsection
