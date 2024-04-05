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

    public function login(Request $request) {
        
    
        $phoneNumber = $request->input('phone_number'); 
 
        $user = User::where('numero_tel', $phoneNumber)->first(); 
 
        if ($user) { 
            return response()->json(['message' => 'Utilisateur trouvé', 'token' => $user->token], 201); 
        } else { 
            return response()->json(['message' => 'Utilisateur non trouvé'], 404); 
        } 
    
    }
    

    public function who(Request $request) {
        return response()->json([Auth::user()]);
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
