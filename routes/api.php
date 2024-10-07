    <?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/who',[AuthController::class,'who']);
    Route::post('/payment/init', [AuthController::class, 'processPayment']);
    Route::post('/initfrets', [AuthController::class, 'createfret']);
    Route::get('/camions',[AuthController::class,'getUserCamions']);
    Route::get('/camions/validated', [AuthController::class, 'getValidatedCamionsByTransporteur']);

    Route::get('/camions/{matricule}', [AuthController::class, 'getCamionDetails']);
    Route::put('/updateCamion/{matricule}',  [AuthController::class, 'mettreAJourCamion']);
    Route::put('/edit-profil',  [AuthController::class, 'edit']);
    Route::put('/photoImport',  [AuthController::class, 'store']);
    Route::get('/getUser',  [AuthController::class, 'getUserDetails']);
    Route::post('/enregistrementCamion', [AuthController::class,'enregistrerCamion']);
    Route::get('/frets', [AuthController::class, 'notif']);
    Route::get('/frets/{id}', [AuthController::class, 'descripNotif']);
    Route::get('/soumissions', [AuthController::class, 'getSoumissionsForConnectedUser']);
    Route::get('/check/{fretId}', [AuthController::class, 'checkTransporteurValide']);
    Route::post('/frets/{id}/update-status', [AuthController::class, 'updateFretStatus']);
    Route::post('/update-fret-transaction-id/{fretId}', [AuthController::class, 'updateTransactionId']);
    Route::get('/frets/soumissions/{id}', [AuthController::class, 'getSoumissionsForFret']);
    Route::get('/frets/{fretId}', [AuthController::class, 'getFretDetails']);
    Route::post('/frets/{fretId}/update-feedback-statut', [AuthController::class, 'updateFeedbackAndStatut']);
    Route::get('/voyages', [AuthController::class, 'getVoyages']);
    Route::get('/voyages/{fretId}', [AuthController::class, 'getVoyageDetails']);
    Route::post('/send', [AuthController::class, 'send']);
    Route::post('/soumissionnaires', [AuthController::class, 'soumission']);
    Route::post('/updatemontantfret', [AuthController::class, 'updateMontantFret']);
    
    Route::get('/chauffeurs', [AuthController::class, 'getChauffeurs']);
    Route::get('/receive', [AuthController::class, 'receiveMe']);
    Route::post('/store-transaction', [AuthController::class, 'storeTransaction']);
    Route::get('/frets/{fretId}/transactions', [AuthController::class, 'getTransactionsForFret']);
  
   
   

   
});

Route::post('/register', [AuthController::class,'register']);

Route::post('/login', [AuthController::class,'login']);
Route::post('/checkPhoneNumber', [AuthController::class, 'checkPhoneNumber']);
Route::post('/savetoken',  [AuthController::class, 'saveToken']);


Route::post('/verifyotp', [AuthController::class,'verifyOtp']);
