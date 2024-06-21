<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Fret extends Model

{
    use HasFactory;

    protected $fillable = [
        'lieu_depart',
        'lieu_arrive',
        'montant',
        'description',
        'numero_tel',
        'id_demande',
        'statut',
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
}