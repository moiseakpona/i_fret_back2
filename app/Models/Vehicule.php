<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'matricule_commentaire',
        'photo_camion',
        'photo_camion_commentaire',
        'carte_grise',
        'carte_grise_commentaire',
        'visite_technique',
        'visite_exp',
        'visite_technique_commentaire',
        'assurance',
        'assurance_exp',
        'assurance_commentaire',
        'statut',
        'numero_tel',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'numero_tel', 'numero_tel');
    }
}