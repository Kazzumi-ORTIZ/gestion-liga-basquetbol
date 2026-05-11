@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Crear Nuevo Equipo</h2>

            <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block font-medium">Nombre del equipo</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Ciudad</label>
                    <input type="text" name="city" value="{{ old('city') }}" class="w-full border rounded p-2" required>
                    @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Entrenador</label>
                    <input type="text" name="coach" value="{{ old('coach') }}" class="w-full border rounded p-2" required>
                    @error('coach') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Logo (opcional)</label>
                    <input type="file" name="logo" accept="image/*" class="w-full border rounded p-2">
                    @error('logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar Equipo</button>
                <a href="{{ route('teams.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection