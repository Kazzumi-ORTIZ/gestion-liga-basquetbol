<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $teamId = $request->get('team_id');
        $team = Team::findOrFail($teamId);
        $this->authorize('view', $team);

        $players = Player::where('team_id', $teamId)->get();
        return view('players.index', compact('players', 'team'));
    }

    public function create(Request $request)
    {
        $teamId = $request->get('team_id');
        $team = Team::findOrFail($teamId);
        $this->authorize('update', $team);
        return view('players.create', compact('team'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:15|max:60',
            'position' => 'required|in:base,escolta,alero,ala-pivot,pivot',
            'jersey_number' => 'required|integer|min:0|max:99',
            'team_id' => 'required|exists:teams,id',
        ]);

        $team = Team::find($request->team_id);
        $this->authorize('update', $team);

        Player::create($request->all());
        return redirect()->route('players.index', ['team_id' => $request->team_id])
            ->with('success', 'Jugador agregado.');
    }

    public function edit(Player $player)
    {
        $this->authorize('update', $player->team);
        return view('players.edit', compact('player'));
    }

    public function update(Request $request, Player $player)
    {
        $this->authorize('update', $player->team);
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:15|max:60',
            'position' => 'required|in:base,escolta,alero,ala-pivot,pivot',
            'jersey_number' => 'required|integer|min:0|max:99',
        ]);
        $player->update($request->all());
        return redirect()->route('players.index', ['team_id' => $player->team_id])
            ->with('success', 'Jugador actualizado.');
    }

    public function destroy(Player $player)
    {
        $this->authorize('update', $player->team);
        $player->delete();
        return redirect()->route('players.index', ['team_id' => $player->team_id])
            ->with('success', 'Jugador eliminado.');
    }
}