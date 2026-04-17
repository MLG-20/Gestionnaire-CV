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
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
    font-size: 11pt;
    line-height: 1.4;
    overflow: hidden;
    display: table;
  }
  .cv-sidebar {
    display: table-cell;
    width: 60mm;
    background: #f7f7f7;
    border-right: 1px solid #e5e7eb;
    padding: 14mm 10mm;
    vertical-align: top;
    overflow: hidden;
  }
  .cv-content {
    display: table-cell;
    padding: 14mm 12mm;
    vertical-align: top;
    background: white;
    overflow: hidden;
  }
  .section-title {
    font-size: 11pt;
    font-weight: 700;
    color: #1f2937;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
    padding-bottom: 3px;
    border-bottom: 2px solid var(--cv-primary, #ea580c);
    display: inline-block;
  }
  .main-name {
    font-size: 20pt;
    font-weight: 900;
  }
  .description-text {
    font-size: 10pt;
  }
  .item-spacing {
    margin-bottom: 8px;
  }
  .skill-bar {
    height: 5px;
    border-radius: 2px;
    background: #e5e7eb;
  }
  .skill-fill {
    height: 5px;
    border-radius: 2px;
    background: var(--cv-primary, #ea580c);
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
  .section-spacing {
    margin-bottom: 10mm;
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

        {{-- SIDEBAR GAUCHE --}}
        <div class="cv-sidebar">
            {{-- Photo --}}
            @if($user->photo_url)
            <div style="text-align: center; margin-bottom: 8mm;">
                <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                     style="width: 130px; height: 130px; object-fit: cover; border: 4px solid var(--cv-primary, #ea580c); box-shadow: 0 8px 24px rgba(0,0,0,0.25);">
            </div>
            @endif

            {{-- CONTACT --}}
            <div class="section-spacing">
                <div class="section-title">Contact</div>
                @if($user->profile?->phone)
                <div class="icon-row" style="font-size: 9pt;">📱 {{ $user->profile->phone }}</div>
                @endif
                @if($user->email)
                <div class="icon-row" style="font-size: 9pt;">✉ {{ $user->email }}</div>
                @endif
                @if($user->profile?->address)
                <div class="icon-row" style="font-size: 9pt;">📍 {{ $user->profile->address }}</div>
                @endif
                @if($user->profile?->linkedin_url)
                <div class="icon-row" style="font-size: 9pt;"><a href="{{ $user->profile->linkedin_url }}" target="_blank" style="color: #0077b5; text-decoration: none;">LinkedIn</a></div>
                @endif
            </div>

            {{-- COMPÉTENCES --}}
            @if($user->skills->isNotEmpty())
            <div class="section-spacing">
                <div class="section-title">Compétences</div>
                @foreach($user->skills as $skill)
                <div style="margin-bottom: 6px;">
                    <div style="font-size: 9pt; color: #374151; margin-bottom: 2px;">{{ $skill->name }}</div>
                    <div class="skill-bar">
                        <div class="skill-fill" style="width: {{ $skill->level_percentage }}%;"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- LOISIRS --}}
            @if($user->hobbies->isNotEmpty())
            <div>
                <div class="section-title">Loisirs</div>
                @foreach($user->hobbies as $hobby)
                <div style="font-size: 9pt; color: #374151; margin-bottom: 3px;">{{ $hobby->name }}</div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- CONTENU PRINCIPAL DROIT --}}
        <div class="cv-content">
            {{-- NOM + TITRE --}}
            <div style="margin-bottom: 8mm; padding-bottom: 6mm; border-bottom: 2px solid var(--cv-primary, #ea580c);">
                <div class="main-name">{{ $user->name }}</div>
                @if($user->profile?->profession)
                <div style="font-size: 9pt; color: #6b7280; margin-top: 2mm;">
                    {{ $user->profile->profession }}
                </div>
                @endif
            </div>

            {{-- À PROPOS --}}
            @if($user->profile?->professional_summary)
            <div style="margin-bottom: 8mm;">
                <div class="section-title">À propos</div>
                <p class="description-text" style="margin: 0; line-height: 1.4;">{{ $user->profile->professional_summary }}</p>
            </div>
            @endif

            {{-- EXPÉRIENCES --}}
            @if($user->experiences->isNotEmpty())
            <div style="margin-bottom: 8mm;">
                <div class="section-title">Expériences</div>
                @foreach($user->experiences as $experience)
                <div class="item-spacing" style="margin-bottom: 6mm;">
                    <div style="display: flex; justify-content: space-between;">
                        <div style="font-weight: 700; color: var(--cv-primary, #ea580c); font-size: 10pt;">{{ $experience->job_title }}</div>
                        <div style="font-size: 9pt; color: #9ca3af;">{{ $experience->date_range }}</div>
                    </div>
                    <div style="font-size: 10pt; color: #6b7280;">{{ $experience->company }}@if($experience->location), {{ $experience->location }}@endif</div>
                    @if($experience->description)
                    <div class="description-text" style="line-height: 1.4;">{{ $experience->description }}</div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            {{-- FORMATION --}}
            @if($user->educations->isNotEmpty())
            <div style="margin-bottom: 8mm;">
                <div class="section-title">Formation</div>
                @foreach($user->educations as $education)
                <div class="item-spacing" style="margin-bottom: 6mm;">
                    <div style="display: flex; justify-content: space-between;">
                        <div style="font-weight: 700; color: var(--cv-primary, #ea580c); font-size: 10pt;">{{ $education->degree }}</div>
                        @if($education->graduation_year)
                        <div style="font-size: 9pt; color: #9ca3af;">{{ $education->graduation_year }}</div>
                        @endif
                    </div>
                    <div style="font-size: 10pt; color: #6b7280;">{{ $education->school }}</div>
                    @if($education->description)<div class="description-text" style="line-height: 1.4;">{{ $education->description }}</div>@endif
                </div>
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
