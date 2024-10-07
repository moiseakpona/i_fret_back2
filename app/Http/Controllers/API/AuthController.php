<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Service\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Enregistrement; // Assurez-vous d'importer la classe Enregistrement ici
use App\Models\Message;
use App\Models\Envoyer;
use App\Models\Recevoir;
use App\Models\Fret; // Assurez-vous d'importer la classe Fret
use App\Models\Soumissionnaire;
use App\Models\Transaction;
use App\Models\Vehicule; // Import du modèle Vehicule




use Illuminate\Support\Facades\Log; // Importez la classe Log

class AuthController extends Controller
 /**
     * Récupère les détails d'un fret spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */

{
    public function createfret(Request $request)
    {
        // Valider les données reçues
        $request->validate([
            'description' => 'required|string',
            'lieu_depart' => 'required|string',
            'lieu_arrive' => 'required|string',
            'info_comp' => 'nullable|string',
            'type_camion' => 'required|string',
            'type_marchandise' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Valider l'image
        ]);
    
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
    
        // Traiter l'image si elle est fournie
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('fret_images', 'public'); // Stocker l'image dans un dossier public
        }
    
        // Créer le fret avec les données fournies et le numéro de téléphone de l'utilisateur
        $fret = new Fret([
            'description' => $request->input('description'),
            'lieu_depart' => $request->input('lieu_depart'),
            'lieu_arrive' => $request->input('lieu_arrive'),
            'info_comp' => $request->input('info_comp'),
            'type_camion' => $request->input('type_camion'),
            'type_marchandise' => $request->input('type_marchandise'),
            'numero_tel' => $user->numero_tel,
            'statut' => 'en attente',
            'statut_paiement' => 'Non payé',
            'image' => $imagePath, // Ajouter le chemin de l'image
        ]);
    
        // Sauvegarder le fret
        $fret->save();
    
        return response()->json([
            'message' => 'Fret initié avec succès',
            'fret' => $fret,
        ], 201);
    }
    
   // Controller Method
