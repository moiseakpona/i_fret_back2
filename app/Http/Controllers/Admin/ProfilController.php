<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{

    public function profil()
    {
        // Récupérer l'utilisateur connecté
        $admin = auth()->user();

        // Retourner la vue profil du paramètre de l'admin
        return view('supper_admin.parametre.profil', ['admin' => $admin]);
    }

    public function securite()
    {
        // Retourner la vue securité du paramètre de l'admin
        return view('supper_admin.parametre.securite');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect('/supper_admin/parametre/securite')->with('success', 'Mot de passe modifié avec succès!');
        } else {
            return redirect()->back()->with('error', 'Le mot de passe actuel est incorrect.');
        }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2 Mo max
        ]);

        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();

        // Déplacer l'image vers le dossier public/images
        $image->move(public_path('images'), $imageName);

        // Mettre à jour le champ photo de l'utilisateur
        $user = auth()->user(); // Vous pouvez récupérer l'utilisateur actuel comme ça
        $user->photo = $imageName;
        $user->save();

        return redirect('supper_admin/parametre/profil')->with('success', 'Photo mis à jour avec succès');
    }
    


    public function update_admin(Request $request, $id)
    {
        // Trouver l'utilisateur à mettre à jour
        $user = User::findOrFail($id);

        // Mettre à jour les informations de l'utilisateur avec les données du formulaire
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('email');
        $user->ville = $request->input('ville');
        // Vérifier si le champ date_naissance n'est pas nul avant de le mettre à jour
        $date_naissance = $request->input('date_naissance');
        if ($date_naissance) {
            $user->date_naissance = $date_naissance;
        }
            $user->numero_tel = $request->input('numero_tel');
        $user->type_compte = $request->input('type_compte');

        // Sauvegarder les modifications dans la base de données
        $user->save();

        // Retourner une réponse de succès
        return back()->with('message', 'Informations mises à jour avec succès.');
    }



}
