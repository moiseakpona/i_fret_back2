<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enregistrement extends Model
{
    // Nom de la table dans la base de données
    protected $table = 'vehicules';

    // Les champs que vous souhaitez remplir massivement
    protected $fillable = [
        'matricule', 'photo_camion', 'carte_grise', 'visite_technique', 'assurance',
    ];

    // Si vos clés primaires ne sont pas des IDs auto-incrémentées
    public $incrementing = true;

    // Si vous utilisez des timestamps
    public $timestamps = true;

    // Définissez vos relations avec d'autres modèles ici le cas échéant
}
