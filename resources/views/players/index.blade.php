@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Jugadores de {{ $team->name }}</h2>
                <a href="{{ route('players.create', ['team_id' => $team->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Agregar Jugador</a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Edad</th>
                        <th class="px-4 py-2">Posición</th>
                        <th class="px-4 py-2"># Camiseta</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $player->name }}</td>
                        <td class="px-4 py-2">{{ $player->age }}</td>
                        <td class="px-4 py-2">{{ $player->position }}</td>
                        <td class="px-4 py-2">{{ $player->jersey_number }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('players.edit', $player) }}" class="text-yellow-600">Editar</a>
                            <form action="{{ route('players.destroy', $player) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No hay jugadores registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('teams.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-3 py-1 rounded">← Volver a equipos</a>
        </div>
    </div>
</div>
@endsection