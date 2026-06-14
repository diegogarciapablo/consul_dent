<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Horario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @php
                        $dias = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
                    @endphp

                    <form action="{{ route('dentista.horarios.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="dia_semana" class="block text-sm font-medium text-gray-700">{{ __('Día') }}</label>
                            <select id="dia_semana" name="dia_semana" class="mt-1 block w-full rounded-md border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option value="">{{ __('Seleccione un día') }}</option>
                                @foreach ($dias as $index => $dia)
                                    <option value="{{ $index }}" {{ old('dia_semana') == $index ? 'selected' : '' }}>{{ $dia }}</option>
                                @endforeach
                            </select>
                            @foreach ($errors->get('dia_semana') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="hora_inicio" class="block text-sm font-medium text-gray-700">{{ __('Hora Inicio') }}</label>
                            <input id="hora_inicio" name="hora_inicio" type="time" value="{{ old('hora_inicio') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            @foreach ($errors->get('hora_inicio') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div>
                            <label for="hora_fin" class="block text-sm font-medium text-gray-700">{{ __('Hora Fin') }}</label>
                            <input id="hora_fin" name="hora_fin" type="time" value="{{ old('hora_fin') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            @foreach ($errors->get('hora_fin') as $message)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @endforeach
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{ __('Guardar') }}</button>
                            <a href="{{ route('dentista.horarios.index') }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900">{{ __('Cancelar') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
