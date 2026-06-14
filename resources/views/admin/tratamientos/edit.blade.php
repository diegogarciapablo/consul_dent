<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Tratamiento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.tratamientos.update', $tratamiento) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">{{ __('Nombre') }}</label>
                            <input id="nombre" name="nombre" type="text" value="{{ old('nombre', $tratamiento->nombre) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            @foreach ($errors->get('nombre') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">{{ __('Descripción') }}</label>
                            <textarea id="descripcion" name="descripcion" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('descripcion', $tratamiento->descripcion) }}</textarea>
                            @foreach ($errors->get('descripcion') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="duracion_min" class="block text-sm font-medium text-gray-700">{{ __('Duración (minutos)') }}</label>
                            <input id="duracion_min" name="duracion_min" type="number" value="{{ old('duracion_min', $tratamiento->duracion_min) }}" min="5" max="480" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            @foreach ($errors->get('duracion_min') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="precio" class="block text-sm font-medium text-gray-700">{{ __('Precio') }}</label>
                            <input id="precio" name="precio" type="number" step="0.01" value="{{ old('precio', $tratamiento->precio) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            @foreach ($errors->get('precio') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="activo" class="block text-sm font-medium text-gray-700">{{ __('Estado') }}</label>
                            <select id="activo" name="activo" class="mt-1 block w-full rounded-md border-gray-300 bg-white py-2 px-3 text-base shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option value="1" {{ old('activo', $tratamiento->activo) == '1' ? 'selected' : '' }}>{{ __('Activo') }}</option>
                                <option value="0" {{ old('activo', $tratamiento->activo) == '0' ? 'selected' : '' }}>{{ __('Inactivo') }}</option>
                            </select>
                            @foreach ($errors->get('activo') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{ __('Guardar') }}</button>
                            <a href="{{ route('admin.tratamientos.index') }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900">{{ __('Cancelar') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
