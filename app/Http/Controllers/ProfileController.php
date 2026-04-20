<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user()->load('profile');
        return view('profile.edit', compact('user'));
    }

    public function settings(Request $request): View
    {
        return view('profile.settings');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'                 => ['required', 'string', 'max:255'],
            'profession'           => ['nullable', 'string', 'max:255'],
            'email'                => ['required', 'email', 'max:255'],
            'phone'                => ['nullable', 'string', 'max:30'],
            'address'              => ['nullable', 'string', 'max:500'],
            'linkedin_url'         => ['nullable', 'url', 'max:255'],
            'github_url'           => ['nullable', 'url', 'max:255'],
            'website_url'          => ['nullable', 'url', 'max:255'],
            'professional_summary' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = $request->user();
        
        // SECURITY FIX: Reset email verification if email changes
        if ($user->email !== $validated['email']) {
            $oldEmail = $user->email;
            $user->update([
                'email' => $validated['email'],
                'email_verified_at' => null,  // Force re-verification
            ]);
            \Illuminate\Support\Facades\Log::notice('User email changed', [
                'user_id' => $user->id,
                'old_email' => $oldEmail,
                'new_email' => $validated['email'],
            ]);
        } else {
            $user->update(['name' => $validated['name']]);
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'profession'           => $validated['profession'],
                'phone'                => $validated['phone'],
                'address'              => $validated['address'],
                'linkedin_url'         => $validated['linkedin_url'],
                'github_url'           => $validated['github_url'],
                'website_url'          => $validated['website_url'],
                'professional_summary' => $validated['professional_summary'],
            ]
        );
        
        // SECURITY FIX: Audit log for profile changes
        \Illuminate\Support\Facades\Log::info('User profile updated', [
            'user_id' => $user->id,
            'updated_by' => $user->id,
            'timestamp' => now(),
        ]);

        return redirect()->route('dashboard.profile.edit')->with('success', 'Coordonnées mises à jour avec succès.');
    }

    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png,webp,jpg', 'max:2048'],
        ]);

        $user = $request->user();

        if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
            Storage::disk('public')->delete($user->photo_path);
        }

        // SECURITY FIX: Convert to WebP to prevent RCE vulnerability
        $image = \Intervention\Image\ImageManager::gd()
            ->read($request->file('photo'))
            ->cover(400, 400)  // Force dimensions
            ->toWebp(quality: 85);

        $filename = 'photos/' . $user->id . '.webp';  // Force WebP extension
        Storage::disk('public')->put($filename, $image);

        $user->update(['photo_path' => $filename]);

        return redirect()->route('dashboard.profile.edit')->with('success', 'Photo mise à jour avec succès.');
    }

    public function destroyPhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
            Storage::disk('public')->delete($user->photo_path);
        }

        $user->update(['photo_path' => null]);
        
        // SECURITY FIX: Audit log for photo deletion
        \Illuminate\Support\Facades\Log::info('User photo deleted', [
            'user_id' => $user->id,
            'timestamp' => now(),
        ]);

        return redirect()->route('dashboard.profile.edit')->with('success', 'Photo supprimée.');
    }

    public function updateCv(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'profession'           => ['nullable', 'string', 'max:255'],
            'phone'                => ['nullable', 'string', 'max:30'],
            'address'              => ['nullable', 'string', 'max:500'],
            'professional_summary' => ['nullable', 'string', 'max:1000'],
            'linkedin_url'         => ['nullable', 'url', 'max:255'],
            'github_url'           => ['nullable', 'url', 'max:255'],
            'website_url'          => ['nullable', 'url', 'max:255'],
        ]);

        $request->user()->profile()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $validated
        );

        return redirect()->route('dashboard.profile.edit')->with('status', 'profile-cv-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
