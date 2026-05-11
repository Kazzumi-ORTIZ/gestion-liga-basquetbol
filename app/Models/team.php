<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'coach', 'logo', 'city', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function localGames()
    {
        return $this->hasMany(Game::class, 'local_team_id');
    }

    public function visitorGames()
    {
        return $this->hasMany(Game::class, 'visitor_team_id');
    }
}