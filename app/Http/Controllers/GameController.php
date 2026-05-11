<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $query = Game::with(['localTeam', 'visitorTeam']);
        if (!$user->isAdmin()) {
            $query->whereHas('localTeam', fn($q) => $q->where('user_id', $user->id))
                  ->orWhereHas('visitorTeam', fn($q) => $q->where('user_id', $user->id));
        }
        $games = $query->get();
        return view('games.index', compact('games'));
    }

    public function create()
    {
        $teams = Team::when(!Auth::user()->isAdmin(), function($q) {
            return $q->where('user_id', Auth::id());
        })->get();
        return view('games.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'local_team_id' => 'required|exists:teams,id',
            'visitor_team_id' => 'required|exists:teams,id|different:local_team_id',
            'game_date' => 'required|date',
        ]);

        $user = Auth::user();
        $localTeam = Team::find($request->local_team_id);
        $visitorTeam = Team::find($request->visitor_team_id);
        if (!$user->isAdmin() && ($localTeam->user_id != $user->id || $visitorTeam->user_id != $user->id)) {
            abort(403, 'Solo puedes crear partidos con tus equipos.');
        }

        Game::create($request->all());
        return redirect()->route('games.index')->with('success', 'Partido programado.');
    }

    public function edit(Game $game)
    {
        $this->authorize('update', $game);
        $teams = Team::when(!Auth::user()->isAdmin(), fn($q) => $q->where('user_id', Auth::id()))->get();
        return view('games.edit', compact('game', 'teams'));
    }

    public function update(Request $request, Game $game)
    {
        $this->authorize('update', $game);
        $request->validate([
            'local_points' => 'nullable|integer|min:0',
            'visitor_points' => 'nullable|integer|min:0',
            'status' => 'required|in:programado,terminado',
        ]);
        $game->update($request->only('local_points', 'visitor_points', 'status'));
        return redirect()->route('games.index')->with('success', 'Partido actualizado.');
    }

    public function destroy(Game $game)
    {
        $this->authorize('delete', $game);
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Partido eliminado.');
    }
}