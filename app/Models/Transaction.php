<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'fret_id',
        'kkiapay_transaction_id',
        'montant_paye',
    ];

    // Relation avec le modèle Fret (Chaque transaction appartient à un fret)
    public function fret()
    {
        return $this->belongsTo(Fret::class, 'fret_id');
    }
}
