@extends('layouts.app')

@section('content')
    <div class="dashboard-container">
        <h1>Paramètres du Footer</h1>
        
        <div class="bg-white rounded-lg shadow p-6 mt-6">
            <p class="text-gray-600 mb-4">Gérez les informations du footer affichées sur votre site public.</p>
            
            @php
                $footerSetting = \App\Models\FooterSetting::first();
            @endphp

            @if($footerSetting)
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Company Info -->
                    <div class="border-l-4 border-blue-500 pl-4">
                        <h3 class="font-semibold text-lg mb-2">Informations Entreprise</h3>
                        <p><strong>Nom:</strong> {{ $footerSetting->company_name }}</p>
                        <p><strong>Description:</strong> {{ $footerSetting->company_description }}</p>
                        <p><strong>Texte Footer:</strong> {{ $footerSetting->footer_text }}</p>
                    </div>

                    <!-- Social Media -->
                    <div class="border-l-4 border-green-500 pl-4">
                        <h3 class="font-semibold text-lg mb-2">Réseaux Sociaux</h3>
                        <p><strong>LinkedIn:</strong> <a href="{{ $footerSetting->linkedin_url }}" target="_blank" class="text-blue-500 hover:underline">{{ $footerSetting->linkedin_url }}</a></p>
                        <p><strong>Twitter:</strong> <a href="{{ $footerSetting->twitter_url }}" target="_blank" class="text-blue-500 hover:underline">{{ $footerSetting->twitter_url }}</a></p>
                        <p><strong>GitHub:</strong> <a href="{{ $footerSetting->github_url }}" target="_blank" class="text-blue-500 hover:underline">{{ $footerSetting->github_url }}</a></p>
                    </div>

                    <!-- Contact Info -->
                    <div class="border-l-4 border-purple-500 pl-4">
                        <h3 class="font-semibold text-lg mb-2">Contact</h3>
                        <p><strong>Email:</strong> {{ $footerSetting->contact_email ?? 'Non configuré' }}</p>
                        <p><strong>Téléphone:</strong> {{ $footerSetting->contact_phone ?? 'Non configuré' }}</p>
                    </div>

                    <!-- Edit Link -->
                    <div class="border-l-4 border-orange-500 pl-4 flex items-center">
                        <a href="/admin/footer-settings/{{ $footerSetting->id }}/edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            ✎ Modifier
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded">
                    Aucun paramètre de footer configuré.
                    <a href="/admin/footer-settings/create" class="font-bold hover:underline">Créer maintenant</a>
                </div>
            @endif
        </div>
    </div>
@endsection
