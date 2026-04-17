@extends('layouts.cv')

@section('styles')
<style>
  @page {
    margin: 0;
    padding: 0;
    size: A4;
  }
  * {
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
    color-adjust: exact !important;
  }
  html, body {
    margin: 0 !important;
    padding: 0 !important;
    width: 210mm !important;
    height: 297mm !important;
    background-color: #e0e0e0;
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
  }
  .cv-container {
    display: table;
    width: 210mm;
    height: 297mm;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
    font-size: 10pt;
    line-height: 1.5;
    overflow: hidden;
  }
  .section-title {
    font-size: 11pt;
    font-weight: bold;
  }
  .main-name {
    font-size: 20pt;
    font-weight: bold;
  }
  .description-text {
    font-size: 10pt;
  }
  .section-spacing {
    margin-bottom: 6px;
    padding: 6px;
  }
  .item-spacing {
    margin-bottom: 8px;
  }
  .skill-bar {
    height: 6px;
    border-radius: 3px;
    background: #e0e0e0;
  }
  .skill-fill {
    height: 6px;
    border-radius: 3px;
    background: var(--cv-primary, #0f4c75);
  }
  .long-links {
    word-break: break-all;
    overflow: hidden;
    max-width: 100%;
  }
  .sidebar {
    display: table-cell;
    width: 28%;
    background-color: var(--cv-primary, #0f4c75) !important;
    vertical-align: top;
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
    overflow: hidden;
    height: 297mm;
  }
  .main-content {
    display: table-cell;
    width: 72%;
    vertical-align: top;
  }
  .formation-description {
    overflow: hidden;
    max-height: 2.8em;
  }
</style>
@endsection

@section('content')
@php
    $githubText = $user->profile?->github_url ?
        basename(rtrim($user->profile->github_url, '/')) : '';
    $linkedinText = $user->profile?->linkedin_url ?
        basename(rtrim($user->profile->linkedin_url, '/')) : '';
    $siteText = $user->profile?->website_url ?
        str_replace(['https://', 'http://'], '',
        $user->profile->website_url) : '';

    // Profession pour le sous-titre
    $profession = $user->profile->profession ??
                  $user->profile->job_title ??
                  'Développeur Web';

    // S'assurer que les URLs commencent par https://
    $linkedinUrl = $user->profile?->linkedin_url;
    if ($linkedinUrl && !str_starts_with($linkedinUrl, 'http')) {
        $linkedinUrl = 'https://' . $linkedinUrl;
    }

    $githubUrl = $user->profile?->github_url;
    if ($githubUrl && !str_starts_with($githubUrl, 'http')) {
        $githubUrl = 'https://' . $githubUrl;
    }

    $websiteUrl = $user->profile?->website_url;
    if ($websiteUrl && !str_starts_with($websiteUrl, 'http')) {
        $websiteUrl = 'https://' . $websiteUrl;
    }
@endphp
<div class="cv-container" style="font-family: Arial, sans-serif; display: table; width: 210mm; height: 297mm; background: white; margin: 0; padding: 0; box-sizing: border-box; overflow: hidden;">

    {{-- ===== SIDEBAR GAUCHE STANDARD ===== --}}
    <div style="display: table-cell; width: 28%; background: var(--cv-primary, #0f4c75); color: white; padding: 30px 20px; vertical-align: top;" class="sidebar">

        {{-- Photo --}}
        <div class="section-spacing" style="text-align: center; margin-bottom: 28px; padding: 15px;">
            @if($user->photo_url)
            <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                 style="width: 130px; height: 130px; border-radius: 50%; border: 5px solid rgba(255,255,255,0.5); object-fit: cover; display: inline-block; box-shadow: 0 8px 24px rgba(0,0,0,0.35);">
            @endif
            <div class="main-name" style="font-size: 13pt; font-weight: 700; color: white; margin-top: 10px; line-height: 1.2;">{{ $user->name }}</div>
            @if($profession)
            <div style="font-size: 10pt; color: white; margin-top: 6px; line-height: 1.3; font-weight: 600; letter-spacing: 0.5px;">{{ $profession }}</div>
            @endif
        </div>

        {{-- CONTACT --}}
        <div class="section-spacing" style="margin-bottom: 18px; padding: 6px; padding-bottom: 15px; border-bottom: 1px solid rgba(248, 245, 245, 0.15);">
            <div class="section-title" style="font-size: 9pt; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: white; margin-bottom: 8px;">Contact</div>
            @if($user->email)
            <a href="mailto:{{ $user->email ?? '' }}" class="sidebar-email" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 7pt; margin-bottom: 4px; display: block; word-break: break-all; line-height: 1.2;">{{ $user->email }}</a>
            @endif
            @if($user->profile?->phone)
            <a href="tel:{{ $user->profile?->phone ?? '' }}" class="description-text" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 8pt; margin-bottom: 4px;">{{ $user->profile->phone }}</a>
            @endif
            @if($user->profile?->address)
            <div class="description-text" style="font-size: 8pt; color: rgba(255,255,255,0.8); margin-bottom: 4px; line-height: 1.4;">{{ $user->profile->address }}</div>
            @endif
        </div>

        {{-- RÉSEAUX --}}
        @if($user->profile?->linkedin_url || $user->profile?->github_url || $user->profile?->website_url)
        <div style="margin-bottom: 18px; padding: 6px; padding-bottom: 15px; border-bottom: 1px solid rgba(255,255,255,0.15);">
            <div style="font-size: 8pt; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: white; margin-bottom: 8px;">Réseaux</div>
            @if($user->profile->linkedin_url)
            <a href="{{ $linkedinUrl }}" class="description-text" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 8pt; margin-bottom: 4px; display: block;">
                <span style="font-weight: 700;">in</span> {{ $linkedinText }}
            </a>
            @endif
            @if($user->profile->github_url)
            <a href="{{ $githubUrl }}" class="description-text" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 8pt; margin-bottom: 4px; display: block;">
                <span style="font-weight: 700;">gh</span> {{ $githubText }}
            </a>
            @endif
            @if($user->profile->website_url)
            <a href="{{ $websiteUrl }}" class="description-text" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 8pt; margin-bottom: 4px; display: block;">
                <span style="font-weight: 700;">web</span> {{ $siteText }}
            </a>
            @endif
        </div>
        @endif

        {{-- COMPÉTENCES --}}
        @if($user->skills->isNotEmpty())
        <div class="section-spacing" style="margin-bottom: 18px; padding-bottom: 15px; border-bottom: 1px solid rgba(255,255,255,0.15);">
            <div class="section-title" style="font-size: 9pt; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: white; margin-bottom: 8px;">Compétences</div>
            @foreach($user->skills as $skill)
            <div class="item-spacing" style="margin-bottom: 6px;">
                <div style="display: table; width: 100%; margin-bottom: 2px;">
                    <div style="display: table-cell; font-size: 8pt; color: white;">{{ $skill->name }}</div>
                    <div style="display: table-cell; text-align: right; font-size: 8pt; color: rgba(255,255,255,0.55);">{{ $skill->level_label }}</div>
                </div>
                <div class="skill-bar" style="background: rgba(255,255,255,0.15); height: 6px; border-radius: 2px;">
                    <div class="skill-fill" style="background: var(--cv-secondary, #90cdf4); height: 6px; border-radius: 2px; width: {{ $skill->level_percentage }}%;"></div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- LOISIRS --}}
        @if($user->hobbies->isNotEmpty())
        <div class="section-spacing" style="margin-bottom: 18px; padding: 10px;">
            <div class="section-title" style="font-size: 9pt; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: white; margin-bottom: 8px;">Loisirs</div>
            @foreach($user->hobbies as $hobby)
            <span class="description-text" style="display: inline-block; background: rgba(255,255,255,0.12); font-size: 8pt; color: rgba(255,255,255,0.85); padding: 2px 6px; border-radius: 8px; margin: 1px 1px 1px 0;">{{ $hobby->name }}</span>
            @endforeach
        </div>
        @endif
    </div>

    {{-- ===== CONTENU PRINCIPAL ===== --}}
    <div style="display: table-cell; padding: 30px 26px 30px 30px; vertical-align: top; background: white;" class="main-content">

        {{-- RÉSUMÉ --}}
        @if($user->profile?->professional_summary)
        <div class="section-spacing" style="margin-bottom: 20px; padding: 10px;">
            <div style="display: table; width: 100%; margin-bottom: 8px;">
                <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                    <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #0f4c75); text-transform: uppercase; letter-spacing: 1.5px;">Profil Professionnel</span>
                </div>
                <div style="display: table-cell; vertical-align: middle; padding-left: 8px;">
                    <div style="height: 2px; background: var(--cv-primary, #0f4c75);"></div>
                </div>
            </div>
            <p class="description-text" style="font-size: 10pt; color: #4b5563; line-height: 1.5; margin: 0;">{{ $user->profile->professional_summary }}</p>
        </div>
        @endif

        {{-- EXPÉRIENCES --}}
        @if($user->experiences->isNotEmpty())
        <div class="section-spacing" style="margin-bottom: 20px; padding: 10px;">
            <div style="display: table; width: 100%; margin-bottom: 10px;">
                <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                    <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #0f4c75); text-transform: uppercase; letter-spacing: 1.5px;">Expériences</span>
                </div>
                <div style="display: table-cell; vertical-align: middle; padding-left: 8px;">
                    <div style="height: 2px; background: var(--cv-primary, #0f4c75);"></div>
                </div>
            </div>
            @foreach($user->experiences as $experience)
            <div class="item-spacing" style="margin-bottom: 5px; padding: 4px 0 4px 12px; border-left: 3px solid var(--cv-primary, #0f4c75);">
                <div style="display: table; width: 100%; margin-bottom: 2px;">
                    <div style="display: table-cell; font-size: 11pt; font-weight: 700; color: #1f2937;">{{ $experience->job_title }}</div>
                    <div style="display: table-cell; text-align: right; font-size: 10pt; color: #9ca3af; white-space: nowrap;">{{ $experience->date_range }}</div>
                </div>
                <div style="font-size: 11pt; color: var(--cv-primary, #0f4c75); font-weight: 600; margin-bottom: 3px;">{{ $experience->company }}@if($experience->location) &mdash; {{ $experience->location }}@endif</div>
                @if($experience->description)
                <div class="description-text" style="font-size: 10pt; color: #6b7280; line-height: 1.5;">{{ $experience->description }}</div>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        {{-- FORMATION --}}
        @if($user->educations->isNotEmpty())
        <div class="section-spacing" style="margin-bottom: 20px; padding: 10px;">
            <div style="display: table; width: 100%; margin-bottom: 10px;">
                <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                    <span class="section-title" style="font-size: 11pt; font-weight: 700; color: var(--cv-primary, #0f4c75); text-transform: uppercase; letter-spacing: 1.5px;">Formation</span>
                </div>
                <div style="display: table-cell; vertical-align: middle; padding-left: 8px;">
                    <div style="height: 2px; background: var(--cv-primary, #0f4c75);"></div>
                </div>
            </div>
            @foreach($user->educations as $education)
            <div class="item-spacing" style="margin-bottom: 5px; padding: 4px 0 4px 12px; border-left: 3px solid var(--cv-primary, #0f4c75);">
                <div style="display: table; width: 100%;">
                    <div style="display: table-cell; font-size: 11pt; font-weight: 700; color: #1f2937;">{{ $education->degree }}</div>
                    @if($education->graduation_year)
                    <div style="display: table-cell; text-align: right; font-size: 10pt; color: #9ca3af; white-space: nowrap;">{{ $education->graduation_year }}</div>
                    @else
                    <div style="display: table-cell; text-align: right; font-size: 10pt; color: #9ca3af; white-space: nowrap;">En cours</div>
                    @endif
                </div>
                <div style="font-size: 11pt; color: var(--cv-primary, #0f4c75); font-weight: 600;">{{ $education->school }}</div>
                @if($education->field_of_study)
                <div style="font-size: 9pt; color: #6b7280; margin-top: 2px;">{{ $education->field_of_study }}</div>
                @endif
                @if($education->description)
                <div class="formation-description" style="font-size: 9pt; color: #6b7280; margin-top: 3px; line-height: 1.3;">{{ $education->description }}</div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
