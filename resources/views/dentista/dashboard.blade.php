<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Agenda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Bienvenido, :name', ['name' => $dentista->user->name]) }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ __('Aquí tenés un resumen de tu agenda y disponibilidad.') }}</p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <p class="text-sm font-medium text-gray-500">Total de citas</p>
                    <p class="mt-4 text-3xl font-semibold text-gray-900">{{ $totalCitas }}</p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <p class="text-sm font-medium text-gray-500">Citas hoy</p>
                    <p class="mt-4 text-3xl font-semibold text-gray-900">{{ $citasHoy }}</p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <p class="text-sm font-medium text-gray-500">Horarios configurados</p>
                    <p class="mt-4 text-3xl font-semibold text-gray-900">{{ $totalHorarios }}</p>
                </div>
            </div>

            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-gray-900">Próximas citas</h3>
                    @if ($citasProximas->isEmpty())
                        <p class="mt-4 text-sm text-gray-600">No tenés citas próximas.</p>
                    @else
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tratamiento</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($citasProximas as $cita)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ substr($cita->hora_inicio, 0, 5) }} - {{ substr($cita->hora_fin, 0, 5) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cita->paciente->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cita->tratamiento->nombre }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $cita->estado === 'pendiente' ? 'text-yellow-700' : ($cita->estado === 'confirmada' ? 'text-blue-700' : ($cita->estado === 'completada' ? 'text-green-700' : 'text-red-700')) }}">
                                                {{ ucfirst($cita->estado) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <a href="{{ route('dentista.agenda.index') }}" class="block w-full bg-indigo-600 text-white font-semibold py-3 px-4 rounded-md hover:opacity-90 text-center mb-3">
                    Ver mi agenda
                </a>
                <a href="{{ route('dentista.horarios.index') }}" class="block w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-md hover:opacity-90 text-center mb-3">
                    Gestionar horarios
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
