<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Dentista') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.dentistas.update', $dentista) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">{{ __('Usuario') }}</label>
                            <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option value="">{{ __('Seleccione un usuario') }}</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ old('user_id', $dentista->user_id) == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }} - {{ $usuario->email }}</option>
                                @endforeach
                            </select>
                            @foreach ($errors->get('user_id') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="especialidad" class="block text-sm font-medium text-gray-700">{{ __('Especialidad') }}</label>
                            <input id="especialidad" name="especialidad" type="text" value="{{ old('especialidad', $dentista->especialidad) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            @foreach ($errors->get('especialidad') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="nro_licencia" class="block text-sm font-medium text-gray-700">{{ __('Nro. Licencia') }}</label>
                            <input id="nro_licencia" name="nro_licencia" type="text" value="{{ old('nro_licencia', $dentista->nro_licencia) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            @foreach ($errors->get('nro_licencia') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{ __('Guardar') }}</button>
                            <a href="{{ route('admin.dentistas.index') }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900">{{ __('Cancelar') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
