<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Vérifie les identifiants et ouvre la session.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Auth::attempt() cherche un utilisateur qui correspond à TOUTES les
        // clés du tableau, puis compare le mot de passe haché (bcrypt).
        // La clé is_active => true empêche un compte désactivé de se connecter.
        $authenticated = Auth::attempt([
            'email' => mb_strtolower($credentials['email']),
            'password' => $credentials['password'],
            'is_active' => true,
        ], $request->boolean('remember'));

        if (! $authenticated) {
            // Message distinct si le compte existe mais a été désactivé :
            // plus clair pour l'utilisateur, sans révéler de mot de passe.
            $disabled = User::where('email', mb_strtolower($credentials['email']))
                ->where('is_active', false)
                ->exists();

            throw ValidationException::withMessages([
                'email' => $disabled
                    ? 'Ce compte a été désactivé. Contactez un administrateur.'
                    : 'Ces identifiants ne correspondent à aucun compte.',
            ]);
        }

        $request->session()->regenerate();

        // intended() renvoie vers la page demandée avant la redirection
        // vers /login, sinon vers le tableau de bord du rôle.
        return redirect()
            ->intended($request->user()->dashboardUrl())
            ->with('success', 'Content de te revoir, '.$request->user()->name.' !');
    }

    /**
     * Déconnexion : on ferme la session et on régénère le jeton CSRF.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Tu es déconnecté. À bientôt !');
    }
}
