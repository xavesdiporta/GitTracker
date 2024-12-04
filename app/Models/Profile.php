<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'github_username']; // Adicione outros campos conforme necessário

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

