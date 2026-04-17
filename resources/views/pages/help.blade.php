@extends('layouts.app')

@section('title', 'Aide & Guide')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('dashboard.index') }}"
       class="inline-flex items-center gap-1.5 px-3 py-2 text-xs sm:text-sm font-medium text-gray-700 mb-4 sm:mb-6 hover:bg-gray-100 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Retour au tableau de bord
    </a>

    <div class="mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Aide & Guide</h1>
        <p class="text-gray-600">Découvrez comment utiliser Sama CV pour créer votre CV parfait</p>
    </div>

    {{-- Table de matières --}}
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 mb-8">
        <h2 class="text-lg font-semibold text-blue-900 mb-4">📑 Table de matières</h2>
        <nav class="space-y-2">
            <a href="#start" class="flex items-center gap-2 text-blue-700 hover:text-blue-900 text-sm">
                <span class="text-lg">🚀</span>
                <span>Démarrer</span>
            </a>
            <a href="#sections" class="flex items-center gap-2 text-blue-700 hover:text-blue-900 text-sm">
                <span class="text-lg">📊</span>
                <span>Les sections du CV</span>
            </a>
            <a href="#dashboard" class="flex items-center gap-2 text-blue-700 hover:text-blue-900 text-sm">
                <span class="text-lg">📈</span>
                <span>Le tableau de bord</span>
            </a>
            <a href="#tips" class="flex items-center gap-2 text-blue-700 hover:text-blue-900 text-sm">
                <span class="text-lg">💡</span>
                <span>Conseils pour un bon CV</span>
            </a>
        </nav>
    </div>

    {{-- Section 1: Démarrer --}}
    <section id="start" class="mb-8 scroll-mt-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="text-3xl">🚀</span>
                Démarrer avec Sama CV
            </h2>

            <div class="space-y-4">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">1️⃣ Créer votre compte</h3>
                    <p class="text-gray-600 text-sm">
                        Inscrivez-vous avec votre email et créez un mot de passe sécurisé. Votre compte vous permet de sauvegarder et modifier votre CV à tout moment.
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">2️⃣ Remplir votre profil</h3>
                    <p class="text-gray-600 text-sm">
                        Commencez par la section <strong>Coordonnées & Photo</strong>. Ajoutez votre nom, email, téléphone et une belle photo de profil. Cette information apparaîtra en haut de votre CV.
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">3️⃣ Compléter les sections</h3>
                    <p class="text-gray-600 text-sm">
                        Suivez le guide sur le tableau de bord pour remplir progressivement vos expériences, formations et compétences. Chaque étape complétée augmente votre score de profil.
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">4️⃣ Personnaliser votre CV</h3>
                    <p class="text-gray-600 text-sm">
                        Choisissez un template et des couleurs qui vous plaisent dans <strong>Template & Couleurs</strong>. Prévisualisez votre CV pour voir le résultat final.
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">5️⃣ Télécharger en PDF</h3>
                    <p class="text-gray-600 text-sm">
                        Une fois satisfait, cliquez sur <strong>Télécharger PDF</strong> pour obtenir votre CV au format PDF prêt à être envoyé aux recruteurs.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 2: Les sections du CV --}}
    <section id="sections" class="mb-8 scroll-mt-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="text-3xl">📊</span>
                Les sections du CV
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Profil --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-2xl">👤</span>
                        <h3 class="font-semibold text-gray-900">Coordonnées & Photo</h3>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">
                        Votre identité professionnelle
                    </p>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>✓ Nom complet</li>
                        <li>✓ Email professionnel</li>
                        <li>✓ Téléphone</li>
                        <li>✓ Adresse</li>
                        <li>✓ Photo de profil</li>
                        <li>✓ Liens LinkedIn/Portfolio</li>
                    </ul>
                </div>

                {{-- Expériences --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-2xl">💼</span>
                        <h3 class="font-semibold text-gray-900">Expériences</h3>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">
                        Vos emplois précédents
                    </p>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>✓ Titre du poste</li>
                        <li>✓ Nom de l'entreprise</li>
                        <li>✓ Période (date début/fin)</li>
                        <li>✓ Lieu</li>
                        <li>✓ Description détaillée</li>
                    </ul>
                </div>

                {{-- Formations --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-2xl">🎓</span>
                        <h3 class="font-semibold text-gray-900">Formations</h3>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">
                        Votre parcours scolaire
                    </p>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>✓ Nom du diplôme</li>
                        <li>✓ Établissement</li>
                        <li>✓ Domaine d'études</li>
                        <li>✓ Année d'obtention</li>
                        <li>✓ Mention/Distinction</li>
                    </ul>
                </div>

                {{-- Compétences --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-2xl">✨</span>
                        <h3 class="font-semibold text-gray-900">Compétences</h3>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">
                        Vos savoir-faire
                    </p>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>✓ Nom de la compétence</li>
                        <li>✓ Niveau de maîtrise</li>
                        <li>✓ Débutant → Expert</li>
                        <li>✓ Catégorisation auto</li>
                    </ul>
                </div>

                {{-- Loisirs --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-2xl">🎉</span>
                        <h3 class="font-semibold text-gray-900">Loisirs</h3>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">
                        Vos centres d'intérêt
                    </p>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>✓ Hobbies varié</li>
                        <li>✓ Activités</li>
                        <li>✓ Passions</li>
                        <li>✓ Volontariat</li>
                    </ul>
                </div>

                {{-- Template --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-2xl">🎨</span>
                        <h3 class="font-semibold text-gray-900">Template & Couleurs</h3>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">
                        Personnalisez l'apparence
                    </p>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>✓ Plusieurs templates</li>
                        <li>✓ Couleurs personnalisées</li>
                        <li>✓ Prévisualisation en temps réel</li>
                        <li>✓ Styles modernes</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 3: Le tableau de bord --}}
    <section id="dashboard" class="mb-8 scroll-mt-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="text-3xl">📈</span>
                Comprendre le tableau de bord
            </h2>

            <div class="space-y-6">
                <div class="border-l-4 border-blue-500 pl-4">
                    <h3 class="font-semibold text-gray-900 mb-2">📊 Statistiques rapides</h3>
                    <p class="text-sm text-gray-600">
                        Affiche le nombre d'éléments dans chaque section (expériences, formations, compétences, loisirs). Un point vert indique que la section est remplie.
                    </p>
                </div>

                <div class="border-l-4 border-purple-500 pl-4">
                    <h3 class="font-semibold text-gray-900 mb-2">🎯 Guide d'utilisation</h3>
                    <p class="text-sm text-gray-600">
                        Quatre cartes colorées expliquent les étapes principales pour compléter votre CV. Chaque carte contient un lien direct vers la section correspondante.
                    </p>
                </div>

                <div class="border-l-4 border-green-500 pl-4">
                    <h3 class="font-semibold text-gray-900 mb-2">📈 Progression du profil</h3>
                    <p class="text-sm text-gray-600">
                        Une barre de progression visuelle montre votre avancée. Elle compte le nombre de sections complétées. Lors que vous atteignez 100%, votre CV est prêt à être envoyé!
                    </p>
                </div>

                <div class="border-l-4 border-amber-500 pl-4">
                    <h3 class="font-semibold text-gray-900 mb-2">💳 Aperçu du CV</h3>
                    <p class="text-sm text-gray-600">
                        Une carte affiche un aperçu miniature de votre CV avec votre photo, nom et résumé professionnel. Utile pour vérifier rapidement votre progression.
                    </p>
                </div>

                <div class="border-l-4 border-rose-500 pl-4">
                    <h3 class="font-semibold text-gray-900 mb-2">ℹ️ Informations rapides</h3>
                    <p class="text-sm text-gray-600">
                        Affiche vos coordonnées actuelles (email, téléphone, adresse, LinkedIn). Permet de vérifier que vos infos sont à jour avant de télécharger.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 4: Conseils --}}
    <section id="tips" class="mb-8 scroll-mt-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="text-3xl">💡</span>
                Conseils pour un excellent CV
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-green-50 border border-green-100 rounded-lg p-4">
                    <h3 class="font-semibold text-green-900 mb-2">✅ À faire</h3>
                    <ul class="text-sm text-green-800 space-y-2">
                        <li>• Utilisez une photo professionnelle</li>
                        <li>• Soyez précis et concis</li>
                        <li>• Mettez à jour régulièrement</li>
                        <li>• Utilisez des verbes d'action</li>
                        <li>• Incluez des accomplissements mesurables</li>
                        <li>• Vérifiez l'orthographe</li>
                    </ul>
                </div>

                <div class="bg-red-50 border border-red-100 rounded-lg p-4">
                    <h3 class="font-semibold text-red-900 mb-2">❌ À éviter</h3>
                    <ul class="text-sm text-red-800 space-y-2">
                        <li>• Trop d'informations personnelles</li>
                        <li>• Texte trop dense et long</li>
                        <li>• Dates imprécises</li>
                        <li>• Infos obsolètes ou fausses</li>
                        <li>• Mauvaise orthographe</li>
                        <li>• Photo non professionnelle</li>
                    </ul>
                </div>
            </div>

            <div class="mt-6 bg-blue-50 border border-blue-100 rounded-lg p-4">
                <h3 class="font-semibold text-blue-900 mb-2">📝 Structure idéale</h3>
                <div class="text-sm text-blue-800 space-y-2">
                    <p><strong>1. En-tête</strong> - Nom, contact, photo</p>
                    <p><strong>2. Résumé</strong> - 2-3 lignes sur votre profil (optionnel)</p>
                    <p><strong>3. Expériences</strong> - De la plus récente à la plus ancienne</p>
                    <p><strong>4. Formations</strong> - Diplômes et certifications</p>
                    <p><strong>5. Compétences</strong> - Groupées par catégorie</p>
                    <p><strong>6. Loisirs</strong> - Pour humaniser votre profil</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="text-3xl">❓</span>
                Questions fréquentes
            </h2>

            <div class="space-y-4">
                <details class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-gray-50" open>
                    <summary class="font-semibold text-gray-900 flex justify-between items-center">
                        Comment modifier mon CV après l'avoir téléchargé?
                        <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3">
                        Vous pouvez revenir à tout moment sur le site pour modifier vos informations. Les modifications seront reflétées dans votre nouveau CV PDF.
                    </p>
                </details>

                <details class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                    <summary class="font-semibold text-gray-900 flex justify-between items-center">
                        Combien de temps faut-il pour remplir le CV?
                        <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3">
                        En moyenne 15-30 minutes pour un premier CV complet. Cela dépend de votre expérience et du détail que vous souhaitez apporter.
                    </p>
                </details>

                <details class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                    <summary class="font-semibold text-gray-900 flex justify-between items-center">
                        Puis-je avoir plusieurs versions de mon CV?
                        <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3">
                        Actuellement, vous avez une seule version. Vous pouvez cependant modifier rapidement vos informations et télécharger différentes versions selon vos besoins.
                    </p>
                </details>

                <details class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                    <summary class="font-semibold text-gray-900 flex justify-between items-center">
                        Mes données sont-elles sécurisées?
                        <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </summary>
                    <p class="text-sm text-gray-600 mt-3">
                        Oui, votre compte est protégé par un mot de passe crypté. Vos données ne sont jamais partagées avec des tiers. Vous pouvez supprimer votre compte à tout moment.
                    </p>
                </details>
            </div>
        </div>
    </section>

    {{-- Support --}}
    <section class="mb-8">
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6">
            <h2 class="text-xl font-bold text-blue-900 mb-3 flex items-center gap-2">
                <span>🆘</span>
                Besoin d'aide?
            </h2>
            <p class="text-sm text-blue-800 mb-4">
                Si vous rencontrez un problème ou avez une question, n'hésitez pas à nous contacter.
            </p>
            <a href="mailto:support@samacv.com" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                Contacter le support
            </a>
        </div>
    </section>
</div>

<style>
    details summary::-webkit-details-marker {
        display: none;
    }

    details summary svg {
        transform: rotate(0deg);
    }

    details[open] summary svg {
        transform: rotate(180deg);
    }
</style>
@endsection
