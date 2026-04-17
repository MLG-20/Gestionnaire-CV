@extends('layouts.app')

@section('title', 'Formations')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('dashboard.index') }}"
       class="inline-flex items-center gap-1.5 px-3 py-2 text-xs sm:text-sm font-medium text-gray-700 mb-4 sm:mb-6 hover:bg-gray-100 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Retour au tableau de bord
    </a>
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0 mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Formations</h1>
        <a href="{{ route('dashboard.educations.create') }}"
           class="w-full sm:w-auto bg-blue-600 text-white text-xs sm:text-sm font-medium px-3 sm:px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Ajouter
        </a>
    </div>

    @if($educations->isEmpty())
        <div class="bg-white rounded-xl sm:rounded-2xl border-2 border-dashed border-gray-300 p-6 sm:p-12 text-center">
            <svg class="w-10 sm:w-12 h-10 sm:h-12 text-gray-300 mx-auto mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
            </svg>
            <p class="text-gray-400 text-xs sm:text-sm mb-3 sm:mb-4">Aucune formation ajoutée</p>
            <a href="{{ route('dashboard.educations.create') }}"
               class="inline-block bg-blue-600 text-white text-xs sm:text-sm font-medium px-3 sm:px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Ajouter ma première formation
            </a>
        </div>
    @else
        <div class="space-y-3 sm:space-y-4">
            @foreach($educations as $education)
                <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200 p-3 sm:p-5 hover:border-blue-300 transition-colors">
                    <div class="flex flex-col sm:flex-row items-start sm:items-start justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900 text-sm sm:text-base">{{ $education->degree }}</h3>
                            <p class="text-blue-600 text-xs sm:text-sm font-medium">{{ $education->school }}</p>
                            <p class="text-gray-500 text-xs mt-0.5 sm:mt-1">
                                @if($education->field_of_study) {{ $education->field_of_study }} · @endif
                                @if($education->graduation_year) Promotion {{ $education->graduation_year }} @endif
                            </p>
                            @if($education->description)
                                <p class="text-gray-600 text-xs sm:text-sm mt-2 line-clamp-2">{{ $education->description }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-2 ml-0 sm:ml-4 flex-shrink-0">
                            <a href="{{ route('dashboard.educations.edit', $education) }}"
                               class="text-gray-400 hover:text-blue-600 transition-colors p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('dashboard.educations.destroy', $education) }}"
                                  onsubmit="return confirm('Supprimer cette formation ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
