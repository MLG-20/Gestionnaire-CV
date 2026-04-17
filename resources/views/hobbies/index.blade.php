@extends('layouts.app')

@section('title', 'Loisirs')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('dashboard.index') }}"
       class="inline-flex items-center gap-1.5 px-3 py-2 text-xs sm:text-sm font-medium text-gray-700 mb-4 sm:mb-6 hover:bg-gray-100 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Retour au tableau de bord
    </a>
    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Loisirs & Centres d'intérêt</h1>

    {{-- Add Hobby Form --}}
    <div class="bg-white rounded-xi sm:rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-6 mb-4 sm:mb-6">
        <h2 class="font-semibold text-gray-900 mb-3 sm:mb-4 text-sm sm:text-base">Ajouter un loisir</h2>
        <form method="POST" action="{{ route('dashboard.hobbies.store') }}" class="flex flex-col sm:flex-row gap-2 sm:gap-3">
            @csrf
            <div class="flex-1">
                <input type="text" name="name" value="{{ old('name') }}" required
                       placeholder="Ex: Photographie, Football, Lecture..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit"
                    class="w-full sm:w-auto bg-blue-600 text-white font-medium px-3 sm:px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-xs sm:text-sm whitespace-nowrap">
                Ajouter
            </button>
        </form>
    </div>

    {{-- Hobbies List --}}
    @if($hobbies->isEmpty())
        <div class="bg-white rounded-xi sm:rounded-2xl border-2 border-dashed border-gray-300 p-6 sm:p-8 text-center">
            <p class="text-gray-400 text-xs sm:text-sm">Aucun loisir ajouté</p>
        </div>
    @else
        <div class="flex flex-wrap gap-2 sm:gap-3">
            @foreach($hobbies as $hobby)
                <div class="bg-white border border-gray-200 rounded-full px-3 sm:px-4 py-1.5 sm:py-2 flex items-center gap-2 sm:gap-3">
                    <span class="text-xs sm:text-sm font-medium text-gray-700">{{ $hobby->name }}</span>
                    <form method="POST" action="{{ route('dashboard.hobbies.destroy', $hobby) }}"
                          onsubmit="return confirm('Supprimer ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors">
                            <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
