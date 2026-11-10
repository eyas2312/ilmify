<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Valide le formulaire, crée le compte étudiant puis connecte l'utilisateur.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validation : si une règle échoue, Laravel renvoie automatiquement
        //    vers le formulaire avec les erreurs et les anciennes valeurs (old()).
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:80'],
            'email' => ['required', 'string', 'email', 'max:120', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        // 2. Création du compte. Le rôle est imposé côté serveur :
        //    un visiteur ne peut jamais s'inscrire comme administrateur.
        $user = User::create([
            'name' => trim($data['name']),
            'email' => mb_strtolower($data['email']),
            'password' => $data['password'], // haché automatiquement par le cast "hashed" du modèle
            'role' => User::ROLE_STUDENT,
            'is_active' => true,
        ]);

        // 3. Connexion immédiate : pas besoin de ressaisir ses identifiants.
        Auth::login($user);

        // 4. Nouvel identifiant de session : protège contre la fixation de session.
        $request->session()->regenerate();

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Bienvenue sur Ilmify, '.$user->name.' !');
    }
}
