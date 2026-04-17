<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('CV Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your CV profile information.') }}
        </p>
    </header>

    <form method="post" action="{{ route('dashboard.profile.updateCv') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profession" :value="__('Profession')" />
            <x-text-input id="profession" name="profession" type="text" class="mt-1 block w-full" :value="old('profession', $user->profile?->profession)" placeholder="Ex: Développeur Web" />
            <x-input-error class="mt-2" :messages="$errors->get('profession')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->profile?->phone)" placeholder="Ex: +33 6 12 34 56 78" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->profile?->address)" placeholder="Ex: 123 Rue de la Paix, 75000 Paris" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="professional_summary" :value="__('Professional Summary')" />
            <textarea id="professional_summary" name="professional_summary" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" placeholder="Décrivez votre profil professionnel...">{{ old('professional_summary', $user->profile?->professional_summary) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('professional_summary')" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <x-input-label for="linkedin_url" :value="__('LinkedIn URL')" />
                <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1 block w-full" :value="old('linkedin_url', $user->profile?->linkedin_url)" placeholder="https://linkedin.com/in/..." />
                <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
            </div>

            <div>
                <x-input-label for="github_url" :value="__('GitHub URL')" />
                <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full" :value="old('github_url', $user->profile?->github_url)" placeholder="https://github.com/..." />
                <x-input-error class="mt-2" :messages="$errors->get('github_url')" />
            </div>

            <div>
                <x-input-label for="website_url" :value="__('Website URL')" />
                <x-text-input id="website_url" name="website_url" type="url" class="mt-1 block w-full" :value="old('website_url', $user->profile?->website_url)" placeholder="https://..." />
                <x-input-error class="mt-2" :messages="$errors->get('website_url')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-cv-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
