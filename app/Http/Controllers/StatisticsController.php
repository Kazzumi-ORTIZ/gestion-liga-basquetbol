<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teams = $user->isAdmin() ? Team::all() : Team::where('user_id', $user->id)->get();

        $standings = [];
        foreach ($teams as $team) {
            $games = Game::where('status', 'terminado')
                ->where(function ($q) use ($team) {
                    $q->where('local_team_id', $team->id)->orWhere('visitor_team_id', $team->id);
                })->get();

            $wins = 0; $losses = 0; $pf = 0; $pc = 0;
            foreach ($games as $game) {
                if ($game->local_team_id == $team->id) {
                    $pf += $game->local_points;
                    $pc += $game->visitor_points;
                    if ($game->local_points > $game->visitor_points) $wins++;
                    else $losses++;
                } else {
                    $pf += $game->visitor_points;
                    $pc += $game->local_points;
                    if ($game->visitor_points > $game->local_points) $wins++;
                    else $losses++;
                }
            }
            $standings[] = (object) [
                'team' => $team,
                'played' => $games->count(),
                'wins' => $wins,
                'losses' => $losses,
                'points_for' => $pf,
                'points_against' => $pc,
                'difference' => $pf - $pc,
            ];
        }
        usort($standings, fn($a, $b) => $b->wins <=> $a->wins);

        $topScorer = Player::orderBy('jersey_number', 'desc')->first(); // temporal, puedes ajustar
        $upcomingGames = Game::with(['localTeam', 'visitorTeam'])
            ->where('status', 'programado')
            ->where('game_date', '>', now())
            ->orderBy('game_date')
            ->limit(5)
            ->get();
        $recentResults = Game::with(['localTeam', 'visitorTeam'])
            ->where('status', 'terminado')
            ->orderBy('game_date', 'desc')
            ->limit(5)
            ->get();

        return view('statistics.index', compact('standings', 'topScorer', 'upcomingGames', 'recentResults'));
    }
}