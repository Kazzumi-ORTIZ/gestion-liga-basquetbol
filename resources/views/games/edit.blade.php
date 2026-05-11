@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Registrar resultado del partido</h2>
            <p><strong>{{ $game->localTeam->name }} vs {{ $game->visitorTeam->name }}</strong> - {{ $game->game_date->format('d/m/Y H:i') }}</p>

            <form action="{{ route('games.update', $game) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block font-medium">Puntos Local</label>
                    <input type="number" name="local_points" value="{{ old('local_points', $game->local_points) }}" class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Puntos Visitante</label>
                    <input type="number" name="visitor_points" value="{{ old('visitor_points', $game->visitor_points) }}" class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Estado</label>
                    <select name="status" class="w-full border rounded p-2">
                        <option value="programado" {{ $game->status == 'programado' ? 'selected' : '' }}>Programado</option>
                        <option value="terminado" {{ $game->status == 'terminado' ? 'selected' : '' }}>Terminado</option>
                    </select>
                </div>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Guardar resultado</button>
                <a href="{{ route('games.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Volver</a>
            </form>
        </div>
    </div>
</div>
@endsection