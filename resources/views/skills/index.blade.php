@extends('layouts.app')

@section('title', 'Compétences')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('dashboard.index') }}"
       class="inline-flex items-center gap-1.5 px-3 py-2 text-xs sm:text-sm font-medium text-gray-700 mb-4 sm:mb-6 hover:bg-gray-100 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Retour au tableau de bord
    </a>
    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Compétences</h1>

    {{-- Add Skill Form --}}
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-6 mb-4 sm:mb-6">
        <h2 class="font-semibold text-gray-900 mb-3 sm:mb-4 text-sm sm:text-base">Ajouter une compétence</h2>
        <form method="POST" action="{{ route('dashboard.skills.store') }}" class="flex flex-col sm:flex-row gap-2 sm:gap-3 items-start sm:items-end">
            @csrf
            <div class="flex-1 w-full sm:w-auto">
                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Compétence</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Ex: PHP, Photoshop..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="w-full sm:w-48">
                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Niveau</label>
                <select name="level" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="debutant">Débutant</option>
                    <option value="intermediaire" selected>Intermédiaire</option>
                    <option value="avance">Avancé</option>
                    <option value="expert">Expert</option>
                </select>
            </div>
            <button type="submit"
                    class="w-full sm:w-auto bg-blue-600 text-white font-medium px-3 sm:px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-xs sm:text-sm whitespace-nowrap">
                Ajouter
            </button>
        </form>
    </div>

    {{-- Skills List --}}
    @if($skills->isEmpty())
        <div class="bg-white rounded-xi sm:rounded-2xl border-2 border-dashed border-gray-300 p-6 sm:p-8 text-center">
            <p class="text-gray-400 text-xs sm:text-sm">Aucune compétence ajoutée</p>
        </div>
    @else
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 divide-y divide-gray-100">
            @foreach($skills as $skill)
                <div class="p-3 sm:p-4 flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4">
                    <div class="flex-1 w-full">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium text-gray-900 text-xs sm:text-sm">{{ $skill->name }}</span>
                            <span class="text-xs text-gray-500">{{ $skill->level_label }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-blue-600 h-1.5 rounded-full"
                                 style="width: {{ $skill->level_percentage }}%"></div>
                        </div>
                    </div>
                    <div x-data="{ editing: false }" class="flex items-center gap-2 self-start sm:self-auto ml-0 sm:ml-4 flex-shrink-0">
                        <button @click="editing = !editing" class="text-gray-400 hover:text-blue-600 transition-colors p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form method="POST" action="{{ route('dashboard.skills.destroy', $skill) }}"
                              onsubmit="return confirm('Supprimer ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>

                        {{-- Inline edit form --}}
                        <div x-show="editing" x-cloak
                             class="absolute bg-white border border-gray-200 rounded-xl shadow-lg p-3 sm:p-4 z-20 min-w-56 sm:min-w-72 right-2 sm:right-auto"
                             style="top: 100%;">
                            <form method="POST" action="{{ route('dashboard.skills.update', $skill) }}" class="flex flex-col gap-2 sm:gap-3">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $skill->name }}" required
                                       class="border border-gray-300 rounded-lg px-3 py-1.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <select name="level" class="border border-gray-300 rounded-lg px-3 py-1.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="debutant" {{ $skill->level === 'debutant' ? 'selected' : '' }}>Débutant</option>
                                    <option value="intermediaire" {{ $skill->level === 'intermediaire' ? 'selected' : '' }}>Intermédiaire</option>
                                    <option value="avance" {{ $skill->level === 'avance' ? 'selected' : '' }}>Avancé</option>
                                    <option value="expert" {{ $skill->level === 'expert' ? 'selected' : '' }}>Expert</option>
                                </select>
                                <div class="flex gap-2">
                                    <button type="button" @click="editing = false" class="flex-1 border border-gray-300 rounded-lg py-1.5 text-xs sm:text-sm text-gray-600 hover:bg-gray-50">Annuler</button>
                                    <button type="submit" class="flex-1 bg-blue-600 text-white rounded-lg py-1.5 text-xs sm:text-sm hover:bg-blue-700">OK</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
