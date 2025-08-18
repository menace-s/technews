<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next, ...$roles): Response // J'ai renommé $role en $roles pour plus de clarté
    {
        // 1. On récupère l'utilisateur connecté
        $user = Auth::user();

        // 2. On vérifie d'abord si un utilisateur est bien connecté
        if (!$user) {
            
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette ressource.');
        }

        // 3. On boucle sur la liste des rôles requis pour la page
        foreach ($roles as $role) {
            // 4. On utilise notre méthode magique hasRole()
            if ($user->hasRole($role)) {
                // 5. Si l'utilisateur a au moins UN des rôles, on le laisse passer et on arrête de vérifier
                return $next($request);
            }
        }

        // 6. Si la boucle se termine sans avoir trouvé de rôle correspondant, on bloque l'accès.
        abort(403, 'Accès interdit : Vous n\'avez pas les permissions nécessaires pour accéder à cette ressource.');
    }
}
