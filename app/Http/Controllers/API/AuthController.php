<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Service\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register (Request $request) {

        $validator =  Validator::make($request->all(), [
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
        
        // $smsService = new SmsService();

        
        // $message = ' Code : '.$randomNumber;

        // $smsService->sendSms($request->numero_tel, $message);

        return response()->json([
            'message' => 'Utilisateur enregistré avec succès.',
            'token' => $user->createToken('auth_token')->plainTextToken,
        ], 201);
    }

    public function who(Request $request) {
        return response()->json([Auth::user()]);
    }
    public function verifyOtp(Request $request) {
        
    }
}
