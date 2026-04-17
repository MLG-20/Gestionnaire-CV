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
  html, body {
    margin: 0;
    padding: 0;
    width: 100%;
  }
  body {
    font-family: Arial, sans-serif;
    font-size: 10pt;
    color: #1f2937;
    line-height: 1.3;
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
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
    font-size: 11pt;
    line-height: 1.4;
    overflow: hidden;
    display: table;
  }
  .cv-left {
    display: table-cell;
    width: 55%;
    background: #3b1066;
    color: white;
    padding: 10mm 8mm;
    vertical-align: top;
  }
  .cv-right {
    display: table-cell;
    width: 45%;
    padding: 10mm 8mm;
    vertical-align: top;
    background: white;
  }
  .section-title {
    font-size: 10pt;
    font-weight: 700;
    color: inherit;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
    padding-bottom: 1px;
  }
  .main-name {
    font-size: 18pt;
    font-weight: 900;
    margin-bottom: 1mm;
  }
  .description-text {
    font-size: 9pt;
    line-height: 1.25;
  }
  .item-spacing {
    margin-bottom: 1mm;
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
    background: #3b1066;
  }
  .long-links {
    word-break: break-word;
    overflow-wrap: break-word;
    max-width: 100%;
  }
  .icon-row {
    display: block;
    margin-bottom: 2mm;
    font-size: 9pt;
    line-height: 1.3;
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
  .section-spacing {
    margin-bottom: 3mm;
  }
  .item-spacing {
    margin-bottom: 2mm;
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

        {{-- COLONNE GAUCHE VIOLET --}}
        <div class="cv-left">
            <div class="main-name">{{ strtoupper($user->name) }}</div>
            @if($user->profile?->profession)
            <div style="font-size: 8pt; color: rgba(255,255,255,0.65); letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 3mm;">
                {{ mb_strtoupper($user->profile->profession) }}
            </div>
            @endif

            {{-- À PROPOS --}}
            @if($user->profile?->professional_summary)
            <div class="section-spacing">
                <div class="section-title">À propos</div>
                <p class="description-text" style="color: rgba(255,255,255,0.8); line-height: 1.4; margin: 0;">{{ $user->profile->professional_summary }}</p>
            </div>
            @endif

            {{-- FORMATION --}}
            @if($user->educations->isNotEmpty())
            <div class="section-spacing">
                <div class="section-title">Formation</div>
                @foreach($user->educations as $education)
                <div class="item-spacing">
                    <div style="font-weight: 700; color: white;">{{ $education->degree }}</div>
                    <div style="font-size: 10pt; color: rgba(255,255,255,0.7);">{{ $education->school }}</div>
                    @if($education->graduation_year)
                    <div style="font-size: 9pt; color: rgba(255,255,255,0.6);">{{ $education->graduation_year }}</div>
                    @endif
                    @if($education->description)
                    <div class="description-text" style="color: rgba(255,255,255,0.7); line-height: 1.4;">{{ $education->description }}</div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            {{-- EXPÉRIENCES --}}
            @if($user->experiences->isNotEmpty())
            <div class="section-spacing">
                <div class="section-title">Expériences</div>
                @foreach($user->experiences as $experience)
                <div class="item-spacing">
                    <div style="font-weight: 700; color: white;">{{ $experience->company }}</div>
                    <div style="font-size: 10pt; color: rgba(255,255,255,0.7);">{{ $experience->job_title }}</div>
                    <div style="font-size: 9pt; color: rgba(255,255,255,0.6);">{{ $experience->date_range }}</div>
                    @if($experience->description)
                    <div class="description-text" style="color: rgba(255,255,255,0.7); line-height: 1.4;">{{ $experience->description }}</div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- COLONNE DROITE BLANCHE --}}
        <div class="cv-right">
            {{-- Photo --}}
            @if($user->photo_url)
            <div style="text-align: center; margin-bottom: 4mm;">
                <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                     style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #3b1066; box-shadow: 0 8px 24px rgba(0,0,0,0.3);">
            </div>
            @endif

            {{-- CONTACT --}}
            <div class="section-spacing">
                <div class="section-title" style="color: #3b1066;">Contact</div>
                @if($user->email)
                <div class="icon-row" style="font-size: 9pt;">✉ {{ $user->email }}</div>
                @endif
                @if($user->profile?->address)
                <div class="icon-row" style="font-size: 9pt;">📍 {{ $user->profile->address }}</div>
                @endif
                @if($user->profile?->phone)
                <div class="icon-row" style="font-size: 9pt;">📱 {{ $user->profile->phone }}</div>
                @endif
            </div>

            {{-- COMPÉTENCES --}}
            @if($user->skills->isNotEmpty())
            <div class="section-spacing">
                <div class="section-title" style="color: #3b1066;">Compétences</div>
                @foreach($user->skills as $skill)
                <div style="margin-bottom: 2mm;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1mm;">
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

            {{-- RÉSEAUX --}}
            @if($user->profile?->linkedin_url || $user->profile?->github_url)
            <div class="section-spacing">
                <div class="section-title" style="color: #3b1066;">Réseaux</div>
                @if($user->profile?->linkedin_url)
                <div style="font-size: 9pt; margin-bottom: 2mm;"><span style="margin-right: 4px;">in</span><a href="{{ $user->profile->linkedin_url }}" target="_blank" style="color: #1a1a1a; text-decoration: none; font-weight: 600;">LinkedIn</a></div>
                @endif
                @if($user->profile?->github_url)
                <div style="font-size: 9pt;"><span style="margin-right: 4px;">gh</span><a href="{{ $user->profile->github_url }}" target="_blank" style="color: #1a1a1a; text-decoration: none; font-weight: 600;">GitHub</a></div>
                @endif
            </div>
            @endif

            {{-- LOISIRS --}}
            @if($user->hobbies->isNotEmpty())
            <div>
                <div class="section-title" style="color: #3b1066;">Loisirs</div>
                @foreach($user->hobbies as $hobby)
                <div style="font-size: 8pt; color: #374151; margin-bottom: 2mm;">{{ $hobby->name }}</div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    @if(!($forPdf ?? false))
    </div>
    @endif
</body>
</html>
