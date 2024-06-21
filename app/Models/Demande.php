<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_vehicule',
        'montant',
        'lieu_depart',
        'lieu_arrive',
        'statut',
    ];

    // Relation avec le véhicule
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule_id');
    }

    // Relation avec le chauffeur (utilisateur)
    public function chauffeur()
    {
        return $this->belongsTo(User::class, 'chauffeur_id');
    }
}
