<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Paciente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.pacientes.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">{{ __('Usuario') }}</label>
                            <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option value="">{{ __('Seleccione un usuario') }}</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }} - {{ $usuario->email }}</option>
                                @endforeach
                            </select>
                            @foreach ($errors->get('user_id') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">{{ __('Fecha Nacimiento') }}</label>
                            <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ old('fecha_nacimiento') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            @foreach ($errors->get('fecha_nacimiento') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="telefono" class="block text-sm font-medium text-gray-700">{{ __('Teléfono') }}</label>
                            <input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            @foreach ($errors->get('telefono') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="direccion" class="block text-sm font-medium text-gray-700">{{ __('Dirección') }}</label>
                            <textarea id="direccion" name="direccion" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('direccion') }}</textarea>
                            @foreach ($errors->get('direccion') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{ __('Guardar') }}</button>
                            <a href="{{ route('admin.pacientes.index') }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900">{{ __('Cancelar') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
