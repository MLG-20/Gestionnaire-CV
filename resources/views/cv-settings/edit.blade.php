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

    {{-- Toast Notification --}}
    <div id="toastNotification" 
         class="fixed top-4 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg opacity-0 transition-opacity duration-300 z-50">
        ✓ Template enregistré avec succès
    </div>

    <div x-data="{
        selectedTemplate: '{{ $cvSetting->template_name }}',
        primaryColor: '{{ $cvSetting->primary_color }}',
        secondaryColor: '{{ $cvSetting->secondary_color }}',
        activeTab: 'classic',
        isSaving: false,
        async saveTemplate(templateSlug) {
            this.selectedTemplate = templateSlug;
            this.isSaving = true;
            try {
                const response = await fetch('{{ route('dashboard.cv-settings.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        template_name: templateSlug,
                        primary_color: this.primaryColor,
                        secondary_color: this.secondaryColor,
                        _method: 'PUT'
                    })
                });
                if (response.ok) {
                    this.showToast();
                }
            } catch (error) {
                console.error('Erreur:', error);
            } finally {
                this.isSaving = false;
            }
        },
        showToast() {
            const toast = document.getElementById('toastNotification');
            toast.classList.remove('opacity-0');
            setTimeout(() => {
                toast.classList.add('opacity-0');
            }, 2000);
        }
    }">

        {{-- Template Selection --}}
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-6 mb-4 sm:mb-6">
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
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                    @foreach(collect($templates)->where('category', 'classic') as $template)
                        <div @click="saveTemplate('{{ $template['slug'] }}')"
                             :class="selectedTemplate === '{{ $template['slug'] }}' ? 'border-blue-500 ring-2 ring-blue-200 bg-blue-50' : 'border-gray-200 hover:border-gray-400 bg-gray-50'"
                             class="border-2 rounded-lg sm:rounded-xl p-3 sm:p-4 cursor-pointer transition-all hover:shadow-md">
                            
                            {{-- Template Preview --}}
                            <div class="aspect-[3/4] rounded-md sm:rounded-lg mb-2 sm:mb-3 overflow-hidden flex flex-col shadow-sm"
                                 :style="'background: linear-gradient(135deg, ' + primaryColor + '22, white)'">
                                <div class="h-8 sm:h-10 flex-shrink-0" :style="'background: ' + primaryColor"></div>
                                <div class="flex-1 p-2 sm:p-3 space-y-1 sm:space-y-2">
                                    <div class="h-1.5 sm:h-2 rounded bg-gray-300 w-3/4"></div>
                                    <div class="h-1 rounded bg-gray-200 w-full"></div>
                                    <div class="h-1 rounded bg-gray-200 w-5/6"></div>
                                </div>
                            </div>

                            {{-- Template Info --}}
                            <p class="text-sm font-semibold text-gray-900 line-clamp-1">{{ $template['name'] }}</p>
                            <p class="text-xs text-gray-500 line-clamp-1 mb-3">{{ $template['style'] }}</p>

                            {{-- Action Buttons --}}
                            <div class="flex gap-2 mb-3">
                                <a href="{{ route('dashboard.cv.preview') }}?template={{ $template['slug'] }}"
                                   target="_blank"
                                   @click.stop
                                   class="flex-1 text-center py-1.5 px-2 text-xs font-medium rounded bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">
                                    👁 Aperçu
                                </a>
                                <a href="{{ route('dashboard.cv.download') }}?template={{ $template['slug'] }}"
                                   @click.stop
                                   class="flex-1 text-center py-1.5 px-2 text-xs font-medium rounded bg-green-100 text-green-700 hover:bg-green-200 transition-colors">
                                    ⬇ Télécharger
                                </a>
                            </div>

                            {{-- Selection Indicator --}}
                            <div class="flex justify-center">
                                <div :class="selectedTemplate === '{{ $template['slug'] }}' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-transparent'"
                                     class="w-5 h-5 rounded-full flex items-center justify-center transition-colors flex-shrink-0">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Info Message --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 sm:p-4 text-sm text-blue-800">
            <p class="font-medium">💡 Les modifications s'enregistrent automatiquement quand vous choisissez un template.</p>
        </div>
    </div>
</div>
@endsection
