<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Fret;
use App\Models\Vehicule;
use App\Models\DetailChauffeur;
use App\Models\Envoyer;
use App\Models\Recevoir;
use App\Models\Soumissionnaire;

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

        // Compter le nombre de frets payés liés à cet utilisateur
        $fretCount = Fret::where('numero_tel', $chargeur->numero_tel)
                        ->where('statut_paiement', 'payé')
                        ->count();

        // Calculer le montant total des frets où le statut de paiement est égal à "payé"
        $totalMontantPaye = Fret::where('numero_tel', $chargeur->numero_tel)
                                ->where('statut_paiement', 'payé')
                                ->sum('montant');

        // Retourner la vue details du chargeur
        return view('supper_admin.utilisateurs.details_chargeur', ['chargeur' => $chargeur, 'fretCount' => $fretCount, 'totalMontantPaye' => $totalMontantPaye]);
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

        // Compter le nombre de fois que le transporteur à été retenu pour une demande de transport
        $voyageCount = soumissionnaire::where('numero_tel_transport', $numero)
                        ->where('statut', 'Retenu')
                        ->count();

        // Calculer le montant total d'argent recu par le transporteur
        $totalMontantRecu = soumissionnaire::where('numero_tel_transport', $numero)
                        ->where('statut', 'Retenu')
                        ->sum('montant');
        
        // Retourner la vue details du Transporteur avec les données nécessaires
        return view('supper_admin.utilisateurs.details_transporteur', [
            'transporteur' => $transporteur,
            'details' => $details,
            'vehiculesRejetes' => $vehiculesRejetes,
            'vehiculesValides' => $vehiculesValides,
            'voyageCount' => $voyageCount,
            'totalMontantRecu' => $totalMontantRecu,
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

        // Compter le nombre de de voyage zffectué par le chaiffeur
        $voyageCount = soumissionnaire::where('numero_tel_chauffeur', $numero)
                        ->where('statut', 'Retenu')
                        ->count();

        // Retourner la vue details du Chauffeur
        return view('supper_admin.utilisateurs.details_chauffeur', ['chauffeur' => $chauffeur, 'details' => $details, 'voyageCount' => $voyageCount]);
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



    // public function chat_chargeur()
    // {
    //     // Récupérer l'utilisateur connecté
    //     $admin = auth()->user();

       
    //     // <-- message non lu -->
    //     // Récupérer les numéros de téléphone distincts de la table Envoyer
    //     $numeros_telephone = Envoyer::distinct()->pluck('numero_tel')->toArray();

    //     // Supprimer les doublons des numéros de téléphone
    //     $numeros_tel = array_unique($numeros_telephone);
         
    //     // <-- Autre fonction en interne -->
    //      // Récupérer les numéros de téléphone distincts des utilisateurs
    //      $numeros_telephone = User::where('type_compte', 'Chargeur')->distinct()->pluck('numero_tel')->toArray();

    //      // Filtrer les numéros de téléphone pour exclure ceux ayant des envois non lus
    //      $numeros_tel_lu = array_diff($numeros_telephone, $numeros_tel);
 
    //      // Récupérer les utilisateurs correspondant aux numéros de téléphone trouvés
    //      $chargeurs = User::whereIn('numero_tel', $numeros_tel_lu)->get();
    //     // < !-- Autre fonction en interne -->

    //     // Récupérer les utilisateurs correspondant aux numéros de téléphone trouvés
    //     $utilisateurs = User::whereIn('numero_tel', $numeros_tel)->get();

    //     // Tableau pour stocker les utilisateurs avec leurs derniers messages
    //     $usersEtEndMessage = [];

    //     // Parcourir chaque utilisateur pour récupérer son dernier message envoyé
    //     foreach ($utilisateurs as $utilisateur) {
    //         $dernierMessage = Envoyer::where('numero_tel', $utilisateur->numero_tel)
    //             ->orderByDesc('created_at')
    //             ->first();

    //         // Assigner le dernier message à l'utilisateur
    //         $usersEtEndMessage[] = [
    //             'utilisateur' => $utilisateur,
    //             'dernierMessage' => $dernierMessage,
    //         ];
    //     }
    //     // < !-- message non lu -->


    //     // Retourner la vue du chat Chargeur
    //     return view('supper_admin.chats.chargeur', ['admin' => $admin, 'usersEtEndMessage' => $usersEtEndMessage, 'chargeurs' => $chargeurs ]);
    // }




    // public function detail_chat(Request $request, $numero)
    // {
    //     // Récupère les messavage envoyer par ce utilisateur
    //     $envois = Envoyer::where('numero_tel', $numero)
    //                         ->orderBy('created_at')
    //                         ->get();

    //     // Parcourir chaque message et mettre à jour le statut
    //     foreach ($envois as $envoi) {
    //         $envoi->statut = 'Lu';
    //         $envoi->save();
    //     }

    //     // Récupère les messavage Reçu par ce utilisateur
    //     $receptions = Recevoir::where('numero_tel', $numero)
    //                         ->orderBy('created_at')
    //                         ->get();

    //     // Récupérer l'utilisateur avec le numéro de téléphone spécifié
    //     $chargeur_online = User::where('numero_tel', $numero)->first();

    //     // Récupérer l'utilisateur connecté
    //     $admin = auth()->user();

    //     // Récupérer la liste des utilisateurs dont le type de compte est "chargeur"
    //     $chargeurs = User::where('type_compte', 'chargeur')->get();

    //    // Récupérer les numéros de téléphone distincts des utilisateurs ayant des envois lus
    //    $numeros_telephone = User::where('type_compte', 'Chargeur')->distinct()->pluck('numero_tel')->toArray();

    //    // Récupérer les numéros de téléphone distincts des utilisateurs ayant des envois non lus
    //    $numeros_tel_non_lus = Envoyer::where('statut', 'Non lu')->distinct()->pluck('numero_tel')->toArray();

    //    // Filtrer les numéros de téléphone pour exclure ceux ayant des envois non lus
    //    $numeros_tel_lu = array_diff($numeros_telephone, $numeros_tel_non_lus);

    //    // Récupérer les utilisateurs correspondant aux numéros de téléphone trouvés
    //    $chargeurs = User::whereIn('numero_tel', $numeros_tel_lu)->get();

    //     // <-- message non lu -->
    //     // Récupérer les numéros de téléphone distincts de la table Envoyer
    //     $numeros_telephone = Envoyer::distinct()->pluck('numero_tel')->toArray();

    //     // Supprimer les doublons des numéros de téléphone
    //     $numeros_tel = array_unique($numeros_telephone);

         
    //     // <-- Autre fonction en interne -->
    //      // Récupérer les numéros de téléphone distincts des utilisateurs
    //      $numeros_telephone = User::where('type_compte', 'Chargeur')->distinct()->pluck('numero_tel')->toArray();

    //      // Filtrer les numéros de téléphone pour exclure ceux ayant des envois non lus
    //      $numeros_tel_lu = array_diff($numeros_telephone, $numeros_tel);
 
    //      // Récupérer les utilisateurs correspondant aux numéros de téléphone trouvés
    //      $chargeurs = User::whereIn('numero_tel', $numeros_tel_lu)->get();
    //     // < !-- Autre fonction en interne -->

    //     // Récupérer les utilisateurs correspondant aux numéros de téléphone trouvés
    //     $utilisateurs = User::whereIn('numero_tel', $numeros_tel)->get();

    //     // Tableau pour stocker les utilisateurs avec leurs derniers messages
    //     $usersEtEndMessage = [];

    //     // Parcourir chaque utilisateur pour récupérer son dernier message envoyé
    //     foreach ($utilisateurs as $utilisateur) {
    //         $dernierMessage = Envoyer::where('numero_tel', $utilisateur->numero_tel)
    //             ->orderByDesc('created_at')
    //             ->first();

    //         // Assigner le dernier message à l'utilisateur
    //         $usersEtEndMessage[] = [
    //             'utilisateur' => $utilisateur,
    //             'dernierMessage' => $dernierMessage,
    //         ];
    //     }
    //     // < !-- message non lu -->


    //     // Retourner la vue du chat Chargeur
    //     return view('supper_admin.chats.detail_chat', ['admin' => $admin, 'chargeurs' => $chargeurs, 'chargeur_online' => $chargeur_online, 'usersEtEndMessage' => $usersEtEndMessage, 'chargeurs' => $chargeurs,  'envois' => $envois, 'receptions' => $receptions]);
    // }



    public function compte_chat_non_lu()
    {
        // Compte le nombre de message non lu dans le chat
        $chat_non_lu = Envoyer::where('statut', '')->count();

        // Retourner  la vue correspondante
        return $chat_non_lu;
    }



    
    public function gestion_demande()
    {
        // Récupérer la liste des demandes
        $demandes = Fret::where('statut', '!=', 'En attente')->get();

        // Retourner la vue Gestion demande
        return view('supper_admin.gestion_demande.gestion_demande', ['demandes' => $demandes]);
    }


    public function finaliser($id)
    {
        // Chercher le fret par son ID
        $fret = Fret::find($id);

        if ($fret) {
            // Mettre à jour le statut
            $fret->statut = 'Finalisé';

            // Enregistrer les modifications
            $fret->save();

            // Retourner un message de succès
            return redirect()->back()->with('message', 'Le statut de la demande a été mis à jour avec succès.');
        }

        // Retourner un message d'erreur si le soumissionnaire n'est pas trouvé
        return redirect()->back()->with('error', 'Une erreur s est produite.');
    }



    public function gestion_fret()
    {
        // Récupérer la liste des frets de statut "en attente"
        $frets = Fret::get();

        // Tableau pour stocker les informations sur les utilisateurs correspondant à chaque fret
        $utilisateursFrets = [];

        // Pour chaque fret, récupérer les informations sur l'utilisateur correspondant
        foreach ($frets as $fret) {
            // Récupérer le numéro de téléphone du camp
            $numeroTel = $fret->numero_tel;
            
            // Récupérer l'utilisateur correspondant au numéro de téléphone
            $chargeur = User::where('numero_tel', $numeroTel)->first();

            // Stocker les informations sur la demande, les frets et les utilisateurs correspondants
            $utilisateursFrets[] = [
                'fret' => $fret,
                'chargeur' => $chargeur,
            ];

        }

        // Retourner la vue Gestion demande
        return view('supper_admin.gestion_demande.gestion_fret', ['utilisateursFrets' => $utilisateursFrets]);
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


    public function paiement()
    {
        // Récupérer les frets dont le statut_paiement est "payé"
        $frets = Fret::where('statut_paiement', 'payé')->get();

        $resultat = [];

        // Parcourir chaque fret pour vérifier la table soumissionnaire
        foreach ($frets as $fret) {
            // Chercher le soumissionnaire correspondant au fret avec statut "retenu"
            $soumissionnaire = Soumissionnaire::where('fret_id', $fret->id)
                                            ->where('statut', 'retenu')
                                            ->first();

            if ($soumissionnaire) {
                // Récupérer le numéro de téléphone du transporteur
                $numeroTelTransport = $soumissionnaire->numero_tel_transport;

                // Chercher le transporteur correspondant dans la table users
                $transporteur = User::where('numero_tel', $numeroTelTransport)->first();

                // Récupérer le numéro de téléphone du transporteur
                $numeroTelChauffeur = $soumissionnaire->numero_tel_chauffeur;

                // Chercher le transporteur correspondant dans la table users
                $chauffeur = User::where('numero_tel', $numeroTelChauffeur)->first();

                // Récupérer également le numéro de téléphone du fret
                $numeroTelFret = $fret->numero_tel;

                // Chercher l'utilisateur correspondant dans la table users (propriétaire du fret)
                $chargeur = User::where('numero_tel', $numeroTelFret)->first();

                if ($transporteur && $chauffeur && $chargeur) {
                    // Ajouter le fret, le soumissionnaire et l'utilisateur dans le résultat
                    $resultat[] = [
                        'fret' => $fret,
                        'soumissionnaire' => $soumissionnaire,
                        'transporteur' => $transporteur,
                        'chauffeur' => $chauffeur,
                        'chargeur' => $chargeur
                    ];
                }
            }
        }

        return view('supper_admin.paiement', ['resultats' => $resultat]);// Retourner le tableau des frets avec leur soumissionnaire retenu
    }


    public function payer($id)
    {
        // Chercher le soumissionnaire par son ID
        $soumissionnaire = Soumissionnaire::find($id);

        if ($soumissionnaire) {
            // Mettre à jour le statut_paiement
            $soumissionnaire->statut_paiement = 'payé';

            // Enregistrer les modifications
            $soumissionnaire->save();

            // Retourner un message de succès
            return redirect()->back()->with('message', 'Le statut du paiement a été mis à jour avec succès.');
        }

        // Retourner un message d'erreur si le soumissionnaire n'est pas trouvé
        return redirect()->back()->with('error', 'Une erreur s est produite.');
    }



    public function password()
    {
        // Retourner la vue mot de passe oublié
        return view('supper_admin.connexion.password');
    }


    //==========================================================


    public function soumissionnaire(Request $request, $id)
    {
        // Récupérer les soumissionnairesrespondant à id spécifié
        $soumissionnaires = Soumissionnaire::where('fret_id', $id)->get();

        // Tableau pour stocker les résultats
        $resultats = [];

        // Pour chaque soumissionnaire
        foreach ($soumissionnaires as $soumissionnaire) {
            // Récupérer les informations liées
            $transportUser = User::where('numero_tel', $soumissionnaire->numero_tel_transport)->first();
            $chauffeurUser = User::where('numero_tel', $soumissionnaire->numero_tel_chauffeur)->first();
            $vehicule = Vehicule::find($soumissionnaire->vehicule_id);

            // Ajouter les informations aux résultats
            $resultats[] = [
                'soumissionnaire' => $soumissionnaire,
                'transportUser' => $transportUser,
                'chauffeurUser' => $chauffeurUser,
                'vehicule' => $vehicule
            ];
        }
        
        // Retourner une vue avec les soumissionnaires et les informations liées
        return view('supper_admin.gestion_demande.soumissionnaire', ['resultats' => $resultats]);
    }



    public function detail_demande(Request $request, $id)
    {
    // Récupérer le fret correspondant à l'ID spécifié
    $fret = Fret::find($id);

    // Vérifier si le fret existe
    if (!$fret) {
        return redirect()->back()->with('error', 'Fret non trouvé.');
    }

    // Récupérer les soumissionnaires dont fret_id est égal à l'ID récupéré et statut_soumission est égal à "Retenue"
    $soumissionnaires = Soumissionnaire::where('fret_id', $id)
                                        ->where('statut', 'Retenu')
                                        ->get();

    // Tableau pour stocker les résultats
    $resultatSoumi = [];

    // Pour chaque soumissionnaire
    foreach ($soumissionnaires as $soumissionnaire) {
        // Récupérer les informations liées
        $transportUser = User::where('numero_tel', $soumissionnaire->numero_tel_transport)->first();
        $chauffeurUser = User::where('numero_tel', $soumissionnaire->numero_tel_chauffeur)->first();
        $vehicule = Vehicule::find($soumissionnaire->vehicule_id);

        // Ajouter les informations aux résultats
        $resultatSoumi[] = [
            'soumissionnaire' => $soumissionnaire,
            'transportUser' => $transportUser,
            'chauffeurUser' => $chauffeurUser,
            'vehicule' => $vehicule,
        ];
    }

    // Récupérer l'utilisateur correspondant au fret
    $chargeur = User::where('numero_tel', $fret->numero_tel)->first();

    // Retourner la vue avec les données nécessaires
    return view('supper_admin.gestion_demande.detail_demande', [
        'fret' => $fret,
        'chargeur' => $chargeur,
        'resultatSoumi' => $resultatSoumi
    ]);
    }

    



    public function details_val_camion()
    {
        // Retourner la vue des camions à valider en attent
        return view('supper_admin.camions.details_val_camion');
    }



    // public function valider($id)
    // {
    //     // Chercher le soumissionnaire par ID
    //     $soumissionnaire = Soumissionnaire::find($id);

    //     if ($soumissionnaire) {
    //         // Récupérer l'ID de la demande
    //         $demande_id = $soumissionnaire->demande_id;

    //         // Mettre à jour le champ statut_demande et statut_soumission du soumissionnaire actuel
    //         $soumissionnaire->statut_demande = 'En cours';
    //         $soumissionnaire->statut_soumission = 'Retenue';
    //         $soumissionnaire->save();

    //         // Mettre à jour le statut_soumission de tous les autres soumissionnaires ayant le même demande_id
    //         Soumissionnaire::where('demande_id', $demande_id)
    //             ->where('id', '!=', $id)
    //             ->update(['statut_soumission' => 'Rejeté']);

    //         return redirect()->back()->with('message', 'Le statut de la demande a été mis à jour avec succès.');
    //     } else {
    //         return redirect()->back()->with('error', 'Soumissionnaire non trouvé.');
    //     }
    // }






    public function essai()
    {
        // Retourner la vue du chargeur
        return view('essai');
    }




}
