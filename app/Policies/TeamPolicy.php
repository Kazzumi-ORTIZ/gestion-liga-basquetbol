<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Team;

class TeamPolicy
{
    public function update(User $user, Team $team)
    {
        return $user->isAdmin() || $user->id === $team->user_id;
    }

    public function delete(User $user, Team $team)
    {
        return $user->isAdmin() || $user->id === $team->user_id;
    }

    public function view(User $user, Team $team)
    {
        return $user->isAdmin() || $user->id === $team->user_id;
    }
}