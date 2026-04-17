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
            color: white;
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
            font-size: 10pt;
            line-height: 1.3;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background: #1a3340;
            color: white;
        }
        .header-top {
            padding: 10mm 12mm 6mm;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            flex-shrink: 0;
        }
        .main-name {
            font-size: 20pt;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
            line-height: 1;
            margin-bottom: 2mm;
        }
        .profession {
            font-size: 9pt;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #2dd4bf;
        }
        .middle-section {
            display: table;
            width: 100%;
            flex-shrink: 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .middle-left {
            display: table-cell;
            width: 50%;
            padding: 8mm;
            vertical-align: top;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        .middle-contact {
            display: table-cell;
            width: 25%;
            padding: 8mm;
            vertical-align: top;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        .middle-social {
            display: table-cell;
            width: 25%;
            padding: 8mm;
            vertical-align: top;
        }
        .bottom-section {
            display: table;
            width: 100%;
            overflow: hidden;
        }
        .bottom-col {
            display: table-cell;
            width: 33.33%;
            padding: 8mm;
            vertical-align: top;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        .bottom-col:last-child {
            border-right: none;
        }
        .section-title {
            font-size: 10pt;
            font-weight: 700;
            color: #2dd4bf;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 3mm;
            padding-bottom: 2mm;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }
        .photo-bio {
            display: table;
            width: 100%;
            margin-bottom: 2mm;
        }
        .photo-cell {
            display: table-cell;
            width: 120px;
            padding-right: 6mm;
            vertical-align: top;
        }
        .photo-cell img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid #2dd4bf;
            object-fit: cover;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
        }
        .bio-cell {
            display: table-cell;
            vertical-align: top;
            font-size: 9pt;
            color: rgba(255,255,255,0.75);
            line-height: 1.3;
        }
        .contact-item {
            font-size: 9pt;
            color: rgba(255,255,255,0.7);
            margin-bottom: 2mm;
            line-height: 1.3;
            word-break: break-word;
        }
        .social-item {
            font-size: 9pt;
            color: rgba(255,255,255,0.7);
            margin-bottom: 3mm;
            line-height: 1.3;
        }
        .social-label {
            font-weight: 700;
            color: #2dd4bf;
            display: block;
            margin-bottom: 1mm;
        }
        .item-box {
            margin-bottom: 4mm;
        }
        .item-header {
            display: table;
            width: 100%;
            margin-bottom: 1mm;
        }
        .item-year {
            display: table-cell;
            background: #2dd4bf;
            color: #1a3340;
            font-size: 9pt;
            font-weight: 700;
            padding: 1mm 2mm;
            text-align: center;
            border-radius: 2px;
            width: 30px;
            flex-shrink: 0;
        }
        .item-title {
            display: table-cell;
            padding-left: 3mm;
            vertical-align: middle;
            font-size: 9pt;
            font-weight: 700;
            color: white;
        }
        .item-company {
            font-size: 9pt;
            color: #2dd4bf;
            margin-bottom: 1mm;
            padding-left: 33mm;
        }
        .item-desc {
            font-size: 9pt;
            color: rgba(255,255,255,0.65);
            line-height: 1.3;
            padding-left: 33mm;
            margin-top: 1mm;
        }
        .skill-item {
            margin-bottom: 2mm;
        }
        .skill-header {
            display: table;
            width: 100%;
            margin-bottom: 1mm;
        }
        .skill-name {
            display: table-cell;
            font-size: 9pt;
            color: white;
        }
        .skill-level {
            display: table-cell;
            text-align: right;
            font-size: 8pt;
            color: rgba(255,255,255,0.5);
        }
        .skill-bar {
            height: 4px;
            background: rgba(255,255,255,0.15);
            border-radius: 2px;
            overflow: hidden;
        }
        .skill-fill {
            height: 4px;
            background: #2dd4bf;
            border-radius: 2px;
        }
        .hobby-item {
            font-size: 9pt;
            color: rgba(255,255,255,0.75);
            margin-bottom: 1mm;
        }
    </style>
</head>
<body>
    @if(!($forPdf ?? false))
    <div class="cv-page-wrapper">
    @endif
    <div class="cv-container">
        {{-- HEADER --}}
        <div class="header-top">
            <div class="main-name">{{ strtoupper($user->name) }}</div>
            @if($user->profile?->profession)
            <div class="profession">{{ mb_strtoupper($user->profile->profession) }}</div>
            @endif
        </div>

        {{-- MIDDLE --}}
        <div class="middle-section">
            <div class="middle-left">
                <div class="photo-bio">
                    @if($user->photo_url)
                    <div class="photo-cell">
                        <img src="{{ $user->photo_url }}" alt="{{ $user->name }}">
                    </div>
                    @endif
                    <div class="bio-cell">
                        @if($user->profile?->professional_summary)
                        {{ $user->profile->professional_summary }}
                        @endif
                    </div>
                </div>
            </div>

            <div class="middle-contact">
                <div class="section-title">CONTACT</div>
                @if($user->profile?->address)
                <div class="contact-item">📍 {{ $user->profile->address }}</div>
                @endif
                @if($user->email)
                <div class="contact-item">✉ {{ $user->email }}</div>
                @endif
                @if($user->profile?->phone)
                <div class="contact-item">📱 {{ $user->profile->phone }}</div>
                @endif
            </div>

            <div class="middle-social">
                <div class="section-title">RÉSEAUX</div>
                @if($user->profile?->linkedin_url)
                <div class="social-item">
                    <span class="social-label">in</span>
                    {{ $user->profile->linkedin_url }}
                </div>
                @endif
                @if($user->profile?->github_url)
                <div class="social-item">
                    <span class="social-label">gh</span>
                    {{ $user->profile->github_url }}
                </div>
                @endif
            </div>
        </div>

        {{-- BOTTOM (3 COLUMNS) --}}
        <div class="bottom-section">
            {{-- EXPÉRIENCES --}}
            <div class="bottom-col">
                <div class="section-title">EXPÉRIENCE</div>
                @if($user->experiences->isNotEmpty())
                @foreach($user->experiences as $experience)
                <div class="item-box">
                    <div class="item-header">
                        <div class="item-year">{{ mb_substr($experience->date_range, -4, 4) }}</div>
                        <div class="item-title">{{ $experience->job_title }}</div>
                    </div>
                    <div class="item-company">{{ $experience->company }}</div>
                    @if($experience->description)
                    <div class="item-desc">{{ $experience->description }}</div>
                    @endif
                </div>
                @endforeach
                @endif
            </div>

            {{-- FORMATION --}}
            <div class="bottom-col">
                <div class="section-title">FORMATION</div>
                @if($user->educations->isNotEmpty())
                @foreach($user->educations as $education)
                <div class="item-box">
                    <div class="item-header">
                        @if($education->graduation_year)
                        <div class="item-year">{{ $education->graduation_year }}</div>
                        @endif
                        <div class="item-title">{{ $education->degree }}</div>
                    </div>
                    <div class="item-company">{{ $education->school }}</div>
                    @if($education->description)
                    <div class="item-desc">{{ $education->description }}</div>
                    @endif
                </div>
                @endforeach
                @endif
            </div>

            {{-- COMPÉTENCES + LOISIRS --}}
            <div class="bottom-col">
                @if($user->skills->isNotEmpty())
                <div style="margin-bottom: 8mm;">
                    <div class="section-title">COMPÉTENCES</div>
                    @foreach($user->skills as $skill)
                    <div class="skill-item">
                        <div class="skill-header">
                            <div class="skill-name">{{ $skill->name }}</div>
                            <div class="skill-level">{{ $skill->level_label }}</div>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-fill" style="width: {{ $skill->level_percentage }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                @if($user->hobbies->isNotEmpty())
                <div>
                    <div class="section-title">LOISIRS</div>
                    @foreach($user->hobbies as $hobby)
                    <div class="hobby-item">♦ {{ $hobby->name }}</div>
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
@extends('layouts.cv')

@section('styles')
<style>
  * {
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
    color-adjust: exact !important;
  }
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
    background: var(--cv-primary, #2dd4bf);
  }
  .long-links {
    word-break: break-all;
    overflow: hidden;
    max-width: 100%;
  }
</style>
@endsection

@section('content')
<div class="cv-container" style="font-family: Arial, sans-serif; width: 210mm; min-height: 297mm; background: #1a3340; margin: 0; padding: 10mm; box-sizing: border-box; color: white;">

    {{-- ===== HEADER TOP ===== --}}
    <div class="section-spacing" style="padding: 28px 32px 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1);">
        <div class="main-name" style="font-size: 22pt; font-weight: 900; letter-spacing: 4px; color: white; text-transform: uppercase; line-height: 1.1;">{{ $user->name }}</div>
        @if($user->profile?->professional_summary)
        <div class="description-text" style="font-size: 10pt; letter-spacing: 3px; text-transform: uppercase; color: var(--cv-primary, #2dd4bf); margin-top: 6px;">
            {{ mb_strtoupper(mb_substr(strip_tags($user->profile->professional_summary), 0, 60)) }}
        </div>
        @endif
    </div>

    {{-- ===== SECTION MILIEU: PHOTO + CONTACT + SOCIAL ===== --}}
    <div class="section-spacing" style="display: table; width: 100%; border-bottom: 1px solid rgba(255,255,255,0.1);">
        <div style="display: table-cell; width: 50%; padding: 20px 24px; vertical-align: top; border-right: 1px solid rgba(255,255,255,0.1);">
            <div style="display: table; width: 100%;">
                <div style="display: table-cell; vertical-align: top; width: 130px; padding-right: 14px;">
                    @if($user->photo_url)
                    <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                         style="width: 110px; height: 110px; border-radius: 50%; border: 4px solid var(--cv-primary, #2dd4bf); object-fit: cover; display: block; box-shadow: 0 8px 24px rgba(0,0,0,0.3);">
                    @endif
                </div>
                <div style="display: table-cell; vertical-align: top;">
                    @if($user->profile?->professional_summary)
                    <p class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.75); line-height: 1.5; margin: 0;">{{ $user->profile->professional_summary }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Contact --}}
        <div class="section-spacing" style="display: table-cell; width: 25%; padding: 20px 18px; vertical-align: top; border-right: 1px solid rgba(255,255,255,0.1);">
            <div class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #2dd4bf); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">CONTACT</div>
            @if($user->profile?->address)
            <div class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.7); margin-bottom: 6px; line-height: 1.5;">&#8962; {{ $user->profile->address }}</div>
            @endif
            @if($user->email)
            <div class="long-links" style="font-size: 10pt; color: rgba(255,255,255,0.7); margin-bottom: 6px; word-break: break-all; overflow: hidden; max-width: 100%;">&#9993; {{ $user->email }}</div>
            @endif
            @if($user->profile?->phone)
            <div class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.7); margin-bottom: 6px;">&#9990; {{ $user->profile->phone }}</div>
            @endif
        </div>

        {{-- Réseaux --}}
        <div class="section-spacing" style="display: table-cell; width: 25%; padding: 20px 18px; vertical-align: top;">
            <div class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #2dd4bf); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">RÉSEAUX</div>
            @if($user->profile?->linkedin_url)
            <div class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.7); margin-bottom: 7px;">
                <span style="font-weight: 700; color: var(--cv-primary, #2dd4bf);">in</span><br>{{ $user->profile->linkedin_url }}
            </div>
            @endif
            @if($user->profile?->github_url)
            <div class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.7); margin-bottom: 7px;">
                <span style="font-weight: 700; color: var(--cv-primary, #2dd4bf);">gh</span><br>{{ $user->profile->github_url }}
            </div>
            @endif
            @if($user->profile?->website_url)
            <div class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.7);">
                <span style="font-weight: 700; color: var(--cv-primary, #2dd4bf);">web</span><br>{{ $user->profile->website_url }}
            </div>
            @endif
        </div>
    </div>

    {{-- ===== SECTION BAS: EXPÉRIENCE | FORMATION | COMPÉTENCES ===== --}}
    <div style="display: table; width: 100%;">

        {{-- EXPÉRIENCES --}}
        <div class="section-spacing" style="display: table-cell; width: 34%; padding: 20px 18px; vertical-align: top; border-right: 1px solid rgba(255,255,255,0.1);">
            <div class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #2dd4bf); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 14px; padding-bottom: 6px; border-bottom: 1px solid rgba(255,255,255,0.15);">EXPÉRIENCE</div>
            @if($user->experiences->isNotEmpty())
            @foreach($user->experiences as $experience)
            <div class="item-spacing" style="margin-bottom: 10px;">
                <div style="display: table; width: 100%; margin-bottom: 4px;">
                    <div style="display: table-cell; vertical-align: top; width: 32px;">
                        <div class="description-text" style="background: var(--cv-primary, #2dd4bf); color: #1a3340; font-size: 10pt; font-weight: 700; padding: 2px 3px; text-align: center; border-radius: 2px;">{{ mb_substr($experience->date_range, -4, 4) }}</div>
                    </div>
                    <div style="display: table-cell; vertical-align: top; padding-left: 6px;">
                        <div style="font-size: 10pt; font-weight: 700; color: white;">{{ $experience->job_title }}</div>
                    </div>
                </div>
                <div class="description-text" style="font-size: 10pt; color: var(--cv-primary, #2dd4bf); padding-left: 38px;">{{ $experience->company }}</div>
                @if($experience->description)
                <div class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.65); line-height: 1.5; padding-left: 38px; margin-top: 3px;">{{ $experience->description }}</div>
                @endif
            </div>
            @endforeach
            @endif
        </div>

        {{-- FORMATION --}}
        <div class="section-spacing" style="display: table-cell; width: 33%; padding: 20px 18px; vertical-align: top; border-right: 1px solid rgba(255,255,255,0.1);">
            <div class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #2dd4bf); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 14px; padding-bottom: 6px; border-bottom: 1px solid rgba(255,255,255,0.15);">FORMATION</div>
            @if($user->educations->isNotEmpty())
            @foreach($user->educations as $education)
            <div class="item-spacing" style="margin-bottom: 10px;">
                <div style="display: table; width: 100%; margin-bottom: 4px;">
                    <div style="display: table-cell; vertical-align: top; width: 32px;">
                        @if($education->graduation_year)
                        <div class="description-text" style="background: var(--cv-primary, #2dd4bf); color: #1a3340; font-size: 10pt; font-weight: 700; padding: 2px 3px; text-align: center; border-radius: 2px;">{{ $education->graduation_year }}</div>
                        @endif
                    </div>
                    <div style="display: table-cell; vertical-align: top; padding-left: 6px;">
                        <div style="font-size: 10pt; font-weight: 700; color: white;">{{ $education->degree }}</div>
                    </div>
                </div>
                <div class="description-text" style="font-size: 10pt; color: var(--cv-primary, #2dd4bf); padding-left: 38px;">{{ $education->school }}</div>
                @if($education->description)
                <div class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.65); line-height: 1.5; padding-left: 38px; margin-top: 3px;">{{ $education->description }}</div>
                @endif
            </div>
            @endforeach
            @endif
        </div>

        {{-- COMPÉTENCES + LOISIRS --}}
        <div class="section-spacing" style="display: table-cell; width: 33%; padding: 20px 18px; vertical-align: top;">
            @if($user->skills->isNotEmpty())
            <div class="section-spacing" style="margin-bottom: 18px; padding: 10px;">
                <div class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #2dd4bf); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px; padding-bottom: 6px; border-bottom: 1px solid rgba(255,255,255,0.15);">COMPÉTENCES</div>
                @foreach($user->skills as $skill)
                <div class="item-spacing" style="margin-bottom: 9px;">
                    <div style="display: table; width: 100%; margin-bottom: 3px;">
                        <div style="display: table-cell; font-size: 10pt; color: white;">{{ $skill->name }}</div>
                        <div style="display: table-cell; text-align: right; font-size: 10pt; color: rgba(255,255,255,0.5);">{{ $skill->level_label }}</div>
                    </div>
                    <div class="skill-bar" style="background: rgba(255,255,255,0.15); height: 6px; border-radius: 2px;">
                        <div class="skill-fill" style="background: var(--cv-primary, #2dd4bf); height: 6px; border-radius: 2px; width: {{ $skill->level_percentage }}%;"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($user->hobbies->isNotEmpty())
            <div class="section-spacing" style="margin-bottom: 18px; padding: 10px;">
                <div class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #2dd4bf); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px; padding-bottom: 6px; border-bottom: 1px solid rgba(255,255,255,0.15);">LOISIRS</div>
                @foreach($user->hobbies as $hobby)
                <div class="description-text" style="font-size: 10pt; color: rgba(255,255,255,0.75); margin-bottom: 5px;">&#9830; {{ $hobby->name }}</div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
