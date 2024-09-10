<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fret extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'lieu_depart',
        'lieu_arrive',
        'info_comp',
        'type_camion',
        'type_marchandise',
        'montant',
        'numero_tel',
        'statut',
        'kkiapay_transaction_id',
        'statut_paiement',
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'numero_tel', 'numero_tel');
    }

    public function Chauffeur()
{
    return $this->belongsTo(User::class, 'numero_tel', 'numero_tel');
}

// Relation avec le modèle Soumissionnaire
public function soumissionnaires()
{
    return $this->hasMany(Soumissionnaire::class);
}


}
