<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
use App\Models\Fret;
use App\Models\Demande;

class UtilisateurController extends Controller
{

    public function fret_enregister(Request $request, $numero)
    {
       // Valide les données envoyées par le formulaire
        $request->validate([
            'lieu_depart' => 'required|string',
            'lieu_arrive' => 'required|string',
            'montant' => 'required|string',
            'description' => 'required|string',
        ]);

         // Vérifie si le numéro de téléphone existe dans la table "users"
         $user = User::where('numero_tel', $request->numero_tel)->first();
         //$user = User::where('numero_tel', $chargeur)->first();

         // Si l'utilisateur correspondant au numéro de téléphone est trouvé
         if ($user) {
             // Crée un nouvel enregistrement dans la table "frets"
             $fret = new Fret();
             $fret->lieu_depart = $request->lieu_depart;
             $fret->lieu_arrive = $request->lieu_arrive;
             $fret->montant = $request->montant;
             $fret->description = $request->description;
             $fret->statut = 'En attente';
             //$fret->numero_tel = $request->numero_tel;
             $fret->numero_tel = $numero;
 
             // Sauvegarde l'enregistrement dans la base de données
             if ($fret->save()) {
                 // Message de succès si l'enregistrement est réussi
                 return redirect()->back()->with('message', 'Les informations ont été enregistrées avec succès.');
             } else {
                 // Message d'erreur si l'enregistrement a échoué
                 return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'enregistrement des informations.');
             }
         } else {
             // Si le numéro de téléphone n'est pas trouvé dans la table "users"
             return redirect()->back()->with('error', 'Le numéro de téléphone spécifié n\'existe pas.');
         }

    }


    public function demande(Request $request)
    {
        // Valide les données envoyées par le formulaire
        $request->validate([
            'id_fret' => 'required|array',
            'type_vehicule' => 'required|string',
            'montant' => 'required|string',
            'lieu_depart' => 'required|string',
            'lieu_arrive' => 'required|string',
        ]);
    
        // Crée une nouvelle demande
        $demande = new Demande();
        $demande->type_vehicule = $request->type_vehicule;
        $demande->montant = $request->montant;
        $demande->lieu_depart = $request->lieu_depart;
        $demande->lieu_arrive = $request->lieu_arrive;
        $demande->statut = 'En cours';
    
        // Sauvegarde la demande
        if (!$demande->save()) {
            // Si la sauvegarde échoue, redirige avec un message d'erreur
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la création de la demande.');
        }
    
        // Récupère l'ID de la nouvelle demande
        $nouvelleDemandeId = $demande->id;
    
        // Met à jour chaque fret pour associer l'ID de la nouvelle demande
        Fret::whereIn('id', $request->id_fret)->update(['id_demande' => $nouvelleDemandeId]);
    
        // Met à jour le statut des frets sélectionnés
        Fret::whereIn('id', $request->id_fret)->update(['statut' => 'En cours']);
    
        // Redirige avec un message de succès
        return redirect()->back()->with('message', 'Les informations ont été enregistrées avec succès.');
    }
    

    
}
