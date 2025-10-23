<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'admin_code', 'department'];

    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accès aux attributs utilisateur via la relation
    public function getNameAttribute()
    {
        return $this->user->name;
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }
}
