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
        'montant',
        'numero_tel',
        'statut',
        'kkiapay_transaction_id',
        'statut_paiement',
      
    ];

    // Relations éventuelles avec d'autres tables
    public function user()
    {
        return $this->belongsTo(User::class, 'numero_tel', 'numero_tel');
    }

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'id_demande', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'fret_id');
    }
}
