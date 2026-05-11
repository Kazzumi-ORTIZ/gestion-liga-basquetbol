@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Mis Equipos</h2>
                <a href="{{ route('teams.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Nuevo Equipo</a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($teams as $team)
                    <div class="border rounded-lg p-4 shadow">
                        @if($team->logo)
                            <img src="{{ asset('storage/' . $team->logo) }}" class="w-24 h-24 object-cover mx-auto mb-2 rounded-full">
                        @endif
                        <h3 class="text-xl font-semibold text-center">{{ $team->name }}</h3>
                        <p class="text-center">Ciudad: {{ $team->city }}</p>
                        <p class="text-center">Entrenador: {{ $team->coach }}</p>
                        <div class="mt-4 flex justify-center gap-2">
                            <a href="{{ route('teams.edit', $team) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
                            <form action="{{ route('teams.destroy', $team) }}" method="POST" onsubmit="return confirm('¿Eliminar equipo?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Eliminar</button>
                            </form>
                            <a href="{{ route('players.index', ['team_id' => $team->id]) }}" class="bg-green-500 text-white px-3 py-1 rounded">Jugadores</a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center">No hay equipos. ¡Crea uno!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection