<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 1. Remplit les champs validés (name, email, etc.)
        $user = $request->user();
        $user->fill($request->validated());

        // 2. Si l'email a changé, on réinitialise la vérification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 3. On gère la nouvelle image de profil
        if ($request->hasFile('image')) {
            // 3a. On supprime l'ancienne image s'il y en a une
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // 3b. On enregistre la nouvelle image dans 'public/images'
            // et on récupère le chemin (ex: 'images/nouveau_nom.jpg')
            $path = $request->file('image')->store('images', 'public');

            // 3c. On sauvegarde ce nouveau chemin dans la base de données
            $user->image = $path;
        }

        // 4. On sauvegarde toutes les modifications sur l'utilisateur
        $user->save();

        // 5. On redirige avec un message de succès
        return Redirect::route('profile.edit')->with('status', 'profile modifié avec succès');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
