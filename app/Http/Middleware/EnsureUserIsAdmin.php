<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Réserve une partie du site aux administrateurs.
 *
 * S'utilise après le middleware "auth" :
 *   Route::middleware(['auth', 'admin'])...
 */
class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // La vérification est faite côté serveur : masquer un lien dans le
        // menu ne protège rien, seule cette barrière compte.
        if (! $user || ! $user->isAdmin()) {
            return redirect()
                ->route('student.dashboard')
                ->with('error', "Cet espace est réservé aux administrateurs.");
        }

        return $next($request);
    }
}
