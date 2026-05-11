@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-8">Estadísticas</h1>

            <h2 class="text-2xl font-bold mb-4">Tabla de Posiciones</h2>
            <div class="overflow-x-auto mb-8">
                <table class="min-w-full bg-white border">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Equipo</th>
                            <th class="px-4 py-2">PJ</th>
                            <th class="px-4 py-2">PG</th>
                            <th class="px-4 py-2">PP</th>
                            <th class="px-4 py-2">PF</th>
                            <th class="px-4 py-2">PC</th>
                            <th class="px-4 py-2">Dif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($standings as $s)
                        <tr class="border-t">
                            <td class="px-4 py-2 font-medium">{{ $s->team->name }}</td>
                            <td class="px-4 py-2">{{ $s->played }}</td>
                            <td class="px-4 py-2 text-green-600">{{ $s->wins }}</td>
                            <td class="px-4 py-2 text-red-600">{{ $s->losses }}</td>
                            <td class="px-4 py-2">{{ $s->points_for }}</td>
                            <td class="px-4 py-2">{{ $s->points_against }}</td>
                            <td class="px-4 py-2">{{ $s->difference }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h2 class="text-2xl font-bold mb-4">Próximos Partidos</h2>
            <div class="mb-8">
                @foreach($upcomingGames as $game)
                    <div class="bg-gray-100 p-2 rounded mb-2 flex justify-between">
                        <span>{{ $game->localTeam->name }} vs {{ $game->visitorTeam->name }}</span>
                        <span>{{ $game->game_date->format('d/m/Y H:i') }}</span>
                    </div>
                @endforeach
            </div>

            <h2 class="text-2xl font-bold mb-4">Resultados Recientes</h2>
            <div>
                @foreach($recentResults as $game)
                    <div class="bg-gray-100 p-2 rounded mb-2 flex justify-between">
                        <span><strong>{{ $game->localTeam->name }}</strong> {{ $game->local_points }} - {{ $game->visitor_points }} <strong>{{ $game->visitorTeam->name }}</strong></span>
                        <span>{{ $game->game_date->format('d/m/Y') }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection