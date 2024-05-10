<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthAdminController extends Controller
{

    public function pageConnexion()
    {
        // Retourner la vue connexion
        return view('supper_admin.connexion.connexion');
    }
    
    // Gérer la soumission du formulaire de connexion
    public function connexion(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Authentification réussie, vérifiez le type de compte
            $user = Auth::user();
    
            if ($user->type_compte === 'comptable') {
                // Rediriger les comptables vers le tableau de bord des comptables
                return redirect('/comptable/dashboard');
            } else {
                // Rediriger les autres utilisateurs vers le tableau de bord de l'administration
                return redirect('/supper_admin/dashboard');
            }
        } else {
            // Authentification échouée, rediriger vers le formulaire de connexion avec un message d'erreur
            return redirect()->back()->withInput()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
        }
    }

    // Déconnexion de l'administrateur
    public function logout()
    {
        Auth::logout();
        return redirect('/supper_admin/connexion');
    }

}
