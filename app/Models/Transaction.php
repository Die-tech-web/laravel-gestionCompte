<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'compte_id',
        'type',
        'montant',
        'date',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Relation avec Compte
    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }
}
