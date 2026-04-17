@extends('layouts.app')

@section('title', 'Ajouter une expérience')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-2 sm:gap-4 mb-4 sm:mb-6">
        <a href="{{ route('dashboard.experiences.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Ajouter une expérience</h1>
    </div>

    <div class="bg-white rounded-xi sm:rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-6">
        <form method="POST" action="{{ route('dashboard.experiences.store') }}">
            @csrf
            @include('experiences._form')
            <div class="mt-4 sm:mt-6 flex flex-col sm:flex-row justify-end gap-2 sm:gap-3">
                <a href="{{ route('dashboard.experiences.index') }}"
                   class="w-full sm:w-auto px-3 sm:px-4 py-2 text-xs sm:text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-center">
                    Annuler
                </a>
                <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 text-white font-semibold px-3 sm:px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors text-xs sm:text-sm">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
