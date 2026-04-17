@extends('layouts.app')

@section('title', 'Paramètres du Profil')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('dashboard.index') }}"
       class="inline-flex items-center gap-1.5 px-3 py-2 text-xs sm:text-sm font-medium text-gray-700 mb-4 sm:mb-6 hover:bg-gray-100 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Retour au tableau de bord
    </a>
    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Paramètres du Profil</h1>

    {{-- Change Password Section --}}
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-6 mb-4 sm:mb-6">
        <h2 class="font-semibold text-gray-900 mb-4 sm:mb-6 text-sm sm:text-base">Changer le mot de passe</h2>

        <form method="post" action="{{ route('password.update') }}" class="space-y-3 sm:space-y-6">
            @csrf
            @method('put')

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Mot de passe actuel</label>
                <input type="password" name="current_password" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('current_password', 'updatePassword') border-red-400 @enderror"
                       placeholder="Entrez votre mot de passe actuel">
                @error('current_password', 'updatePassword')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Nouveau mot de passe</label>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password', 'updatePassword') border-red-400 @enderror"
                       placeholder="Entrez votre nouveau mot de passe">
                @error('password', 'updatePassword')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password_confirmation', 'updatePassword') border-red-400 @enderror"
                       placeholder="Confirmez votre nouveau mot de passe">
                @error('password_confirmation', 'updatePassword')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-2">
                <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 text-white font-semibold px-4 sm:px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors text-xs sm:text-sm">
                    Mettre à jour le mot de passe
                </button>

                @if (session('status') === 'password-updated')
                    <p class="text-green-600 text-xs sm:text-sm flex items-center whitespace-nowrap">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Enregistré!
                    </p>
                @endif
            </div>
        </form>
    </div>

    {{-- Delete Account Section --}}
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-6">
        <h2 class="font-semibold text-gray-900 mb-2 sm:mb-4 text-sm sm:text-base">Zone de danger</h2>
        <p class="text-xs sm:text-sm text-gray-600 mb-4 sm:mb-6">Une fois votre compte supprimé, toutes les données seront perdues définitivement.</p>

        <button type="button"
                @click="$dispatch('open-modal', 'confirm-account-deletion')"
                class="w-full sm:w-auto bg-red-600 text-white font-semibold px-4 sm:px-6 py-2 rounded-lg hover:bg-red-700 transition-colors text-xs sm:text-sm">
            Supprimer mon compte
        </button>

        {{-- Confirmation Modal --}}
        <div x-data="{ open: false }"
             @open-modal.window="open = ($event.detail === 'confirm-account-deletion')"
             @close.window="open = false"
             x-show="open"
             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
             style="display: none;">
            <div class="bg-white rounded-lg sm:rounded-xl shadow-lg p-4 sm:p-6 max-w-md w-full">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-2">Êtes-vous certain ?</h3>
                <p class="text-xs sm:text-sm text-gray-600 mb-4 sm:mb-6">
                    Une fois votre compte supprimé, toutes vos données CV, CV settings et photos seront supprimés de manière permanente. Cette action est irréversible.
                </p>

                <form method="post" action="{{ route('dashboard.profile.destroy') }}" class="space-y-3 sm:space-y-4">
                    @csrf
                    @method('delete')

                    <div>
                        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Entrez votre mot de passe pour confirmer</label>
                        <input type="password" name="password" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-red-500 @error('password') border-red-400 @enderror"
                               placeholder="Votre mot de passe">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-2 sm:gap-3 justify-end">
                        <button type="button"
                                @click="open = false"
                                class="px-3 sm:px-4 py-1.5 sm:py-2 border border-gray-300 rounded-lg text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            Annuler
                        </button>
                        <button type="submit"
                                class="px-3 sm:px-4 py-1.5 sm:py-2 bg-red-600 text-white rounded-lg text-xs sm:text-sm font-medium hover:bg-red-700 transition-colors">
                            Supprimer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
