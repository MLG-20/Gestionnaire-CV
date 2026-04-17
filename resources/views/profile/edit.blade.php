@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('dashboard.index') }}"
       class="inline-flex items-center gap-1.5 px-3 py-2 text-xs sm:text-sm font-medium text-gray-700 mb-4 sm:mb-6 hover:bg-gray-100 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Retour au tableau de bord
    </a>
    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Coordonnées & Photo</h1>

    {{-- Photo Section --}}
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-6 mb-4 sm:mb-6">
        <h2 class="font-semibold text-gray-900 mb-4 text-sm sm:text-base">Photo de profil</h2>
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 sm:gap-6">
            <div class="flex-shrink-0">
                <img src="{{ $user->photo_url }}" alt="Photo de profil"
                     class="w-20 sm:w-24 h-20 sm:h-24 rounded-full object-cover border-4 border-gray-100 shadow-sm">
            </div>
            <div class="flex-1 w-full">
                <form method="POST" action="{{ route('dashboard.profile.photo.update') }}" enctype="multipart/form-data">
                    @csrf
                    <label class="block mb-2">
                        <input type="file" name="photo" accept="image/*" required
                               class="block w-full text-xs sm:text-sm text-gray-500 file:mr-3 sm:file:mr-4 file:py-1.5 sm:file:py-2 file:px-3 sm:file:px-4 file:rounded-lg file:border-0 file:text-xs sm:file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    </label>
                    @error('photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-400 mb-3">JPG, PNG ou WebP · Max 2 Mo · Recadrage automatique 400×400</p>
                    <button type="submit"
                            class="bg-blue-600 text-white text-xs sm:text-sm font-medium px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Mettre à jour la photo
                    </button>
                </form>
            </div>
            @if($user->photo_path)
                <form method="POST" action="{{ route('dashboard.profile.photo.destroy') }}" class="mt-3 sm:mt-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs sm:text-sm"
                            onclick="return confirm('Supprimer la photo ?')">
                        Supprimer
                    </button>
                </form>
            @endif
        </div>
    </div>

    {{-- Profile Form --}}
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-6">
        <h2 class="font-semibold text-gray-900 mb-4 sm:mb-6 text-sm sm:text-base">Informations personnelles</h2>
        <form method="POST" action="{{ route('dashboard.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Nom complet *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Profession</label>
                    <input type="text" name="profession" value="{{ old('profession', $user->profile?->profession) }}"
                           placeholder="Ex: Développeur Web"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-400 mt-1">S'affichera dans votre CV</p>
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-400 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Téléphone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->profile?->phone) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Adresse</label>
                    <input type="text" name="address" value="{{ old('address', $user->profile?->address) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">LinkedIn</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $user->profile?->linkedin_url) }}"
                           placeholder="https://linkedin.com/in/..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('linkedin_url') border-red-400 @enderror">
                    @error('linkedin_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">GitHub</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $user->profile?->github_url) }}"
                           placeholder="https://github.com/..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('github_url') border-red-400 @enderror">
                    @error('github_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Site web</label>
                    <input type="url" name="website_url" value="{{ old('website_url', $user->profile?->website_url) }}"
                           placeholder="https://..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('website_url') border-red-400 @enderror">
                    @error('website_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Résumé professionnel</label>
                    <textarea name="professional_summary" rows="3" placeholder="Décrivez votre profil en quelques phrases..."
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('professional_summary', $user->profile?->professional_summary) }}</textarea>
                    @error('professional_summary') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-4 sm:mt-6 flex justify-end">
                <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-4 sm:px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors text-xs sm:text-sm">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
