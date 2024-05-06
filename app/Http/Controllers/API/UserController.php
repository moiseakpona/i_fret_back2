<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nom' => 'sometimes|string',
            'prenom' => 'sometimes|string',
            'ville' => 'sometimes|string',
            'date_naissance' => 'sometimes|string',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->has('nom')) {
            $user->nom = $request->nom;
        }

        if ($request->has('prenom')) {
            $user->prenom = $request->prenom;
        }

        if ($request->has('ville')) {
            $user->ville = $request->ville;
        }

        if ($request->has('date_naissance')) {
            $user->date_naissance = $request->date_naissance;
        }

        if ($request->hasFile('photo')) {
            $profilePhotoPath = $request->file('photo')->store('profiles', 'public');
            $user->photo_path = $profilePhotoPath;
        }

        $user->save();

        return response()->json(['message' => 'Information(s) mise à jour'], 200);
    }


    public function getUtilisateur(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $utilisateur = Auth::user();

        // Retourner les informations de l'utilisateur
        return response()->json($utilisateur);
    }


}
