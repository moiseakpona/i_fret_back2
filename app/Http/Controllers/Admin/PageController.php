<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fret;
use App\Models\Demande;
use App\Models\Vehicule;

class PageController extends Controller
{

    public function dashboard()
    {
        $statistics = [];

        // Compter le nombre total de véhicules
        $statistics['vehicule'] = Vehicule::count();

        // Compter le nombre d'utilisateurs avec différents statuts
        $statistics['en_attente'] = Vehicule::where('statut', 'En attent')->count();
        $statistics['rejete'] = Vehicule::where('statut', 'Rejeté')->count();
        $statistics['valide'] = Vehicule::where('statut', 'Validé')->count();

        // Compter le nombre d'utilisateurs par type de compte
        $statistics['chargeur'] = User::where('type_compte', 'chargeur')->count();
        $statistics['chauffeur'] = User::where('type_compte', 'chauffeur')->count();
        $statistics['transporteur'] = User::where('type_compte', 'transporteur')->count();

        // Compter le nombre total d'utilisateurs
        $statistics['user'] = $statistics['chargeur'] + $statistics['chauffeur'] + $statistics['transporteur'];

        // Retourner la vue dashboard
        return view('supper_admin.dashboard', compact('statistics'));
    }

    public function chargeur()
    {
          // Récupérer la liste des utilisateurs dont le type de compte est "chargeur"
          $liste_chargeur = User::where('type_compte', 'chargeur')->get();

          // Retourner la vue avec la liste des utilisateurs chargeurs
          return view('supper_admin.utilisateurs.chargeur', ['liste_chargeur' => $liste_chargeur]);
    }

    public function details_chargeur()
    {
        // Retourner la vue details du chargeur
        return view('supper_admin.utilisateurs.details_chargeur');
    }

    public function transporteur()
    {
        // Récupérer la liste des utilisateurs dont le type de compte est "transporteur"
        $liste_transporteur = User::where('type_compte', 'transporteur')->get();

        // Retourner la vue avec la liste des utilisateurs chargeurs
        return view('supper_admin.utilisateurs.transporteur', ['liste_transporteur' => $liste_transporteur]);
    }

    public function details_transporteur()
    {
        // Retourner la vue details du Transporteur
        return view('supper_admin.utilisateurs.details_transporteur');
    }

    public function chauffeur()
    {
        // Récupérer la liste des utilisateurs dont le type de compte est "chauffeur"
        $liste_chauffeur = User::where('type_compte', 'chauffeur')->get();

        // Retourner la vue avec la liste des utilisateurs chauffeurs
        return view('supper_admin.utilisateurs.chauffeur', ['liste_chauffeur' => $liste_chauffeur]);
    }

    public function details_chauffeur()
    {
        // Retourner la vue details du Chauffeur
        return view('supper_admin.utilisateurs.details_chauffeur');
    }

    public function rejete()
    {
        // Retourner la vue des camions Rejetés
        return view('supper_admin.camions.rejete');
    }

    public function valide()
    {
        // Retourner la vue des camions Validés
        return view('supper_admin.camions.valide');
    }

    public function en_attent()
    {
        // Retourner la vue des camions En attents
        return view('supper_admin.camions.en_attent');
    }

    public function chat_chargeur()
    {
        // Retourner la vue du chat Chargeur
        return view('supper_admin.chats.chargeur');
    }
    
    public function gestion_demande()
    {
        // Retourner la vue Gestion demande
        return view('supper_admin.gestion_demande.gestion_demande');
    }


    public function gestion_fret()
    {
        // Récupérer la liste des frets de statut "en attente"
        $fretsEnAttente = Fret::where('statut', 'En attente')->get();

        // Récupérer la liste des demandes
        $demandes = Demande::all();

        // Tableau pour stocker les informations sur les demandes avec les frets et les utilisateurs correspondants
        $demandeFretsUser = [];

        // Parcourir chaque demande
        foreach ($demandes as $demande) {
            // Récupérer l'ID de la demande
            $demandeId = $demande->id;

            // Récupérer la liste des frets associés à cette demande
            $frets = Fret::where('id_demande', $demandeId)->get();

            // Tableau pour stocker les informations sur les utilisateurs correspondant à chaque fret
            $utilisateursFrets = [];

            // Pour chaque fret, récupérer les informations sur l'utilisateur correspondant
            foreach ($frets as $fret) {
                // Récupérer le numéro de téléphone associé à ce fret
                $numeroTelephone = $fret->numero_tel;
                
                // Récupérer l'utilisateur correspondant au numéro de téléphone
                $user = User::where('numero_tel', $numeroTelephone)->first();

                // Stocker les informations sur l'utilisateur correspondant à ce fret
                $utilisateursFrets[] = $user;
            }

            // Stocker les informations sur la demande, les frets et les utilisateurs correspondants
            $demandeFretsUser[] = [
                'demande' => $demande,
                'frets' => $frets,
                'utilisateurs' => $utilisateursFrets,
            ];
        }

        // Retourner la vue Gestion demande
        return view('supper_admin.gestion_demande.gestion_fret', ['fretsEnAttente' => $fretsEnAttente, 'demandeFretsUser' => $demandeFretsUser]);
    }



    public function fret_diponible()
    {
        // Récupérer la liste des frets de statut "en attente"
        $fretsEnAttente = Fret::where('statut', 'En attente')->get();

        // Tableau pour stocker les résultats
        $resultats = [];

        // Pour chaque fret en attente
        foreach ($fretsEnAttente as $fret) {
            // Récupérer le numéro de téléphone du camp
            $numeroTel = $fret->numero_tel;

            // Vérifier l'utilisateur correspondant à ce numéro de téléphone
            $chargeur = User::where('numero_tel', $numeroTel)->first();

            // Ajouter le fret et l'utilisateur correspondant aux résultats
            $resultats[] = [
                'fret' => $fret,
                'chargeur' => $chargeur
            ];
        }
        
        // Retourner la vue avec la liste des frets en attente
        return view('supper_admin.gestion_demande.fret_diponible', ['resultats' => $resultats]);
    }

    public function traking()
    {
        // Retourner la vue Traking
        return view('supper_admin.traking');
    }

    public function password()
    {
        // Retourner la vue mot de passe oublié
        return view('supper_admin.connexion.password');
    }


    //==========================================================


    public function details()
    {
        // Retourner la vue connexion
        return view('supper_admin.gestion_demande.details');
    }


    public function details_val_camion()
    {
        // Retourner la vue des camions à valider en attent
        return view('supper_admin.camions.details_val_camion');
    }










    public function essai()
    {
        // Retourner la vue du chargeur
        return view('essai');
    }




}
