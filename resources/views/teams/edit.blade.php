@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Editar Equipo: {{ $team->name }}</h2>

            <form action="{{ route('teams.update', $team) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block font-medium">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $team->name) }}" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Ciudad</label>
                    <input type="text" name="city" value="{{ old('city', $team->city) }}" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Entrenador</label>
                    <input type="text" name="coach" value="{{ old('coach', $team->coach) }}" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Nuevo Logo (opcional)</label>
                    <input type="file" name="logo" accept="image/*" class="w-full border rounded p-2">
                    @if($team->logo)
                        <img src="{{ asset('storage/' . $team->logo) }}" class="w-16 h-16 mt-2">
                    @endif
                </div>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Actualizar</button>
                <a href="{{ route('teams.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection