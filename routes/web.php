<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\UtilisateurController;

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
Route::get('/supper_admin/utilisateurs/details_chargeur/{numero_tel}', [PageController::class, 'details_chargeur'])->name('utilisateurs.details_chargeur');
// Route pour afficher les details de la page chargeur 
Route::get('/supper_admin/utilisateurs/details_transporteur/{numero_tel}', [PageController::class, 'details_transporteur'])->name('utilisateurs.details_transporteur');
// Route pour afficher les details de la page chargeur 
Route::get('/supper_admin/utilisateurs/details_chauffeur/{numero_tel}', [PageController::class, 'details_chauffeur'])->name('utilisateurs.details_chauffeur');
// Route pour supprimer chargeur 
Route::delete('/supper_admin/utilisateurs/details_chargeur/{id}', [PageController::class, 'supprimer_chargeur'])->name('supprimer_chargeur');
// Route pour supprimer chauffeur 
Route::delete('/supper_admin/utilisateurs/details_chauffeur/{id}', [PageController::class, 'supprimer_chauffeur'])->name('supprimer_chauffeur');
// Route pour supprimer transporteur 
Route::delete('/supper_admin/utilisateurs/details_transporteur/{id}', [PageController::class, 'supprimer_transporteur'])->name('supprimer_transporteur');


// Affichage des pages camion
// Route pour afficher la page Rejetés 
Route::get('/supper_admin/camions/rejete', [PageController::class, 'rejete'])->name('camions.rejete');
// Route pour afficher la page du detail des véhicules rejetés 
Route::get('/supper_admin/camions/details_vehicule_rejete/{id}', [PageController::class, 'detail_rejete'])->name('detail_rejete');
// Route pour afficher la page Validés 
Route::get('/supper_admin/camions/valide', [PageController::class, 'valide'])->name('camions.valide');
// Route pour afficher la page du detail des véhicules validés
Route::get('/supper_admin/camions/details_vehicule_valide/{id}', [PageController::class, 'detail_valide'])->name('detail_valide');
// Route pour afficher la page En attents 
Route::get('/supper_admin/camions/en_attent', [PageController::class, 'en_attent'])->name('camions.en_attent');
// Route pour afficher la page du detail des véhicules en_attents 
Route::get('/supper_admin/camions/details_vehicule_en_attent/{id}', [PageController::class, 'detail_en_attent'])->name('detail_en_attent');
// Route pour valider le vehicule du transporteur en enregistrant les dates d'expiratiin de la visite technique et de la carte grise 
Route::post('/supper_admin/camions/details_vehicule_en_attent/valider/{id}', [PageController::class, 'forme_valide_vehicule'])->name('forme_valide_vehicule');
// Route pour rejeter le vehicule du transporteur en enregidtrant les commentaires emits 
Route::post('/supper_admin/camions/details_vehicule_en_attent/rejeter/{id}', [PageController::class, 'forme_rejete_vehicule'])->name('forme_rejete_vehicule');
// Route pour supprimer un véhicule dans detail rejeté
Route::delete('/supper_admin/camions/details_vehicule_en_attent/supprimer_vehicule_rejete/{id}', [PageController::class, 'supprimer_vehicule_rejete'])->name('supprimer_vehicule_rejete');
// Route pour supprimer un véhicule dans detail validé
Route::delete('/supper_admin/camions/details_vehicule_en_attent/supprimer_vehicule_valide/{id}', [PageController::class, 'supprimer_vehicule_valide'])->name('supprimer_vehicule_valide');
// Route pour supprimer un véhicule dans detail en attent
Route::delete('/supper_admin/camions/details_vehicule_en_attent/supprimer_vehicule_en_attent/{id}', [PageController::class, 'supprimer_vehicule_en_attent'])->name('supprimer_vehicule_en_attent');

// Affichage des pages Chats
// Route pour afficher la page chat Chargeur 
Route::get('/supper_admin/chats/chargeur', [PageController::class, 'chat_chargeur'])->name('chats.chargeur');
// Route pour afficher la page detail chat
Route::get('/supper_admin/chats/detail_chat/{numero_tel}', [PageController::class, 'detail_chat'])->name('detail_chat');
// Route pour enregistrer de nouvel fret
Route::post('/supper_admin/chats/chargeur/enregistrer/{numero_tel}', [UtilisateurController::class, 'fret_enregister'])->name('fret.enregister');
// Route pour enregistrer de message dans le chat
Route::post('/supper_admin/chats/chargeur/enregistrer/message/{numero_tel}', [UtilisateurController::class, 'message'])->name('message');


// Route de la page Gestion des demandes
// Route pour afficher la page de Gestion des demandes
Route::get('/supper_admin/gestion_demande', [PageController::class, 'gestion_demande'])->name('gestion_demande');
// Route pour afficher la page de Gestion des frets
Route::get('/supper_admin/gestion_fret', [PageController::class, 'gestion_fret'])->name('gestion_fret');
// Route pour afficher la page des frets disponibles
Route::get('/supper_admin/fret_diponible', [PageController::class, 'fret_diponible'])->name('fret_diponible');
// Route pour enregistrer une demande de fret
Route::post('/supper_admin/gestion_fret/demande', [UtilisateurController::class, 'demande'])->name('demande');


// Route pour afficher la page du Traking 
Route::get('/supper_admin/traking', [PageController::class, 'traking'])->name('traking');


// Affiche des pages paramètre de l'admin 
// Route pour afficher la page du prfil de d'admin 
Route::get('/supper_admin/parametre/profil', [ProfilController::class, 'profil'])->name('profil');
// Route pour afficher la page du changement du mot de passe 
Route::get('/supper_admin/parametre/securite', [ProfilController::class, 'securite'])->name('securite');
Route::post('/supper_admin/parametre/securite', [ProfilController::class, 'changePassword'])->name('password.update');
// Route pour changer la photo de profil 
Route::post('/supper_admin/parametre/profil', [ProfilController::class, 'upload'])->name('image.upload');
// Route pour modifier le profil de l'admin 
Route::post('/supper_admin/parametre/profil/update/{id}', [ProfilController::class, 'update_admin'])->name('update_admin');



// Route pour afficher la page details de la gestion des demandes  
Route::get('/supper_admin/gestion_demande/details', [PageController::class, 'details'])->name('details');

// Route pour afficher la page details des contenus pour valider  les camions
Route::get('/supper_admin/camions/details_val_camion', [PageController::class, 'details_val_camion'])->name('details_val_camion');



});
