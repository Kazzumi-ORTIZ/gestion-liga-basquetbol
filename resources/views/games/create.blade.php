@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Programar Partido</h2>
            <form action="{{ route('games.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block font-medium">Equipo Local</label>
                    <select name="local_team_id" class="w-full border rounded p-2" required>
                        <option value="">Seleccione</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Equipo Visitante</label>
                    <select name="visitor_team_id" class="w-full border rounded p-2" required>
                        <option value="">Seleccione</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Fecha y Hora</label>
                    <input type="datetime-local" name="game_date" class="w-full border rounded p-2" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Programar</button>
                <a href="{{ route('games.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection