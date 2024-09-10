<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soumissionnaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'localisation',
        'montant',
        'numero_tel_transport',
        'vehicule_id',
        'numero_tel_chauffeur',
        'fret_id',
        'statut',
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
 
     // Relation avec le modèle User pour le transporteur
     public function transporteur()
     {
         return $this->belongsTo(User::class, 'numero_tel_transport', 'numero_tel');
     }

        // Modèle Soumissionnaire
    public function chargeur()
    {
        return $this->belongsTo(User::class, 'chargeur_id'); // Ajuste le champ si nécessaire
    }

 
     // Relation avec le modèle Fret
     public function fret()
     {
         return $this->belongsTo(Fret::class);
     }
}
