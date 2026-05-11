<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Game;

class GamePolicy
{
    public function update(User $user, Game $game)
    {
        return $user->isAdmin() || 
               $user->id === $game->localTeam->user_id || 
               $user->id === $game->visitorTeam->user_id;
    }

    public function delete(User $user, Game $game)
    {
        return $this->update($user, $game);
    }
}