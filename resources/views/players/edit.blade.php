@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Editar Jugador: {{ $player->name }}</h2>

            <form action="{{ route('players.update', $player) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block font-medium">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $player->name) }}" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Edad</label>
                    <input type="number" name="age" value="{{ old('age', $player->age) }}" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Posición</label>
                    <select name="position" class="w-full border rounded p-2">
                        <option value="base" {{ $player->position == 'base' ? 'selected' : '' }}>Base</option>
                        <option value="escolta" {{ $player->position == 'escolta' ? 'selected' : '' }}>Escolta</option>
                        <option value="alero" {{ $player->position == 'alero' ? 'selected' : '' }}>Alero</option>
                        <option value="ala-pivot" {{ $player->position == 'ala-pivot' ? 'selected' : '' }}>Ala-Pívot</option>
                        <option value="pivot" {{ $player->position == 'pivot' ? 'selected' : '' }}>Pívot</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Número de camiseta</label>
                    <input type="number" name="jersey_number" value="{{ old('jersey_number', $player->jersey_number) }}" class="w-full border rounded p-2" required>
                </div>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Actualizar</button>
                <a href="{{ route('players.index', ['team_id' => $player->team_id]) }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection