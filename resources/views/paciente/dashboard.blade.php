<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Bienvenido</h3>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <a href="{{ route('paciente.citas.index') }}" class="block w-full bg-indigo-600 text-white font-semibold py-3 px-4 rounded-md hover:opacity-90 text-center mb-3">
                            Ver mis citas
                        </a>
                        <a href="{{ route('paciente.citas.create') }}" class="block w-full bg-green-600 text-white font-semibold py-3 px-4 rounded-md hover:opacity-90 text-center mb-3">
                            Reservar nueva cita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
