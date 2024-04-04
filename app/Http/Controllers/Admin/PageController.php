<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function dashboard()
    {
        // Retourner la vue dashboard
        return view('supper_admin.dashboard');
    }

    public function chargeur()
    {
        // Retourner la vue du chargeur
        return view('supper_admin.utilisateurs.chargeur');
    }

    public function details_chargeur()
    {
        // Retourner la vue details du chargeur
        return view('supper_admin.utilisateurs.details_chargeur');
    }

    public function transporteur()
    {
        // Retourner la vue du Transporteur
        return view('supper_admin.utilisateurs.transporteur');
    }

    public function details_transporteur()
    {
        // Retourner la vue details du Transporteur
        return view('supper_admin.utilisateurs.details_transporteur');
    }

    public function chauffeur()
    {
        // Retourner la vue du Chauffeur
        return view('supper_admin.utilisateurs.chauffeur');
    }

    public function details_chauffeur()
    {
        // Retourner la vue details du Chauffeur
        return view('supper_admin.utilisateurs.details_chauffeur');
    }

    public function rejete()
    {
        // Retourner la vue des camions Rejetés
        return view('supper_admin.camions.rejete');
    }

    public function valide()
    {
        // Retourner la vue des camions Validés
        return view('supper_admin.camions.valide');
    }

    public function en_attent()
    {
        // Retourner la vue des camions En attents
        return view('supper_admin.camions.en_attent');
    }

    public function chat_chargeur()
    {
        // Retourner la vue du chat Chargeur
        return view('supper_admin.chats.chargeur');
    }
    
    public function gestion_demande()
    {
        // Retourner la vue Gestion demande
        return view('supper_admin.gestion_demande.gestion_demande');
    }

    public function traking()
    {
        // Retourner la vue Traking
        return view('supper_admin.traking');
    }

    public function password()
    {
        // Retourner la vue mot de passe oublié
        return view('supper_admin.connexion.password');
    }


    //==========================================================


    public function details()
    {
        // Retourner la vue connexion
        return view('supper_admin.gestion_demande.details');
    }


    public function details_val_camion()
    {
        // Retourner la vue des camions à valider en attent
        return view('supper_admin.camions.details_val_camion');
    }










    public function essai()
    {
        // Retourner la vue du chargeur
        return view('essai');
    }




}
