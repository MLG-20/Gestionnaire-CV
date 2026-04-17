@extends('layouts.app')

@section('title', 'Template & Couleurs')

@section('content')
<div class="max-w-5xl">
    <a href="{{ route('dashboard.index') }}"
       class="inline-flex items-center gap-1.5 px-3 py-2 text-xs sm:text-sm font-medium text-gray-700 mb-4 sm:mb-6 hover:bg-gray-100 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Retour au tableau de bord
    </a>
    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Template & Personnalisation</h1>

    <form method="POST" action="{{ route('dashboard.cv-settings.update') }}" x-data="{
        selectedTemplate: '{{ $cvSetting->template_name }}',
        primaryColor: '{{ $cvSetting->primary_color }}',
        secondaryColor: '{{ $cvSetting->secondary_color }}',
        activeTab: 'classic'
    }">
        @csrf
        @method('PUT')
        <input type="hidden" name="template_name" :value="selectedTemplate">
        <input type="hidden" name="primary_color" :value="primaryColor">
        <input type="hidden" name="secondary_color" :value="secondaryColor">

        {{-- Template Selection --}}
        <div class="bg-white rounded-xi sm:rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-6 mb-4 sm:mb-6">
            <h2 class="font-semibold text-gray-900 mb-3 sm:mb-4 text-sm sm:text-base">Choisissez votre modèle</h2>

            {{-- Tabs --}}
            <div class="flex gap-2 mb-4 sm:mb-5">
                <button type="button" @click="activeTab = 'classic'"
                        :class="activeTab === 'classic' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-2 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs sm:text-sm font-medium transition-colors">
                    Classiques ({{ collect($templates)->where('category', 'classic')->count() }})
                </button>
            </div>

            {{-- Classic Templates --}}
            <div x-show="activeTab === 'classic'">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2 sm:gap-3 md:gap-4">
                    @foreach(collect($templates)->where('category', 'classic') as $template)
                        <div @click="selectedTemplate = '{{ $template['slug'] }}'"
                             :class="selectedTemplate === '{{ $template['slug'] }}' ? 'border-blue-500 ring-2 ring-blue-200 bg-blue-50' : 'border-gray-200 hover:border-gray-400 bg-gray-50'"
                             class="border-2 rounded-lg sm:rounded-xl p-2 sm:p-3 cursor-pointer transition-all">
                            <div class="aspect-[3/4] rounded-md sm:rounded-lg mb-1.5 sm:mb-2 overflow-hidden flex flex-col"
                                 :style="'background: linear-gradient(135deg, ' + primaryColor + '22, white)'">
                                <div class="h-6 sm:h-8 flex-shrink-0" :style="'background: ' + primaryColor"></div>
                                <div class="flex-1 p-1 sm:p-2 space-y-0.5 sm:space-y-1">
                                    <div class="h-1 sm:h-1.5 rounded bg-gray-300 w-3/4"></div>
                                    <div class="h-0.5 sm:h-1 rounded bg-gray-200 w-full"></div>
                                    <div class="h-0.5 sm:h-1 rounded bg-gray-200 w-5/6"></div>
                                </div>
                            </div>
                            <p class="text-xs font-semibold text-gray-800 text-center line-clamp-1">{{ $template['name'] }}</p>
                            <p class="text-xs text-gray-400 text-center leading-tight mt-0.5 line-clamp-1">{{ $template['style'] }}</p>
                            <div class="mt-1.5 sm:mt-2 flex justify-center">
                                <div :class="selectedTemplate === '{{ $template['slug'] }}' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-transparent'"
                                     class="w-4 h-4 rounded-full flex items-center justify-center transition-colors">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
            <a :href="'{{ route('dashboard.cv.preview') }}?template=' + selectedTemplate + '&primary=' + encodeURIComponent(primaryColor) + '&secondary=' + encodeURIComponent(secondaryColor)"
               target="_blank"
               class="w-full sm:w-auto text-xs sm:text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center justify-center sm:justify-start gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Aperçu du CV
            </a>
            <button type="submit"
                    class="w-full sm:w-auto bg-blue-600 text-white font-semibold px-4 sm:px-8 py-2 rounded-lg hover:bg-blue-700 transition-colors text-xs sm:text-sm">
                Enregistrer la personnalisation
            </button>
        </div>
    </form>
</div>
@endsection
