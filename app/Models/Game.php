<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['local_team_id', 'visitor_team_id', 'game_date', 'local_points', 'visitor_points', 'status'];

    protected $casts = [
        'game_date' => 'datetime',
    ];

    public function localTeam()
    {
        return $this->belongsTo(Team::class, 'local_team_id');
    }

    public function visitorTeam()
    {
        return $this->belongsTo(Team::class, 'visitor_team_id');
    }
}