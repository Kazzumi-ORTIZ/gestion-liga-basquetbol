@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Agregar Jugador a {{ $team->name }}</h2>

            <form action="{{ route('players.store') }}" method="POST">
                @csrf
                <input type="hidden" name="team_id" value="{{ $team->id }}">
                <div class="mb-4">
                    <label class="block font-medium">Nombre completo</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Edad</label>
                    <input type="number" name="age" value="{{ old('age') }}" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Posición</label>
                    <select name="position" class="w-full border rounded p-2" required>
                        <option value="base">Base</option>
                        <option value="escolta">Escolta</option>
                        <option value="alero">Alero</option>
                        <option value="ala-pivot">Ala-Pívot</option>
                        <option value="pivot">Pívot</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Número de camiseta</label>
                    <input type="number" name="jersey_number" value="{{ old('jersey_number') }}" class="w-full border rounded p-2" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar Jugador</button>
                <a href="{{ route('players.index', ['team_id' => $team->id]) }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection