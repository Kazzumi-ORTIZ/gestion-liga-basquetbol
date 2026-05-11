<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $teams = Team::with('user')->get();
        } else {
            $teams = Team::where('user_id', $user->id)->get();
        }
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'coach' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048'
        ]);

        $team = new Team($request->except('logo'));
        $team->user_id = Auth::id();

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('team-logos', 'public');
            $team->logo = $path;
        }

        $team->save();

        return redirect()->route('teams.index')->with('success', 'Equipo creado.');
    }

    public function edit(Team $team)
    {
        $this->authorize('update', $team);
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $this->authorize('update', $team);

        $request->validate([
            'name' => 'required|string|max:255',
            'coach' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        $team->update($request->only('name', 'coach', 'city'));

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('team-logos', 'public');
            $team->logo = $path;
            $team->save();
        }

        return redirect()->route('teams.index')->with('success', 'Equipo actualizado.');
    }

    public function destroy(Team $team)
    {
        $this->authorize('delete', $team);
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Equipo eliminado.');
    }
}