<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envoyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'statut',
        'numero_tel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'numero_tel', 'numero_tel');
    }
}
