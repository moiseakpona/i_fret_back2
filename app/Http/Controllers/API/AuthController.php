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



use Illuminate\Support\Facades\Log; // Importez la classe Log

class AuthController extends Controller
 /**
     * Récupère les détails d'un fret spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */

{
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
                'vehicule_id' => 'required|exists:vehicules,id',
                'numero_tel_chauffeur' => 'required|string|max:20|exists:users,numero_tel',
                'demande_id' => 'required|exists:demandes,id',
                'statut_soumission' => 'nullable|string',
                'statut_demande' => 'nullable|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
    
            try {
                // Création du soumissionnaire
                $soumissionnaire = Soumissionnaire::create($request->all());
        
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
            $soumissionnaires = Soumissionnaire::with(['vehicule', 'chauffeur', 'demande'])->get();

            // Transformer les données pour inclure toutes les informations disponibles
            $voyages = $soumissionnaires->map(function ($soumissionnaire) {
                return [
                    'id' => $soumissionnaire->id,
                    'localisation' => $soumissionnaire->localisation,
                    'numero_tel_transport' => $soumissionnaire->numero_tel_transport,
                    'vehicule_id' => $soumissionnaire->vehicule_id,
                    'vehicule_matricule' => $soumissionnaire->vehicule->matricule ?? 'N/A',
                    'numero_tel_chauffeur' => $soumissionnaire->numero_tel_chauffeur,
                    'chauffeur_nom' => $soumissionnaire->chauffeur->nom ?? 'N/A',
                    'chauffeur_prenom' => $soumissionnaire->chauffeur->prenom ?? 'N/A',
                    'demande_id' => $soumissionnaire->demande_id,
                    'demande_details' => $soumissionnaire->demande ? $soumissionnaire->demande->toArray() : [],
                    'statut_soumission' => $soumissionnaire->statut_soumission,
                    'statut_demande' => $soumissionnaire->statut_demande,
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
public function getVoyageDetails($demandeId)
{
    try {
        // Rechercher le soumissionnaire par demandeId
        $soumissionnaire = Soumissionnaire::with(['vehicule', 'chauffeur', 'demande'])
            ->where('demande_id', $demandeId)
            ->firstOrFail();

             // Récupérer la description du fret lié à la demande
        $fret = Fret::where('id_demande', $demandeId)->first();


        // Transformer les données pour inclure toutes les informations nécessaires
        $voyageDetails = [
            'id' => $soumissionnaire->id,
            'localisation' => $soumissionnaire->localisation,
            'numero_tel_transport' => $soumissionnaire->numero_tel_transport,
            'vehicule_id' => $soumissionnaire->vehicule_id,
            'vehicule_matricule' => $soumissionnaire->vehicule->matricule ?? 'N/A',
            'numero_tel_chauffeur' => $soumissionnaire->numero_tel_chauffeur,
            'chauffeur_nom' => $soumissionnaire->chauffeur->nom ?? 'N/A',
            'chauffeur_prenom' => $soumissionnaire->chauffeur->prenom ?? 'N/A',
            'demande_id' => $soumissionnaire->demande_id,
            'demande_details' => $soumissionnaire->demande ? $soumissionnaire->demande->toArray() : [],
            'statut_soumission' => $soumissionnaire->statut_soumission,
            'statut_demande' => $soumissionnaire->statut_demande,
            'date_creation' => $soumissionnaire->created_at->format('Y-m-d H:i:s'),
            'description_fret' => $fret ? $fret->description : 'N/A', // Ajoutez la description du fret

            // Ajoutez d'autres informations si nécessaire
        ];

        return response()->json($voyageDetails, 200);
    } catch (Exception $e) {
        return response()->json(['error' => 'Erreur lors de la récupération des détails du voyage.'], 500);
    }
}

public function getFretDetails($fretId)
{
    try {
        // Trouver le fret par son ID avec les relations associées
        $fret = Fret::where('id', $fretId)
            ->with(['demande', 'user']) // Inclure les relations nécessaires
            ->firstOrFail();

        // Assurez-vous que la table users a une colonne `type_compte` pour vérifier le type de compte
        $chauffeur = User::where('numero_tel', $fret->numero_tel) // Assumant que numero_tel fait référence au chauffeur
                          ->where('type_compte', 'chauffeur') // Filtrer par type de compte
                          ->first();

        // Transformer les données pour inclure toutes les informations nécessaires
        $fretDetails = [
            'id' => $fret->id,
            'lieu_depart' => $fret->lieu_depart,
            'lieu_arrive' => $fret->lieu_arrive,
            'montant' => $fret->montant,
            'description' => $fret->description,
            'numero_tel' => $fret->numero_tel,
            'id_demande' => $fret->id_demande,
            'statut' => $fret->statut,
            'created_at' => $fret->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $fret->updated_at->format('Y-m-d H:i:s'),
            // Ajouter les détails du chauffeur
            'chauffeur' => [
                'nom' => $chauffeur ? $chauffeur->nom : 'N/A',
                'prenom' => $chauffeur ? $chauffeur->prenom : 'N/A',
                'numero_tel' => $chauffeur ? $chauffeur->numero_tel : 'N/A',
            ],
            // Ajoutez d'autres informations si nécessaire
        ];

        return response()->json($fretDetails, 200);
    } catch (\Exception $e) {
        // En cas d'erreur, enregistrer les détails de l'erreur
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
    $camions = Enregistrement::where('numero_tel', $numeroTel)
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
    $camion = Enregistrement::where('numero_tel', $numeroTel)
        ->where('matricule', $matricule)
        ->first();

    // Si le camion n'est pas trouvé
    if (!$camion) {
        return response()->json([
            'message' => 'Camion non trouvé ou accès non autorisé.',
        ], 404);
    }

    return response()->json(['data' => $camion], 201);
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

    public function descripNotif($id)
    {
        // Vérifier si l'utilisateur est authentifié
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401); // 401 = Non autorisé
        }
    
        try {
            // Récupérer le fret correspondant à l'ID avec les informations de la demande
            $fret = Fret::with('demande')->findOrFail($id);
    
            // Retourner les détails du fret en réponse JSON avec le type de véhicule
            return response()->json([
                'message' => 'Détails du fret récupérés avec succès',
                'data' => [
                    'id' => $fret->id,
                    'lieu_depart' => $fret->lieu_depart,
                    'lieu_arrive' => $fret->lieu_arrive,
                    'montant' => $fret->montant,
                    'description' => $fret->description,
                    'numero_tel' => $fret->numero_tel,
                    'statut' => $fret->statut,
                    'type_vehicule' => $fret->demande ? $fret->demande->type_vehicule : null,
                    'created_at' => $fret->created_at,
                    'updated_at' => $fret->updated_at,
                ]
            ], 201); // 201 = OK
        } catch (\Exception $e) {
            return response()->json(['error' => 'Fret non trouvé'], 404);
        }
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
