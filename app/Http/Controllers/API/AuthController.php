<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Service\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

    public function EnregistrementCamion(Request $request)
    {
        // Valider les données envoyées par la requête
        $validatedData = $request->validate([
            'matricule' => 'required|string',
            'photo_camion' => 'required|image', // Exemple pour un fichier image
            'carte_grise' => 'required|image',
            'visite_technique' => 'required|image',
            'assurance' => 'required|image',
        ]);

        // Enregistrer les données dans la base de données
        $enregistrement = new Enregistrement();
        $enregistrement->matricule = $validatedData['matricule'];

        // Enregistrer les fichiers
        $enregistrement->photo_camion = $request->file('photo_camion')->EnregistrementCamion('photos');
        $enregistrement->carte_grise = $request->file('carte_grise')->EnregistrementCamion('documents');
        $enregistrement->visite_technique = $request->file('visite_technique')->EnregistrementCamion('documents');
        $enregistrement->assurance = $request->file('assurance')->EnregistrementCamion('documents');

        $enregistrement->save();

        return response()->json(['message' => 'Enregistrement réussi'], 201);
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
       ]);
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
        return response()->json(Auth::user());
    }

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
