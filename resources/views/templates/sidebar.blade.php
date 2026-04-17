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
    padding: 5mm;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
    font-size: 9pt;
    line-height: 1.3;
    overflow: hidden;
  }
  .section-title {
    font-size: 11pt;
    font-weight: bold;
  }
  .main-name {
    font-size: 18pt;
    font-weight: bold;
  }
  .description-text {
    font-size: 9pt;
  }
  .section-spacing {
    margin-bottom: 3px;
    padding: 2px;
  }
  .item-spacing {
    margin-bottom: 2px;
  }
  .skill-bar {
    height: 6px;
    border-radius: 3px;
    background: #e0e0e0;
  }
  .skill-fill {
    height: 6px;
    border-radius: 3px;
    background: var(--cv-primary, #4a5568);
  }
  .long-links {
    word-break: break-all;
    overflow: hidden;
    max-width: 100%;
  }
</style>
@endsection

@section('content')
<div class="cv-container" style="font-family: Arial, sans-serif; display: table; width: 210mm; height: 297mm; background: white; margin: 0; padding: 6mm 8mm; box-sizing: border-box; overflow: hidden;">

    {{-- ===== SIDEBAR GAUCHE ===== --}}
    <div style="display: table-cell; width: 72mm; background: #4a5568; color: white; padding: 8px 10px; vertical-align: top; overflow: hidden; height: 100%;">

        {{-- Photo --}}
        <div class="section-spacing" style="text-align: center; margin-bottom: 8px; padding: 8px;">
            @if($user->photo_url)
            <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                 style="width: 120px; height: 120px; border-radius: 50%; border: 4px solid rgba(255,255,255,0.5); object-fit: cover; display: inline-block; box-shadow: 0 8px 24px rgba(0,0,0,0.35);">
            @endif
            <div class="main-name" style="font-size: 11pt; font-weight: 700; color: white; margin-top: 6px; line-height: 1.2;">{{ strtoupper($user->name) }}</div>
            @if($user->profile?->profession)
            <div class="description-text" style="font-size: 8pt; color: white; margin-top: 3px; letter-spacing: 1px; text-transform: uppercase;">{{ $user->profile->profession }}</div>
            @endif
        </div>

        {{-- CONTACT --}}
        <div class="section-spacing" style="margin-bottom: 12px; padding: 8px;">
            <div style="background: rgba(255,255,255,0.18); padding: 4px 8px; margin-bottom: 6px; border-left: 3px solid var(--cv-secondary, #94a3b8);">
                <span class="section-title" style="font-size: 10pt; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">CONTACT</span>
            </div>
            @if($user->profile?->phone)
            <div class="item-spacing" style="display: table; width: 100%; margin-bottom: 5px;">
                <div style="display: table-cell; width: 16px; vertical-align: top;">
                    <span style="font-size: 10pt; color: var(--cv-secondary, #94a3b8);">&#9990;</span>
                </div>
                <div class="description-text" style="display: table-cell; font-size: 9pt; vertical-align: top; line-height: 1.3;">{{ $user->profile->phone }}</div>
            </div>
            @endif
            @if($user->email)
            <div class="item-spacing" style="display: table; width: 100%; margin-bottom: 5px;">
                <div style="display: table-cell; width: 16px; vertical-align: top;">
                    <span style="font-size: 10pt; color: var(--cv-secondary, #94a3b8);">@</span>
                </div>
                <div class="long-links" style="display: table-cell; font-size: 9pt; vertical-align: top; line-height: 1.3; word-break: break-all; overflow: hidden; max-width: 100%;">{{ $user->email }}</div>
            </div>
            @endif
            @if($user->profile?->address)
            <div class="item-spacing" style="display: table; width: 100%; margin-bottom: 5px;">
                <div style="display: table-cell; width: 16px; vertical-align: top;">
                    <span style="font-size: 10pt; color: var(--cv-secondary, #94a3b8);">&#8962;</span>
                </div>
                <div class="description-text" style="display: table-cell; font-size: 9pt; vertical-align: top; line-height: 1.3;">{{ $user->profile->address }}</div>
            </div>
            @endif
        </div>

        {{-- RÉSEAU --}}
        @if($user->profile?->linkedin_url || $user->profile?->github_url || $user->profile?->website_url)
        <div class="section-spacing" style="margin-bottom: 12px; padding: 8px;">
            <div style="background: rgba(255,255,255,0.18); padding: 4px 8px; margin-bottom: 6px; border-left: 3px solid var(--cv-secondary, #94a3b8);">
                <span class="section-title" style="font-size: 10pt; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">RÉSEAU</span>
            </div>
            @if($user->profile->linkedin_url)
            <div class="description-text" style="font-size: 9pt; margin-bottom: 4px; padding-left: 4px;">
                <span style="color: var(--cv-secondary, #94a3b8); font-weight: 700;">in</span> {{ $user->profile->linkedin_url }}
            </div>
            @endif
            @if($user->profile->github_url)
            <div class="description-text" style="font-size: 9pt; margin-bottom: 4px; padding-left: 4px;">
                <span style="color: var(--cv-secondary, #94a3b8); font-weight: 700;">gh</span> {{ $user->profile->github_url }}
            </div>
            @endif
            @if($user->profile->website_url)
            <div class="description-text" style="font-size: 9pt; margin-bottom: 4px; padding-left: 4px;">
                <span style="color: var(--cv-secondary, #94a3b8); font-weight: 700;">web</span> {{ $user->profile->website_url }}
            </div>
            @endif
        </div>
        @endif

        {{-- COMPÉTENCES --}}
        @if($user->skills->isNotEmpty())
        <div class="section-spacing" style="margin-bottom: 12px; padding: 8px;">
            <div style="background: rgba(255,255,255,0.18); padding: 4px 8px; margin-bottom: 6px; border-left: 3px solid var(--cv-secondary, #94a3b8);">
                <span class="section-title" style="font-size: 10pt; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">COMPÉTENCES</span>
            </div>
            @foreach($user->skills as $skill)
            <div class="item-spacing" style="margin-bottom: 7px;">
                <div style="display: table; width: 100%; margin-bottom: 2px;">
                    <div style="display: table-cell; font-size: 9pt;">{{ $skill->name }}</div>
                    <div style="display: table-cell; text-align: right; font-size: 8px; color: rgba(255,255,255,0.55);">{{ $skill->level_label }}</div>
                </div>
                <div class="skill-bar" style="background: rgba(255,255,255,0.2); height: 5px; border-radius: 2px;">
                    <div class="skill-fill" style="background: var(--cv-primary, #63b3ed); height: 5px; border-radius: 2px; width: {{ $skill->level_percentage }}%;"></div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- LOISIRS --}}
        @if($user->hobbies->isNotEmpty())
        <div class="section-spacing" style="margin-bottom: 0; padding: 8px;">
            <div style="background: rgba(255,255,255,0.18); padding: 4px 8px; margin-bottom: 6px; border-left: 3px solid var(--cv-secondary, #94a3b8);">
                <span class="section-title" style="font-size: 10pt; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">LOISIRS</span>
            </div>
            @foreach($user->hobbies as $hobby)
            <div class="description-text" style="font-size: 10pt; margin-bottom: 5px; padding-left: 6px;">
                <span style="color: var(--cv-secondary, #94a3b8);">&#8226;</span> {{ $hobby->name }}
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- ===== CONTENU PRINCIPAL ===== --}}
    <div style="display: table-cell; padding: 8px 12px; vertical-align: top; background: white; overflow: hidden; height: 100%;">

        {{-- NOM --}}
        <div class="section-spacing" style="margin-bottom: 12px; border-bottom: 2px solid #f3f4f6; padding-bottom: 10px;">
            <div class="main-name" style="font-size: 20pt; font-weight: 900; color: #1f2937; letter-spacing: 2px; line-height: 1.1;">{{ $user->name }}</div>
            @if($user->profile?->professional_summary)
            <div class="description-text" style="font-size: 10pt; letter-spacing: 2px; text-transform: uppercase; color: var(--cv-primary, #3b82f6); margin-top: 3px; border-top: 1px solid #e5e7eb; padding-top: 3px;">
                {{ mb_strtoupper(mb_substr(strip_tags($user->profile->professional_summary), 0, 55)) }}
            </div>
            @endif
        </div>

        {{-- A PROPOS --}}
        @if($user->profile?->professional_summary)
        <div class="section-spacing" style="margin-bottom: 12px; padding: 8px;">
            <div style="display: table; width: 100%; margin-bottom: 8px;">
                <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                    <span class="section-title" style="font-size: 12pt; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #1f2937;">A PROPOS DE MOI</span>
                </div>
                <div style="display: table-cell; vertical-align: middle; padding-left: 8px; width: 100%;">
                    <div style="height: 1px; background: #e5e7eb;"></div>
                </div>
            </div>
            <p class="description-text" style="font-size: 11pt; color: #4b5563; line-height: 1.4; margin: 0;">{{ $user->profile->professional_summary }}</p>
        </div>
        @endif

        {{-- EXPÉRIENCES --}}
        @if($user->experiences->isNotEmpty())
        <div class="section-spacing" style="margin-bottom: 12px; padding: 8px;">
            <div style="display: table; width: 100%; margin-bottom: 8px;">
                <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                    <span class="section-title" style="font-size: 12pt; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #1f2937;">EXPÉRIENCES</span>
                </div>
                <div style="display: table-cell; vertical-align: middle; padding-left: 8px; width: 100%;">
                    <div style="height: 1px; background: #e5e7eb;"></div>
                </div>
            </div>
            @foreach($user->experiences as $experience)
            <div class="item-spacing" style="display: table; width: 100%; margin-bottom: 7px;">
                <div style="display: table-cell; vertical-align: top; width: 60px; padding-right: 8px;">
                    <div class="description-text" style="background: #6b7280; color: white; font-size: 10pt; padding: 3px 4px; text-align: center; border-radius: 2px; line-height: 1.3;">{{ $experience->date_range }}</div>
                </div>
                {{-- Contenu --}}
                <div style="display: table-cell; vertical-align: top;">
                    <div style="display: table; width: 100%;">
                        <div style="display: table-cell; font-size: 12pt; font-weight: 700; color: #1f2937;">{{ $experience->job_title }}</div>
                        <div style="display: table-cell; text-align: right; font-size: 10pt; color: #9ca3af; white-space: nowrap;">{{ $experience->location }}</div>
                    </div>
                    <div style="font-size: 12pt; color: var(--cv-primary, #3b82f6); font-weight: 600; margin: 2px 0 3px;">{{ $experience->company }}</div>
                    @if($experience->description)
                    <div class="description-text" style="font-size: 10pt; color: #6b7280; line-height: 1.4;">{{ $experience->description }}</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- FORMATION --}}
        @if($user->educations->isNotEmpty())
        <div class="section-spacing" style="margin: 0; padding: 0;">
            <div style="display: table; width: 100%; margin-bottom: 8px;">
                <div style="display: table-cell; white-space: nowrap; vertical-align: middle;">
                    <span class="section-title" style="font-size: 12pt; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #1f2937;">FORMATION</span>
                </div>
                <div style="display: table-cell; vertical-align: middle; padding-left: 8px; width: 100%;">
                    <div style="height: 1px; background: #e5e7eb;"></div>
                </div>
            </div>
            @foreach($user->educations as $education)
            <div class="item-spacing" style="display: table; width: 100%; margin-bottom: 7px;">
                <div style="display: table-cell; vertical-align: top; width: 55px; padding-right: 8px;">
                    @if($education->graduation_year)
                    <div class="description-text" style="background: #6b7280; color: white; font-size: 10pt; padding: 3px 4px; text-align: center; border-radius: 2px;">{{ $education->graduation_year }}</div>
                    @endif
                </div>
                <div style="display: table-cell; vertical-align: top;">
                    <div style="font-size: 11pt; font-weight: 700; color: #1f2937; line-height: 1.1;">{{ $education->degree }}</div>
                    <div style="font-size: 11pt; color: var(--cv-primary, #3b82f6); font-weight: 600; margin: 1px 0 1px;">{{ $education->school }}</div>
                    @if($education->field_of_study)<div class="description-text" style="font-size: 9pt; color: #9ca3af;">{{ $education->field_of_study }}</div>@endif
                    @if($education->description)<div class="description-text" style="font-size: 9pt; color: #6b7280; margin-top: 1px; line-height: 1.3;">{{ $education->description }}</div>@endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
