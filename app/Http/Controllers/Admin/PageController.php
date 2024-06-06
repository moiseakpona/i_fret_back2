<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Fret;
use App\Models\Demande;
use App\Models\Vehicule;
use App\Models\DetailChauffeur;
use App\Models\Envoyer;
use App\Models\Recevoir;

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

    public function details_chargeur(Request $request, $numero)
    {
        // Récupérer l'utilisateur avec le numéro de téléphone spécifié
        $chargeur = User::where('numero_tel', $numero)->first();

        // Retourner la vue details du chargeur
        return view('supper_admin.utilisateurs.details_chargeur', ['chargeur' => $chargeur]);
    }

    public function transporteur()
    {
        // Récupérer tous les transporteurs
        $transporteurs = User::where('type_compte', 'transporteur')->get();

        // Initialiser un tableau pour stocker les informations sur les transporteurs et leurs véhicules
        $transporteursDetails = [];

        // Pour chaque transporteur, récupérer les véhicules rejetés et validés
        foreach ($transporteurs as $transporteur) {
            $vehiculesRejetes = Vehicule::where('numero_tel', $transporteur->numero_tel)
                                        ->where('statut', 'Rejeté')
                                        ->count();

            $vehiculesValides = Vehicule::where('numero_tel', $transporteur->numero_tel)
                                        ->where('statut', 'Validé')
                                        ->count();

            // Stocker les informations dans le tableau
            $transporteursDetails[] = [
                'transporteur' => $transporteur,
                'vehiculesRejetes' => $vehiculesRejetes,
                'vehiculesValides' => $vehiculesValides,
            ];
        }

        // Retourner la vue avec la liste des utilisateurs chargeurs
        return view('supper_admin.utilisateurs.transporteur', ['transporteursDetails' => $transporteursDetails]);
    }



    public function details_transporteur(Request $request, $numero) 
    {
        // Récupérer l'utilisateur avec le numéro de téléphone spécifié
        $transporteur = User::where('numero_tel', $numero)->first();

        // Récupérer l'utilisateur avec le numéro de téléphone spécifié
        $transporteur = User::where('numero_tel', $numero)->first();

        // Récupérer les détails de transporteur correspondant
        $details = DetailChauffeur::where('numero_tel', $transporteur->numero_tel)->first();

        // Compter le nombre de véhicules rejetés du transporteur
        $vehiculesRejetes = Vehicule::where('numero_tel', $numero)
                                        ->where('statut', 'Rejeté')
                                        ->count();

        // Compter le nombre de véhicules validés du transporteur
        $vehiculesValides = Vehicule::where('numero_tel', $numero)
                                        ->where('statut', 'Validé')
                                        ->count();

        // Retourner la vue details du Transporteur avec les données nécessaires
        return view('supper_admin.utilisateurs.details_transporteur', [
            'transporteur' => $transporteur,
            'details' => $details,
            'vehiculesRejetes' => $vehiculesRejetes,
            'vehiculesValides' => $vehiculesValides,
        ]);
    }



    public function chauffeur()
    {
        // Récupérer tous les utilisateurs de type_compte "chauffeur"
        $chauffeurs = User::where('type_compte', 'chauffeur')->get();

        // Tableau pour stocker les détails des chauffeurs
        $chauffeursAvecDetails = [];

        // Pour chaque chauffeur, récupérer ses détails de chauffeur
        foreach ($chauffeurs as $chauffeur) {
            $details = DetailChauffeur::where('numero_tel', $chauffeur->numero_tel)->first();
                // Ajouter les au tableau
                $chauffeursAvecDetails[] = [
                    'chauffeur' => $chauffeur,
                    'details' => $details
                ];
        }

        // Retourner la vue avec la liste des utilisateurs chauffeurs
        return view('supper_admin.utilisateurs.chauffeur', ['chauffeursAvecDetails' => $chauffeursAvecDetails]);
    }



    public function details_chauffeur(Request $request, $numero)
    {
        // Récupérer l'utilisateur avec le numéro de téléphone spécifié
        $chauffeur = User::where('numero_tel', $numero)->first();

        // Récupérer les détails de chauffeur correspondant
        $details = DetailChauffeur::where('numero_tel', $chauffeur->numero_tel)->first();

        // Retourner la vue details du Chauffeur
        return view('supper_admin.utilisateurs.details_chauffeur', ['chauffeur' => $chauffeur, 'details' => $details]);
    }


    public function supprimer_chargeur($id)
    {
        // Trouver l'utilisateur à supprimer
        $utilisateur = User::find($id);

        // Supprimer l'utilisateur de la base de données
        $utilisateur->delete();

        // Retourner une réponse de succès
        return redirect()->route('utilisateurs.chargeur')->with('message', 'Utilisateur supprimé avec succès.');
    }


    public function supprimer_chauffeur($id)
    {
        // Trouver l'utilisateur à supprimer
        $utilisateur = User::find($id);

        // Supprimer l'utilisateur de la base de données
        $utilisateur->delete();

        // Retourner une réponse de succès
        return redirect()->route('utilisateurs.chauffeur')->with('message', 'Utilisateur supprimé avec succès.');
    }


    public function supprimer_transporteur($id)
    {
        // Trouver l'utilisateur à supprimer
        $utilisateur = User::find($id);

        // Supprimer l'utilisateur de la base de données
        $utilisateur->delete();

        // Retourner une réponse de succès
        return redirect()->route('utilisateurs.transporteur')->with('message', 'Utilisateur supprimé avec succès.');
    }



    public function rejete()
    {
        // Récupérer la liste des véhicules dont le statut est "rejete"
        $rejete = Vehicule::where('statut', 'Rejeté')->get();

        // Retourner la vue des camions Rejetés
        return view('supper_admin.camions.rejete', ['rejete' => $rejete]);
    }


    public function detail_rejete(Request $request, $id)
    {
        // Récupérer le véhicule avec l'id spécifié
        $vehicule = Vehicule::where('id', $id)->first();

        // Récupérer le numéro de telephone du véhicule 
        $numero = $vehicule->numero_tel;

        // Recherche le transporteur correspondant au numero de telelphone recuperé
        $transporteur = User::where('numero_tel', $numero)->first();
        
        // Retourner la vue des camions Rejetés
        return view('supper_admin.camions.detail_rejete', ['vehicule' => $vehicule, 'transporteur' => $transporteur]);
    }


    public function valide()
    {
        // Récupérer la liste des véhicules dont le statut est "validé"
        $valide = Vehicule::where('statut', 'Validé')->get();

        // Retourner la vue des camions Validés
        return view('supper_admin.camions.valide', ['valide' => $valide]);
    }

    public function detail_valide(Request $request, $id)
    {
        // Récupérer le véhicule avec l'id spécifié
        $vehicule = Vehicule::where('id', $id)->first();

        // Récupérer le numéro de telephone du véhicule 
        $numero = $vehicule->numero_tel;

        // Recherche le transporteur correspondant au numero de telelphone recuperé
        $transporteur = User::where('numero_tel', $numero)->first();
        
        // Retourner la vue des camions Rejetés
        return view('supper_admin.camions.detail_valide', ['vehicule' => $vehicule, 'transporteur' => $transporteur]);
    }


    public function en_attent()
    {
        // Récupérer la liste des véhicules dont le statut est "en_attent"
        $en_attent = Vehicule::where('statut', 'En attent')->get();

        // Retourner la vue des camions En attents
        return view('supper_admin.camions.en_attent', ['en_attent' => $en_attent]);
    }


    public function detail_en_attent(Request $request, $id)
    {
        // Récupérer le véhicule avec l'id spécifié
        $vehicule = Vehicule::where('id', $id)->first();

        // Récupérer le numéro de telephone du véhicule 
        $numero = $vehicule->numero_tel;

        // Recherche le transporteur correspondant au numero de telelphone recuperé
        $transporteur = User::where('numero_tel', $numero)->first();
        
        // Retourner la vue des camions Rejetés
        return view('supper_admin.camions.detail_en_attent', ['vehicule' => $vehicule, 'transporteur' => $transporteur]);
    }


    public function forme_valide_vehicule(Request $request, $id)
    {
        // Trouver le véhicule à mettre à jour
        $vehicule = Vehicule::findOrFail($id);

        // Mettre à jour les tables visite_exp; assurance_exp et le statut
        $vehicule->visite_exp = $request->input('visite_exp');
        $vehicule->assurance_exp = $request->input('assurance_exp');
        $vehicule->statut = 'Validé';

        // Sauvegarder les modifications dans la base de données
        $vehicule->save();

        // Retourner une réponse de succès
        return redirect()->route('camions.en_attent')->with('message', 'Véhicule validé avec succès.');
    }


    public function forme_rejete_vehicule(Request $request, $id)
    {
        // Trouver le véhicule à mettre à jour
        $vehicule = Vehicule::findOrFail($id);

        // Mettre à jour les tables commentaire du vehicule
        $matricule_commentaire = $request->input('matricule_commentaire');
        $photo_camion_commentaire = $request->input('photo_camion_commentaire');
        $carte_grise_commentaire = $request->input('carte_grise_commentaire');
        $assurance_commentaire = $request->input('assurance_commentaire');
        $visite_technique_commentaire = $request->input('visite_technique_commentaire');
        $vehicule->statut = 'Rejeté';

        // Vérifier si les champs ne sont pas nul avant de les mettre à jour
        if ($matricule_commentaire) {
            $vehicule->matricule_commentaire = $matricule_commentaire;
        }
        if ($photo_camion_commentaire) {
            $vehicule->photo_camion_commentaire = $photo_camion_commentaire;
        }
        if ($carte_grise_commentaire) {
            $vehicule->carte_grise_commentaire = $carte_grise_commentaire;
        }
        if ($assurance_commentaire) {
            $vehicule->assurance_commentaire = $assurance_commentaire;
        }
        if ($visite_technique_commentaire) {
            $vehicule->visite_technique_commentaire = $visite_technique_commentaire;
        }

        // Sauvegarder les modifications dans la base de données
        $vehicule->save();

        // Retourner une réponse de succès
        return redirect()->route('camions.en_attent')->with('error', 'Véhicule rejeté avec succès.');
    }


    public function supprimer_vehicule_rejete($id)
    {
        // Trouver le vehicule à supprimer
        $vehicule = Vehicule::find($id);

        // Supprimer le véhicule de la base de données
        $vehicule->delete();

        // Retourner une réponse de succès
        return redirect()->route('camions.rejete')->with('message', 'Véhicule supprimé avec succès.');
    }


    public function supprimer_vehicule_valide($id)
    {
        // Trouver le vehicule à supprimer
        $vehicule = Vehicule::find($id);

        // Supprimer le véhicule de la base de données
        $vehicule->delete();

        // Retourner une réponse de succès
        return redirect()->route('camions.valide')->with('message', 'Véhicule supprimé avec succès.');
    }


    public function supprimer_vehicule_en_attent($id)
    {
        // Trouver le vehicule à supprimer
        $vehicule = Vehicule::find($id);

        // Supprimer le véhicule de la base de données
        $vehicule->delete();

        // Retourner une réponse de succès
        return redirect()->route('camions.en_attent')->with('message', 'Véhicule supprimé avec succès.');
    }



    public function chat_chargeur()
    {
        // Récupérer l'utilisateur connecté
        $admin = auth()->user();

       
        // <-- message non lu -->
        // Récupérer les numéros de téléphone distincts de la table Envoyer
        $numeros_telephone = Envoyer::distinct()->pluck('numero_tel')->toArray();

        // Supprimer les doublons des numéros de téléphone
        $numeros_tel = array_unique($numeros_telephone);
         
        // <-- Autre fonction en interne -->
         // Récupérer les numéros de téléphone distincts des utilisateurs
         $numeros_telephone = User::where('type_compte', 'Chargeur')->distinct()->pluck('numero_tel')->toArray();

         // Filtrer les numéros de téléphone pour exclure ceux ayant des envois non lus
         $numeros_tel_lu = array_diff($numeros_telephone, $numeros_tel);
 
         // Récupérer les utilisateurs correspondant aux numéros de téléphone trouvés
         $chargeurs = User::whereIn('numero_tel', $numeros_tel_lu)->get();
        // < !-- Autre fonction en interne -->

        // Récupérer les utilisateurs correspondant aux numéros de téléphone trouvés
        $utilisateurs = User::whereIn('numero_tel', $numeros_tel)->get();

        // Tableau pour stocker les utilisateurs avec leurs derniers messages
        $usersEtEndMessage = [];

        // Parcourir chaque utilisateur pour récupérer son dernier message envoyé
        foreach ($utilisateurs as $utilisateur) {
            $dernierMessage = Envoyer::where('numero_tel', $utilisateur->numero_tel)
                ->orderByDesc('created_at')
                ->first();

            // Assigner le dernier message à l'utilisateur
            $usersEtEndMessage[] = [
                'utilisateur' => $utilisateur,
                'dernierMessage' => $dernierMessage,
            ];
        }
        // < !-- message non lu -->


        // Retourner la vue du chat Chargeur
        return view('supper_admin.chats.chargeur', ['admin' => $admin, 'usersEtEndMessage' => $usersEtEndMessage, 'chargeurs' => $chargeurs ]);
    }



    public function detail_chat(Request $request, $numero)
    {
        // Récupère les messavage envoyer par ce utilisateur
        $envois = Envoyer::where('numero_tel', $numero)
                            ->orderBy('created_at')
                            ->get();

        // Parcourir chaque message et mettre à jour le statut
        foreach ($envois as $envoi) {
            $envoi->statut = 'Lu';
            $envoi->save();
        }

        // Récupère les messavage Reçu par ce utilisateur
        $receptions = Recevoir::where('numero_tel', $numero)
                            ->orderBy('created_at')
                            ->get();

        // Récupérer l'utilisateur avec le numéro de téléphone spécifié
        $chargeur_online = User::where('numero_tel', $numero)->first();

        // Récupérer l'utilisateur connecté
        $admin = auth()->user();

        // Récupérer la liste des utilisateurs dont le type de compte est "chargeur"
        $chargeurs = User::where('type_compte', 'chargeur')->get();

       // Récupérer les numéros de téléphone distincts des utilisateurs ayant des envois lus
       $numeros_telephone = User::where('type_compte', 'Chargeur')->distinct()->pluck('numero_tel')->toArray();

       // Récupérer les numéros de téléphone distincts des utilisateurs ayant des envois non lus
       $numeros_tel_non_lus = Envoyer::where('statut', 'Non lu')->distinct()->pluck('numero_tel')->toArray();

       // Filtrer les numéros de téléphone pour exclure ceux ayant des envois non lus
       $numeros_tel_lu = array_diff($numeros_telephone, $numeros_tel_non_lus);

       // Récupérer les utilisateurs correspondant aux numéros de téléphone trouvés
       $chargeurs = User::whereIn('numero_tel', $numeros_tel_lu)->get();

        // <-- message non lu -->
        // Récupérer les numéros de téléphone distincts de la table Envoyer
        $numeros_telephone = Envoyer::distinct()->pluck('numero_tel')->toArray();

        // Supprimer les doublons des numéros de téléphone
        $numeros_tel = array_unique($numeros_telephone);

         
        // <-- Autre fonction en interne -->
         // Récupérer les numéros de téléphone distincts des utilisateurs
         $numeros_telephone = User::where('type_compte', 'Chargeur')->distinct()->pluck('numero_tel')->toArray();

         // Filtrer les numéros de téléphone pour exclure ceux ayant des envois non lus
         $numeros_tel_lu = array_diff($numeros_telephone, $numeros_tel);
 
         // Récupérer les utilisateurs correspondant aux numéros de téléphone trouvés
         $chargeurs = User::whereIn('numero_tel', $numeros_tel_lu)->get();
        // < !-- Autre fonction en interne -->

        // Récupérer les utilisateurs correspondant aux numéros de téléphone trouvés
        $utilisateurs = User::whereIn('numero_tel', $numeros_tel)->get();

        // Tableau pour stocker les utilisateurs avec leurs derniers messages
        $usersEtEndMessage = [];

        // Parcourir chaque utilisateur pour récupérer son dernier message envoyé
        foreach ($utilisateurs as $utilisateur) {
            $dernierMessage = Envoyer::where('numero_tel', $utilisateur->numero_tel)
                ->orderByDesc('created_at')
                ->first();

            // Assigner le dernier message à l'utilisateur
            $usersEtEndMessage[] = [
                'utilisateur' => $utilisateur,
                'dernierMessage' => $dernierMessage,
            ];
        }
        // < !-- message non lu -->


        // Retourner la vue du chat Chargeur
        return view('supper_admin.chats.detail_chat', ['admin' => $admin, 'chargeurs' => $chargeurs, 'chargeur_online' => $chargeur_online, 'usersEtEndMessage' => $usersEtEndMessage, 'chargeurs' => $chargeurs,  'envois' => $envois, 'receptions' => $receptions]);
    }



    public function compte_chat_non_lu()
    {
        // Compte le nombre de message non lu dans le chat
        $chat_non_lu = Envoyer::where('statut', '')->count();

        // Retourner  la vue correspondante
        return $chat_non_lu;
    }



    
    public function gestion_demande()
    {
        // Retourner la vue Gestion demande
        return view('supper_admin.gestion_demande.gestion_demande');
    }


    public function gestion_fret()
    {
        // Récupérer la liste des frets de statut "en attente"
        $fretsEnAttente = Fret::where('statut', 'En attent')->get();

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
        $fretsEnAttente = Fret::where('statut', 'En attent')->get();

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


    public function soumissionnaire()
    {
        // Retourner la vue connexion
        return view('supper_admin.gestion_demande.soumissionnaire');
    }


    public function detail_demande()
    {
        // Retourner la vue connexion
        return view('supper_admin.gestion_demande.detail_demande');
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