public function updateTransactionId($fretId, Request $request)
{
    // Valider la requête
    $validated = $request->validate([
        'kkiapay_transaction_id' => 'nullable|string|max:255', // Champ nullable
    ]);

    // Trouver le fret par ID
    $fret = Fret::find($fretId);

    if (!$fret) {
        return response()->json(['message' => 'Fret not found'], 404);
    }

    // Mettre à jour le champ kkiapay_transaction_id si présent
    if ($validated['kkiapay_transaction_id']) {
        $fret->kkiapay_transaction_id = $validated['kkiapay_transaction_id'];
    }

    // Mettre à jour le statut de paiement
    $fret->statut = 'En cours'; // Changer le statut à 'en cours'
    $fret->statut_paiement = 'payé'; // Assurez-vous que 'payé' est la valeur correcte pour votre application

    // Sauvegarder les changements dans la table 'fret'
    $fret->save();

    // Mettre à jour le statut dans la table 'soumissionnaire'
    $soumissionnaires = Soumissionnaire::where('fret_id', $fretId)
        ->where('statut', 'en attente')
        ->get();

    foreach ($soumissionnaires as $soumissionnaire) {
        $soumissionnaire->statut = 'retenu'; // Assurez-vous que 'retenu' est la valeur correcte pour votre application
        $soumissionnaire->statut_paiement = 'Non payé'; // Assurez-vous que 'non payé' est la valeur correcte par défaut
        $soumissionnaire->save();
    }

    return response()->json(['message' => 'Transaction ID and statuses updated successfully'], 200);
}

         // Mettre à jour le statut du paiement et l'ID de la transaction Kkiapay
     public function updateFretStatus(Request $request, $id)
     {
         // Valider les données reçues
         $request->validate([
             'kkiapay_transaction_id' => 'required|string',
             'statut_paiement' => 'required|string|in:Payé,Non payé',
         ]);
 
         // Trouver le fret par son ID
         $fret = Fret::findOrFail($id);
 
         // Mettre à jour les champs kkiapay_transaction_id et statut_paiement
         $fret->update([
             'kkiapay_transaction_id' => $request->input('kkiapay_transaction_id'),
             'statut_paiement' => $request->input('statut_paiement'),
         ]);
 
         return response()->json([
             'message' => 'Statut du fret mis à jour avec succès',
             'fret' => $fret,
         ], 200);
     }

    
    public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'ville' => 'required|string',
                'date_naissance' => 'required|string',
                'numero_tel' => 'required|string',
                'type_compte' => 'required|string',
                'photo' => 'nullable|string',
                'email' => 'nullable|email|unique:users,email',
                'password' => 'nullable|string|min:6',
            ]);
        
            // Vérifier si la validation a échoué
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
        
            $randomNumber = random_int(10000000, 99999999);
        
            // Création de l'utilisateur dans la base de données
            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'ville' => $request->ville,
                'date_naissance' => $request->date_naissance,
                'numero_tel' => $request->numero_tel,
                'type_compte' => $request->type_compte,
                'otp' => $randomNumber,
                'photo' => $request->photo,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : null,
            ]);
        
            // Sauvegarde du type_compte et du token dans un fichier JSON
            $userData = [
                'type_compte' => $user->type_compte,
                'token' => $user->token,
            ];
        
            // Chemin vers le fichier JSON
            $jsonFilePath = storage_path('app/user_data.json');
        
            // Vérifier si le fichier JSON existe
            if (file_exists($jsonFilePath)) {
                // Lire le contenu actuel du fichier JSON
                $currentData = json_decode(file_get_contents($jsonFilePath), true);
                // Ajouter les nouvelles données utilisateur
                $currentData[] = $userData;
                // Écrire les données mises à jour dans le fichier JSON
                file_put_contents($jsonFilePath, json_encode($currentData));
            } else {
                // Créer un nouveau fichier JSON avec les données utilisateur
                file_put_contents($jsonFilePath, json_encode([$userData]));
            }
        
            // Créer le jeton d'authentification
            $token = $user->createToken('auth_token')->plainTextToken;
        
            // Ajouter un log pour afficher le jeton d'authentification
            Log::info('Token created: ' . $token);
        
            return response()->json([
                'message' => 'Utilisateur enregistré avec succès.',
                'role' => $user->type_compte,
                'token' => $token,
            ], 201);
        }

         // Méthode pour récupérer tous les chauffeurs
        public function getChauffeurs()
        {
            // Récupérer tous les utilisateurs ayant type_compte = 'chauffeur'
            $chauffeurs = User::where('type_compte', 'chauffeur')->get();

            // Retourner la liste des chauffeurs
            return response()->json([
                'chauffeurs' => $chauffeurs,
            ], 201);
        }

        public function storeTransaction(Request $request)
    {
        $validatedData = $request->validate([
            'fretId' => 'required|exists:frets,id',
            'transactionId' => 'required|string',
            'montant_paye' => 'required|integer',
        ]);

        try {
            // Création de la transaction
            $transaction = new Transaction();
            $transaction->fret_id = $validatedData['fretId'];
            $transaction->kkiapay_transaction_id = $validatedData['transactionId'];
            $transaction->montant_paye = $validatedData['montant_paye'];
            $transaction->save();

            return response()->json(['message' => 'Transaction enregistrée avec succès.'], 201);
        } catch (\Exception $e) {
            // Gestion des erreurs
            \Log::error('Erreur lors de l\'enregistrement de la transaction: '.$e->getMessage());

            return response()->json(['message' => 'Erreur lors de l\'enregistrement de la transaction.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Retrieve transactions by fretId.
     */
    public function getTransactionsForFret($fretId)
    {
        try {
            $transactions = Transaction::where('fret_id', $fretId)->get();
            return response()->json($transactions, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la récupération des transactions.', 'error' => $e->getMessage()], 500);
        }
    }


    public function soumission(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'localisation' => 'required|string|max:255',
            'numero_tel_transport' => 'required|string|max:20|exists:users,numero_tel',
             'vehicule_id' => 'required|exists:vehicules,id',  // A changer
            'numero_tel_chauffeur' => 'required|string|max:20|exists:users,numero_tel',
            'fret_id' => 'required|exists:frets,id',
            'montant' => 'required|numeric', // Montant proposé par le transporteur
            'statut' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        try {
            // Création du soumissionnaire
            $soumissionnaire = Soumissionnaire::create($request->all());
    
         /*    // Mise à jour du montant dans la table fret
            $fret = Fret::find($request->fret_id);
            if ($fret) {
                $fret->montant = $request->montant; // Update montant
                $fret->save();
            } */
    
            // Retourner une réponse JSON avec les détails du soumissionnaire créé
            return response()->json(['soumissionnaire' => $soumissionnaire], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erreur lors de la soumission. Veuillez réessayer plus tard.'], 500);
        }
    }
             // Fonction pour récupérer tous les détails des soumissionnaires
         public function getVoyages(Request $request)
         {
             try {
                 // Récupérer tous les soumissionnaires avec les relations associées
                 $soumissionnaires = Soumissionnaire::with(['vehicule', 'chauffeur', 'fret'])->get();
         
                 // Transformer les données pour inclure toutes les informations disponibles
                 $voyages = $soumissionnaires->map(function ($soumissionnaire) {
                     return [
                         'id' => $soumissionnaire->id,
                         'localisation' => $soumissionnaire->localisation,
                         'numero_tel_transport' => $soumissionnaire->numero_tel_transport,
                         'vehicule_id' => $soumissionnaire->vehicule_id,
                         'type_vehicule' => $soumissionnaire->vehicule->type_vehicule ?? 'N/A',
                         'vehicule_matricule' => $soumissionnaire->vehicule->matricule ?? 'N/A',
                         'numero_tel_chauffeur' => $soumissionnaire->numero_tel_chauffeur,
                         'chauffeur_nom' => $soumissionnaire->chauffeur->nom ?? 'N/A',
                         'chauffeur_prenom' => $soumissionnaire->chauffeur->prenom ?? 'N/A',
                         'fret_id' => $soumissionnaire->fret_id, // Remplacer demande_id par fret_id
                         'fret_details' => $soumissionnaire->fret ? $soumissionnaire->fret->toArray() : [], // Remplacer demande_details par fret_details
                         'statut' => $soumissionnaire->statut, // Changer en 'statut' pour correspondre au modèle
                         'date_creation' => $soumissionnaire->created_at->format('Y-m-d H:i:s'),
                         // Ajoutez d'autres informations si nécessaire
                     ];
                 });

                 
         
                 return response()->json($voyages, 200);
             } catch (Exception $e) {
                 return response()->json(['error' => 'Erreur lors de la récupération des voyages.'], 500);
             }
         }

         
            
    // Dans AuthController.php// Dans AuthController.php// Fonction pour récupérer les détails d'un voyage par demandeId
    public function getVoyageDetails($fretId)
    {
        try {
            $soumissionnaire = Soumissionnaire::with(['vehicule', 'chauffeur', 'fret'])
                ->where('fret_id', $fretId)
                ->first();
                
            if (!$soumissionnaire) {
                // Handle the case where no soumissionnaire is found for the given fretId
                return response()->json(['error' => 'No soumissionnaire found for this fretId'], 404);
            }
    
            // Transform the data to include necessary info
            $voyageDetails = [
                'id' => $soumissionnaire->id,
                'localisation' => $soumissionnaire->localisation,
                'numero_tel_transport' => $soumissionnaire->numero_tel_transport,
                'vehicule_id' => $soumissionnaire->vehicule_id,
                'type_vehicule' => $soumissionnaire->vehicule->type_vehicule ?? 'N/A',
                'vehicule_matricule' => $soumissionnaire->vehicule->matricule ?? 'N/A',
                'numero_tel_chauffeur' => $soumissionnaire->numero_tel_chauffeur,
                'chauffeur_nom' => $soumissionnaire->chauffeur->nom ?? 'N/A',
                'chauffeur_prenom' => $soumissionnaire->chauffeur->prenom ?? 'N/A',
                'fret_id' => $soumissionnaire->fret_id,
                'fret_details' => $soumissionnaire->fret ? $soumissionnaire->fret->toArray() : [],
                'montant_propose' => $soumissionnaire->montant,
                'statut' => $soumissionnaire->statut,
                'date_creation' => $soumissionnaire->created_at->format('Y-m-d H:i:s'),
            ];
    
            return response()->json($voyageDetails, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des détails du voyage.'], 500);
        }
    }

    public function updateFeedbackAndStatut(Request $request, $fretId)
    {
        // Valider les données envoyées
        $validated = $request->validate([
            'feedback' => 'required|string', // Le feedback doit être une chaîne
        ]);

        // Trouver le fret par son ID
        $fret = Fret::findOrFail($fretId);

        // Mettre à jour le feedback et le statut
        $fret->feedback = $validated['feedback'];
        $fret->statut = 'Finalisé';

        // Sauvegarder les modifications dans la base de données
        $fret->save();

        return response()->json([
            'message' => 'Feedback et statut mis à jour avec succès.',
            'fret' => $fret
        ]);
    }


    public function getFretDetails($fretId)
    {
        try {
            $fret = Fret::where('id', $fretId)
                ->with(['user']) // Inclure la relation utilisateur
                ->firstOrFail();
    
            $chauffeur = User::where('numero_tel', $fret->numero_tel)
                ->where('type_compte', 'chauffeur')
                ->first();
    
            // Construire l'URL complète de l'image (si elle existe)
            $imageUrl = null;
            if ($fret->image) {
                // Inclure le dossier fret_images explicitement
                $imageUrl = asset('storage/fret_images/' . basename($fret->image));  
            }
    
            $fretDetails = [
                'id' => $fret->id,
                'lieu_depart' => $fret->lieu_depart,
                'lieu_arrive' => $fret->lieu_arrive,
                'montant' => $fret->montant,
                'description' => $fret->description,
                'info_comp'  => $fret->info_comp,
                'type_camion'  => $fret->type_camion,
                'type_marchandise'  => $fret->type_marchandise,
                'numero_tel' => $fret->numero_tel,
                'statut' => $fret->statut,
                'created_at' => $fret->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $fret->updated_at->format('Y-m-d H:i:s'),
                'chauffeur' => [
                    'nom' => $chauffeur ? $chauffeur->nom : 'N/A',
                    'prenom' => $chauffeur ? $chauffeur->prenom : 'N/A',
                    'numero_tel' => $chauffeur ? $chauffeur->numero_tel : 'N/A',
                ],
                'image_url' => $imageUrl, // Ajouter l'URL de l'image ici
            ];
    
            return response()->json($fretDetails, 200);
        } catch (\Exception $e) {
            \Log::error('Error fetching fret details', [
                'fret_id' => $fretId,
                'error' => $e->getMessage()
            ]);
    
            return response()->json(['error' => 'Erreur lors de la récupération des détails du fret.'], 500);
        }
    }
    

    

    public function enregistrerCamion(Request $request)
        {
                // Verify user authentication
                if (!Auth::check()) {
                    return response()->json([
                        'message' => 'Accès non autorisé. Veuillez vous connecter d\'abord.',
                    ], 401);
                }

                // Récupérer le numéro de téléphone de l'utilisateur connecté
                $user = Auth::user();
                $numeroTel = $user->numero_tel;

                // Valider les données entrantes
                $validatedData = $request->validate([
                    'matricule' => 'required|string|unique:vehicules,matricule',
                    'type_vehicule' => 'required|string', // New field validation
                    'photo_camion' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,application/pdf|max:2048',
                    'carte_grise' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,application/pdf|max:2048',
                    'visite_technique' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,application/pdf|max:2048',
                    'assurance' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,application/pdf|max:2048',

            ]);


            try {
                // Enregistrement des données dans la base de données
                $enregistrement = new Enregistrement();
                $enregistrement->matricule = $validatedData['matricule'];
                $enregistrement->numero_tel = $numeroTel;
                $enregistrement->type_vehicule = $validatedData['type_vehicule']; // Save new field
                $enregistrement->statut = 'En attent';

                // Stocker les fichiers téléchargés localement
                $photoCamion = $request->file('photo_camion');
                $carteGrise = $request->file('carte_grise');
                $visiteTechnique = $request->file('visite_technique');
                $assurance = $request->file('assurance');

                // Utiliser le nom original des fichiers lors du stockage
                $photoPath = $photoCamion->storeAs('public/images', $photoCamion->getClientOriginalName());
                $carteGrisePath = $carteGrise->storeAs('public/images', $carteGrise->getClientOriginalName());
                $visiteTechniquePath = $visiteTechnique->storeAs('public/images', $visiteTechnique->getClientOriginalName());
                $assurancePath = $assurance->storeAs('public/images', $assurance->getClientOriginalName());

                // Mettre à jour les chemins complets dans l'objet Enregistrement
                $enregistrement->photo_camion = str_replace('public/', '', $photoPath);
                $enregistrement->carte_grise = str_replace('public/', '', $carteGrisePath);
                $enregistrement->visite_technique = str_replace('public/', '', $visiteTechniquePath);
                $enregistrement->assurance = str_replace('public/', '', $assurancePath);

                $enregistrement->save();

                return response()->json(['message' => 'Enregistrement réussi', 'data' => $enregistrement], 201);
            }  catch (\Exception $e) {
                Log::error('Erreur lors de l\'enregistrement du camion: ' . $e->getMessage());
                return response()->json(['message' => 'Erreur lors de l\'enregistrement du camion'], 500);
            }
        }


public function mettreAJourCamion(Request $request, $matricule)
{
    // Verify user authentication
    if (!Auth::check()) {
        return response()->json([
            'message' => 'Accès non autorisé. Veuillez vous connecter d\'abord.',
        ], 401);
    }

    // Récupérer le numéro de téléphone de l'utilisateur connecté
    $user = Auth::user();
    $numeroTel = $user->numero_tel;

    // Valider les données entrantes
    $validatedData = $request->validate([
        'matricule' => 'required|string|unique:vehicules,matricule,' . $matricule . ',matricule',
        'type_vehicule' => 'required|string', // New field validation
        'photo_camion' => 'nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,application/pdf|max:2048',
        'carte_grise' => 'nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,application/pdf|max:2048',
        'visite_technique' => 'nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,application/pdf|max:2048',
        'assurance' => 'nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,application/pdf|max:2048',
    ]);

    try {
        // Trouver l'enregistrement existant par matricule
        $enregistrement = Enregistrement::where('matricule', $matricule)->firstOrFail();

        // Mettre à jour le matricule et d'autres champs si nécessaire
        $enregistrement->matricule = $validatedData['matricule'];
        $enregistrement->type_vehicule = $validatedData['type_vehicule']; // Update new field

        // Gérer les mises à jour des fichiers
        if ($request->hasFile('photo_camion')) {
            // Supprimer l'ancienne image si elle existe
            if ($enregistrement->photo_camion && Storage::exists('public/' . $enregistrement->photo_camion)) {
                Storage::delete('public/' . $enregistrement->photo_camion);
            }
            // Enregistrer la nouvelle image
            $photoCamion = $request->file('photo_camion');
            $photoPath = $photoCamion->storeAs('public/images', $photoCamion->getClientOriginalName());
            $enregistrement->photo_camion = str_replace('public/', '', $photoPath);
        }

        if ($request->hasFile('carte_grise')) {
            if ($enregistrement->carte_grise && Storage::exists('public/' . $enregistrement->carte_grise)) {
                Storage::delete('public/' . $enregistrement->carte_grise);
            }
            $carteGrise = $request->file('carte_grise');
            $carteGrisePath = $carteGrise->storeAs('public/images', $carteGrise->getClientOriginalName());
            $enregistrement->carte_grise = str_replace('public/', '', $carteGrisePath);
        }

        if ($request->hasFile('visite_technique')) {
            if ($enregistrement->visite_technique && Storage::exists('public/' . $enregistrement->visite_technique)) {
                Storage::delete('public/' . $enregistrement->visite_technique);
            }
            $visiteTechnique = $request->file('visite_technique');
            $visiteTechniquePath = $visiteTechnique->storeAs('public/images', $visiteTechnique->getClientOriginalName());
            $enregistrement->visite_technique = str_replace('public/', '', $visiteTechniquePath);
        }

        if ($request->hasFile('assurance')) {
            if ($enregistrement->assurance && Storage::exists('public/' . $enregistrement->assurance)) {
                Storage::delete('public/' . $enregistrement->assurance);
            }
            $assurance = $request->file('assurance');
            $assurancePath = $assurance->storeAs('public/images', $assurance->getClientOriginalName());
            $enregistrement->assurance = str_replace('public/', '', $assurancePath);
        }

        $enregistrement->save();

        return response()->json(['message' => 'Camion mis à jour avec succès', 'data' => $enregistrement], 201);
    } catch (\Exception $e) {
        Log::error('Erreur lors de la mise à jour du camion: ' . $e->getMessage());
        return response()->json(['message' => 'Erreur lors de la mise à jour du camion'], 500);
    }
}


public function getUserCamions(Request $request)
{
    // Vérifiez si l'utilisateur est authentifié
    if (!Auth::check()) {
        return response()->json([
            'message' => 'Accès non autorisé. Veuillez vous connecter d\'abord.',
        ], 401);
    }

    // Récupérez le numéro de téléphone de l'utilisateur connecté
    $user = Auth::user();
    $numeroTel = $user->numero_tel;

    // Récupérez les camions associés à l'utilisateur
    $camions = Vehicule::where('numero_tel', $numeroTel)
        ->select('matricule', 'statut', 'created_at')
        ->get();

    return response()->json(['data' => $camions], 201);
}

public function getCamionDetails(Request $request, $matricule)
{
    // Vérifiez si l'utilisateur est authentifié
    if (!Auth::check()) {
        return response()->json([
            'message' => 'Accès non autorisé. Veuillez vous connecter d\'abord.',
        ], 401);
    }

    // Récupérez le numéro de téléphone de l'utilisateur connecté
    $user = Auth::user();
    $numeroTel = $user->numero_tel;

    // Récupérez les détails du camion associé à l'utilisateur et au matricule
    $camion = Vehicule::where('numero_tel', $numeroTel)
        ->where('matricule', $matricule)
        ->where('statut', 'Validé') // Assurez-vous que le camion a le statut 'Validé'
        ->first();

    // Si le camion n'est pas trouvé
    if (!$camion) {
        return response()->json([
            'message' => 'Camion non trouvé ou accès non autorisé.',
        ], 404);
    }

    // Retournez les détails du camion avec le code de statut 200
    return response()->json(['data' => $camion], 200);
}
public function getValidatedCamionsByTransporteur()
{
    // Récupérer l'utilisateur authentifié
    $user = Auth::user();

    // Vérifiez si l'utilisateur a le rôle de transporteur
    if ($user->type_compte !== 'Transporteur') {
        return response()->json(['error' => 'Non autorisé'], 403);
    }

    // Récupérer les camions validés en fonction du numéro de téléphone du transporteur
    $camions = Vehicule::where('numero_tel', $user->numero_tel)
                    ->where('statut', 'Validé')
                    ->get();

    // Renvoi des données formatées avec une clé 'data' ou 'camions'
    return response()->json([
        'message' => 'Camions validés récupérés avec succès',
        'data' => $camions // Les données sont retournées sous une clé 'data'
    ]);
}



    public function login(Request $request) {
        
    
        $phoneNumber = $request->input('phone_number'); 
 
        $user = User::where('numero_tel', $phoneNumber)->first(); 
 
        if ($user) { 
            return response()->json(['message' => 'Utilisateur trouvé', 'token' => $user->token], 201); 
        } else { 
            return response()->json(['message' => 'Utilisateur non trouvé'], 404); 
        } 
    
    }
    
    public function edit(Request $request) {
        try {
            // Récupérer toutes les données envoyées dans la requête
            $input = $request->all();
    
            // Définir les règles de validation pour les champs attendus
            $validator = Validator::make($input, [
                'nom' => 'string',
                'prenom' => 'string',
                'ville' => 'string',
                'date_naissance' => 'string', 
                'numero_tel' => 'string',
                'type_compte' => 'string',
                'photo' => 'nullable|string',
            ]);
    
            // Vérifier si la validation échoue
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Erreur de Validation",
                    "errors" => $validator->errors(),
                ], 422);
            }
    
            // Mettre à jour les informations de l'utilisateur authentifié
            $request->user()->update($input);
    
            return response()->json([
                "status" => true,
                "message" => "Utilisateur modifié avec succès.",
                "data" => $request->user(),
            ]);
        } catch (\Throwable $th) {
            // Capturer les exceptions et retourner une réponse JSON appropriée
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ], 500);
        }
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ]);
    
        try {
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time().'.'.$image->getClientOriginalExtension(); // Génération d'un nom de fichier unique
                $image->move(public_path('images'), $imageName); // Déplacement de l'image vers le répertoire de destination
    
                // Enregistrement du chemin de l'image en base de données
                $user = new User();
                $user->photo = '/images/'.$imageName; // Chemin relatif vers l'image
                $user->save();
    
                return response()->json(['success' => 'Image téléchargée avec succès et enregistrée en base de données.']);
            } else {
                return response()->json(['error' => 'Aucune image n\'a été téléchargée.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur s\'est produite lors du téléchargement de l\'image.'], 500);
        }
    }
    

    public function getUserDetails()
    {
        // Récupérer l'utilisateur actuellement authentifié ou tout autre utilisateur dont vous avez besoin les détails
        $user = auth()->user();
    
        // Vérifier si l'utilisateur existe
        if ($user) {
            // Retourner les détails de l'utilisateur
            return response()->json([
                'prenom' => $user->firstName,
                'nom' => $user->lastName,
                'numero_tel' => $user->phoneNumber,
                'date_naissance' => $user->dateOfBirth,
                'ville' => $user->residence,
                'type_compte' => $user->accountType,
            ]);
        } else {
            // Retourner une réponse indiquant que l'utilisateur n'est pas trouvé
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
    }
    
    public function who(Request $request) {
        return response()->json(Auth::user(), 201);
    }
    

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'statut' => 'nullable|string',
        ]);

        $user = Auth::user();


        $envoyer = Envoyer::create([
            'message' => $request->message,
            'statut' => $request->statut,
            'numero_tel' => $user->numero_tel,
        ]);

        return response()->json(['message' => 'Message envoyé avec succès', 'data' => $envoyer], 201);
    }

   


    public function receiveMe(Request $request)
    {
        try {
            // Récupérer l'utilisateur actuellement authentifié
            $user = auth()->user();
    
            // Vérifier si l'utilisateur est trouvé
            if ($user) {
                // Récupérer les messages envoyés par cet utilisateur
                $sentMessages = Envoyer::where('numero_tel', $user->numero_tel)
                    ->orderBy('created_at', 'asc')
                    ->get()
                    ->map(function ($message) {
                        $message->type = 'sent';
                        return $message;
                    });
    
                // Récupérer les messages reçus par cet utilisateur (qui sont de l'admin)
                $receivedMessages = Recevoir::where('numero_tel', $user->numero_tel)
                    ->orderBy('created_at', 'asc')
                    ->get()
                    ->map(function ($message) {
                        $message->type = 'admin';
                        return $message;
                    });
    
                // Fusionner les deux collections et les convertir en tableau
                $messages = $sentMessages->merge($receivedMessages)->sortBy('created_at')->values()->all();
    
                // Retourner les messages envoyés par l'utilisateur sous forme de réponse JSON
                return response()->json(['messages' => $messages], 201);
            } else {
                // Retourner une réponse indiquant que l'utilisateur n'est pas trouvé
                return response()->json(['error' => 'Utilisateur non trouvé'], 404);
            }
        } catch (\Exception $e) {
            // Gérer les erreurs d'exception
            return response()->json(['error' => 'Échec de la récupération des messages'], 500);
        }
    }
    
   
    public function notif(Request $request)
    {
        // Vérifier si l'utilisateur est authentifié
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401); // 401 = Non autorisé
        }

        // Récupérer tous les frets disponibles
        $frets = Fret::all();

        // Retourner les frets en réponse JSON
        return response()->json([
            'message' => 'Frets récupérés avec succès',
            'data' => $frets
        ], 201); // 201 = OK
    }

    public function descripNotif($fretId)
    {
        // Vérifier si l'utilisateur est authentifié
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401); // 401 = Non autorisé
        }
    
        try {
            // Récupérer le fret correspondant à l'ID avec les informations du chauffeur
            $fret = Fret::where('id', $fretId)
                ->with(['Chauffeur' => function($query) {
                    // Filtrer les chauffeurs par type_compte
                    $query->where('type_compte', 'Chauffeur');
                }])
                ->firstOrFail();
    
            // Construire l'URL complète de l'image (si elle existe)
            $imageUrl = null;
            if ($fret->image) {
                // Inclure le dossier fret_images explicitement
                $imageUrl = asset('storage/fret_images/' . basename($fret->image));
            }
    
            // Retourner les détails du fret en réponse JSON avec le type de véhicule et l'image
            return response()->json([
                'message' => 'Détails du fret récupérés avec succès',
                'data' => [
                    'id' => $fret->id,
                    'lieu_depart' => $fret->lieu_depart,
                    'lieu_arrive' => $fret->lieu_arrive,
                    'montant' => $fret->montant,
                    'description' => $fret->description,
                    'info_comp'  => $fret->info_comp,
                    'type_camion'  => $fret->type_camion,
                    'type_marchandise'  => $fret->type_marchandise,
                    'numero_tel' => $fret->numero_tel,
                    'statut' => $fret->statut,
                    'created_at' => $fret->created_at,
                    'updated_at' => $fret->updated_at,
                    'image_url' => $imageUrl, // Ajouter l'URL de l'image ici
                ]
            ], 201); // 201 = OK
        } catch (\Exception $e) {
            return response()->json(['error' => 'Fret non trouvé'], 404);
        }
    }
    

    public function getSoumissionsForFret($fretId)
    {
        // Récupérer toutes les soumissions pour un fret spécifique
        $soumissions = Soumissionnaire::with('fret', 'transporteur')
                            ->where('fret_id', $fretId)
                            ->get();

        // Vérifier s'il y a des soumissions
        if ($soumissions->isEmpty()) {
            return response()->json(['message' => 'Aucune soumission trouvée pour ce fret'], 404);
        }

        // Préparer les détails des soumissions
        $details = $soumissions->map(function ($soumission) {
            return [
                'description_fret' => $soumission->fret->description ?? 'N/A',
                'montant_propose' => $soumission->montant ?? 'N/A',
                'nom_transporteur' => $soumission->transporteur->nom ?? 'N/A',
                'prenom_transporteur' => $soumission->transporteur->prenom ?? 'N/A',
            ];
        });

        // Retourner les détails sous forme de JSON
        return response()->json($details);
    }

    public function getSoumissionsForConnectedUser()
{
    // Récupérer le numéro de téléphone de l'utilisateur connecté
    $numeroTel = auth()->user()->numero_tel; // Remplace cette ligne selon comment tu récupères le numéro de téléphone de l'utilisateur

    // Récupérer tous les frets initiés par l'utilisateur connecté
    $frets = Fret::where('numero_tel', $numeroTel)->get();

    // Récupérer toutes les soumissions pour les frets initiés par l'utilisateur
    $soumissions = Soumissionnaire::with('fret', 'transporteur') // Remplacer 'transporteur' par 'chargeur'
                        ->whereIn('fret_id', $frets->pluck('id'))
                        ->get();

    // Vérifier s'il y a des soumissions
    if ($soumissions->isEmpty()) {
        return response()->json(['message' => 'Aucune soumission trouvée pour cet utilisateur'], 404);
    }

    // Préparer les détails des soumissions
    $details = $soumissions->map(function ($soumission) {
        return [
            'fret_id' => $soumission->fret_id, // Ajouter l'ID du fret
            'description_fret' => $soumission->fret->description ?? 'N/A',
            'montant_propose' => $soumission->montant ?? 'N/A',
            'nom_transporteur' => $soumission->transporteur->nom ?? 'N/A',
            'prenom_transporteur' => $soumission->transporteur->prenom ?? 'N/A',
            'numero_tel_transporteur' => $soumission->transporteur->numero_tel ?? 'N/A', // Récupérer le numéro de téléphone du transporteur
            'date' => $soumission->fret->created_at->toDateTimeString(), // Récupère la date de création du fret
    
        ];
    });

    // Retourner les détails sous forme de JSON
    return response()->json($details);
}

