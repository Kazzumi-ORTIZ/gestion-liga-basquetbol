@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Partidos</h2>
                <a href="{{ route('games.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Programar Partido</a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Local</th>
                        <th class="px-4 py-2">Visitante</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Resultado</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($games as $game)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $game->localTeam->name }}</td>
                        <td class="px-4 py-2">{{ $game->visitorTeam->name }}</td>
                        <td class="px-4 py-2">{{ $game->game_date->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-2">
                            @if($game->status == 'terminado')
                                {{ $game->local_points }} - {{ $game->visitor_points }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $game->status }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('games.edit', $game) }}" class="text-yellow-600">Registrar resultado</a>
                            <form action="{{ route('games.destroy', $game) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar partido?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No hay partidos programados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection