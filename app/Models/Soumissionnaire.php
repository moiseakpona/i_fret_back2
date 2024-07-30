<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Soumissionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'localisation',
        'numero_tel_transport',
        'vehicule_id',
        'numero_tel_chauffeur',
        'demande_id',
        'statut_soumission',
        'statut_demande',
    ];

     // Relation avec le modèle Vehicule
     public function vehicule()
     {
         return $this->belongsTo(Vehicule::class);
     }
 
     // Relation avec le modèle User pour le chauffeur
     public function chauffeur()
     {
         return $this->belongsTo(User::class, 'numero_tel_chauffeur', 'numero_tel');
     }
 
     // Relation avec le modèle Demande
     public function demande()
     {
         return $this->belongsTo(Demande::class);
     }
}