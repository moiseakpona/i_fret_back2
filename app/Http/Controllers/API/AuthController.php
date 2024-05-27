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


use Illuminate\Support\Facades\Log; // Importez la classe Log

class AuthController extends Controller
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
            if ($enregistrement->photo_camion) {
                Storage::delete('public/' . $enregistrement->photo_camion);
            }
            // Enregistrer la nouvelle image
            $photoCamion = $request->file('photo_camion');
            $photoPath = $photoCamion->storeAs('public/images', $photoCamion->getClientOriginalName());
            $enregistrement->photo_camion = str_replace('public/', '', $photoPath);
        }

        if ($request->hasFile('carte_grise')) {
            if ($enregistrement->carte_grise) {
                Storage::delete('public/' . $enregistrement->carte_grise);
            }
            $carteGrise = $request->file('carte_grise');
            $carteGrisePath = $carteGrise->storeAs('public/images', $carteGrise->getClientOriginalName());
            $enregistrement->carte_grise = str_replace('public/', '', $carteGrisePath);
        }

        if ($request->hasFile('visite_technique')) {
            if ($enregistrement->visite_technique) {
                Storage::delete('public/' . $enregistrement->visite_technique);
            }
            $visiteTechnique = $request->file('visite_technique');
            $visiteTechniquePath = $visiteTechnique->storeAs('public/images', $visiteTechnique->getClientOriginalName());
            $enregistrement->visite_technique = str_replace('public/', '', $visiteTechniquePath);
        }

        if ($request->hasFile('assurance')) {
            if ($enregistrement->assurance) {
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
        //code...
       $input = $request->all();
       $validator = Validator::make($input, [
        'nom' => 'string',
        'prenom' => 'string',
        'ville' => 'string',
        'date_naissance' => 'string',
        'numero_tel' => 'string',
        'type_compte' => 'string', 
        'photo' => 'nullable|string',
       ], 201);
       if ($validator->fails()) {
        # code...
        return response()->json([
            "status"=>false,
            "message"=>"Erreur de Validation",
            "errors"=> $validator->errors(),  
        ], 422);

       }
       $request->user()->update($input);
       return response()->json([
        "status"=>true,
        "message"=>"Utilisateur Modifier avec succès.",
        "errors"=> $request->user(),  
       ]);
       } catch (\Throwable $th) {
        //throw $th;
        return response()->json([
            "status"=>false,
            "message"=>$th->getMessage(),
      
        ], 500,);
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
                    ->get();

                // Récupérer les messages reçus par cet utilisateur
                $receivedMessages = Recevoir::where('numero_tel', $user->numero_tel)
                    ->orderBy('created_at', 'asc')
                    ->get();

              // Fusionner les deux collections et les convertir en tableau
            $messages = $sentMessages->merge($receivedMessages)->sortBy('created_at')->values()->all();

    
                // Retourner les messages envoyés par l'utilisateur sous forme de réponse JSON
                return response()->json(['messages' => [$messages]], 201);
            } else {
                // Retourner une réponse indiquant que l'utilisateur n'est pas trouvé
                return response()->json(['error' => 'Utilisateur non trouvé'], 404);
            }
        } catch (\Exception $e) {
            // Gérer les erreurs d'exception
            return response()->json(['error' => 'Échec de la récupération des messages'], 500);
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