// Dans votre contrôleur Laravel
// Dans votre contrôleur Laravel
public function checkTransporteurValide($fretId)
{
    // Récupérer les détails du fret spécifié
    $fret = Fret::find($fretId);

    if ($fret && $fret->montant > 0) {
        // Trouver la soumissionnaire associée au fret
        $soumission = Soumissionnaire::where('fret_id', $fretId)
                                    ->whereNotNull('montant')
                                    ->first();

        if ($soumission) {
            return response()->json([
                'nom' => $soumission->transporteur->nom,
                'prenom' => $soumission->transporteur->prenom,
                'montant_valide' => $fret->montant,
            ]);
        }
    }

    // Retourner null si le fret n'existe pas ou si le montant est nul
    return response()->json(null);
}


public function updateMontantFret(Request $request)
{
    // Validation des données entrantes
    $request->validate([
        'fret_id' => 'required|exists:frets,id',
        'montant' => 'required|string', // Accepter le montant sous forme de chaîne de caractères
    ]);

    // Convertir le montant en nombre avant de le sauvegarder
    $montant = (float) str_replace(' ', '', $request->montant); // Conversion en nombre (float) en supprimant les espaces

    // Mise à jour du montant dans la table fret
    $fret = Fret::find($request->fret_id);
    if ($fret) {
        $fret->montant = $montant; // Mise à jour du montant après conversion
        $fret->save();
        
        return response()->json(['message' => 'Montant mis à jour avec succès'], 200);
    }

    return response()->json(['message' => 'Fret non trouvé'], 404);
}



    


  /*   public function receiveAdmin(Request $request)
    {
        try {
            // Récupérer l'utilisateur actuellement authentifié
            $user = auth()->user();

            // Vérifier si l'utilisateur est trouvé
            if ($user) {

             

                // Retourner les messages sous forme de réponse JSON
                return response()->json(['receivedMessages' => [$receivedMessages]], 201);
            } else {
                // Retourner une réponse indiquant que l'utilisateur n'est pas trouvé
                return response()->json(['error' => 'Utilisateur non trouvé'], 404);
            }
        } catch (\Exception $e) {
            // Gérer les erreurs d'exception
            return response()->json(['error' => 'Échec de la récupération des messages'], 500);
        }
    }

 */
    public function checkPhoneNumber(Request $request)
    {
        // Récupérer le numéro de téléphone depuis la requête
        $phoneNumber = $request->input('phone_number');
    
        // Vérifier si le numéro existe dans la base de données
        $user = User::where('numero_tel', $phoneNumber)->first();
    
        // Retourner une réponse appropriée en fonction du résultat
        if ($user) {
            // Le numéro existe dans la base de données
            // Générer un nouveau jeton d'authentification
            $token = $user->createToken('auth_token')->plainTextToken;
        
            // Ajouter un log pour afficher le jeton d'authentification
            Log::info('Token created: ' . $token);
    
            return response()->json([
                'exists' => true,
                'type_compte' => $user->type_compte,
                'token' => $token,
            ], 201);
        } else {
            // Le numéro n'existe pas dans la base de données
            return response()->json(['exists' => false], 404);
        }
    }
    
}
