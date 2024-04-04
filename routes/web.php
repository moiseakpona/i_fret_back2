<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\ProfilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route pour afficher la page de connexion
Route::get('/supper_admin/connexion', [AuthAdminController::class, 'pageConnexion'])->name('connexion');

// Route pour gérer la soumission du formulaire de connexion
Route::post('/supper_admin/connexion', [AuthAdminController::class, 'connexion']);


// Route pour afficher la page du mot de passe oublié
Route::get('/supper_admin/mot_de_passe_oublie', [PageController::class, 'password'])->name('password');




Route::middleware('auth')->group(function () {

// Route pour déconnecter l'utilisateur
Route::post('/logout', [AuthAdminController::class, 'logout'])->name('logout');


// Route pour afficher la page du tableau de bord 
Route::get('/supper_admin/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

// Affichage des pages utilisateurs
// Route pour afficher la page chargeur 
Route::get('/supper_admin/utilisateurs/chargeur', [PageController::class, 'chargeur'])->name('utilisateurs.chargeur');
// Route pour afficher la page chargeur 
Route::get('/supper_admin/utilisateurs/transporteur', [PageController::class, 'transporteur'])->name('utilisateurs.transporteur');
// Route pour afficher la page chargeur 
Route::get('/supper_admin/utilisateurs/chauffeur', [PageController::class, 'chauffeur'])->name('utilisateurs.chauffeur');

// Affichage des pages utilisateurs
// Route pour afficher les details de la page chargeur 
Route::get('/supper_admin/utilisateurs/details_chargeur', [PageController::class, 'details_chargeur'])->name('utilisateurs.details_chargeur');
// Route pour afficher les details de la page chargeur 
Route::get('/supper_admin/utilisateurs/details_transporteur', [PageController::class, 'details_transporteur'])->name('utilisateurs.details_transporteur');
// Route pour afficher les details de la page chargeur 
Route::get('/supper_admin/utilisateurs/details_chauffeur', [PageController::class, 'details_chauffeur'])->name('utilisateurs.details_chauffeur');

// Affichage des pages camion
// Route pour afficher la page Rejetés 
Route::get('/supper_admin/camions/rejete', [PageController::class, 'rejete'])->name('camions.rejete');
// Route pour afficher la page Validés 
Route::get('/supper_admin/camions/valide', [PageController::class, 'valide'])->name('camions.valide');
// Route pour afficher la page En attents 
Route::get('/supper_admin/camions/en_attent', [PageController::class, 'en_attent'])->name('camions.en_attent');

// Affichage des pages Chats
// Route pour afficher la page chat Chargeur 
Route::get('/supper_admin/chats/chargeur', [PageController::class, 'chat_chargeur'])->name('chats.chargeur');


// Route pour afficher la page de Gestion des demandes
Route::get('/supper_admin/gestion_demande', [PageController::class, 'gestion_demande'])->name('gestion_demande');


// Route pour afficher la page du Traking 
Route::get('/supper_admin/traking', [PageController::class, 'traking'])->name('traking');


// Affiche des pages paramètre de ladmin 
// Route pour afficher la page du prfil de d'admin 
Route::get('/supper_admin/parametre/profil', [ProfilController::class, 'profil'])->name('profil');
// Route pour afficher la page du changement du mot de passe 
Route::get('/supper_admin/parametre/securite', [ProfilController::class, 'securite'])->name('securite');
Route::post('/supper_admin/parametre/securite', [ProfilController::class, 'changePassword'])->name('password.update');
// Route pour changer la photo de profil 
Route::post('/supper_admin/parametre/profil', [ProfilController::class, 'upload'])->name('image.upload');



// Route pour afficher la page details de la gestion des demandes  
Route::get('/supper_admin/gestion_demande/details', [PageController::class, 'details'])->name('details');

// Route pour afficher la page details des contenus pour valider  les camions
Route::get('/supper_admin/camions/details_val_camion', [PageController::class, 'details_val_camion'])->name('details_val_camion');



});
