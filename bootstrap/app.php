<?php

use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Un visiteur non connecté qui demande une page protégée est envoyé
        // vers la page de connexion (et non vers une erreur 401/404).
        $middleware->redirectGuestsTo(fn () => route('login'));

        // Un utilisateur déjà connecté qui ouvre /login ou /register est
        // renvoyé vers SON tableau de bord, selon son rôle.
        $middleware->redirectUsersTo(
            fn (Request $request) => $request->user()->dashboardUrl()
        );

        // Alias court utilisable dans routes/web.php : middleware('admin')
        $middleware->alias([
            'admin' => EnsureUserIsAdmin::class,
        ]);

        // L'application tourne derrière le proxy de l'aperçu, qui termine le
        // HTTPS puis transmet la requête en HTTP avec l'en-tête
        // « X-Forwarded-Proto: https ». Sans cette confiance explicite, Laravel
        // génère des URL d'assets en http:// que le navigateur bloque (contenu
        // mixte) : la page s'affiche alors sans le moindre style.
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
