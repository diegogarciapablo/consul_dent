<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Detalle de Cita</h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Información de la cita</h3>
                        <p class="mt-1 text-sm text-gray-600">Revisa los detalles de la cita y el estado del pago.</p>
                    </div>
                    <a href="{{ route('dentista.agenda.index') }}" class="inline-flex items-center justify-center rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Volver a mi agenda
                    </a>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-sm font-semibold text-gray-500">Fecha</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</p>
                    </div>
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-sm font-semibold text-gray-500">Hora</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ substr($cita->hora_inicio, 0, 5) }} - {{ substr($cita->hora_fin, 0, 5) }}</p>
                    </div>
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-sm font-semibold text-gray-500">Estado</p>
                        @php
                            $estadoClasses = [
                                'pendiente' => 'bg-yellow-100 text-yellow-800',
                                'confirmada' => 'bg-blue-100 text-blue-800',
                                'completada' => 'bg-green-100 text-green-800',
                                'cancelada' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <span class="mt-2 inline-flex rounded-full px-3 py-1 text-sm font-semibold {{ $estadoClasses[$cita->estado] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($cita->estado) }}
                        </span>
                    </div>
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-sm font-semibold text-gray-500">Paciente</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $cita->paciente->user->name }}</p>
                    </div>
                </div>

                <div class="mt-6 rounded-xl bg-white p-6 shadow-sm">
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Tratamiento</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900">{{ $cita->tratamiento->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Duración</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900">{{ $cita->tratamiento->duracion_min }} minutos</p>
                        </div>
                    </div>

                    <div class="mt-6 rounded-xl bg-gray-50 p-4">
                        <p class="text-sm font-semibold text-gray-500">Notas</p>
                        <p class="mt-2 text-gray-700">{{ $cita->notas ?? 'Sin notas.' }}</p>
                    </div>
                </div>

                @if ($cita->pago)
                    <div class="mt-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-900">Información de pago</h4>
                        <div class="mt-4 grid gap-6 sm:grid-cols-3">
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-sm font-semibold text-gray-500">Monto</p>
                                <p class="mt-2 text-lg font-semibold text-gray-900">{{ number_format($cita->pago->monto, 2, ',', '.') }}</p>
                            </div>
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-sm font-semibold text-gray-500">Método</p>
                                <p class="mt-2 text-lg font-semibold text-gray-900">{{ $cita->pago->metodo }}</p>
                            </div>
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-sm font-semibold text-gray-500">Estado pago</p>
                                <p class="mt-2 text-lg font-semibold text-gray-900">{{ ucfirst($cita->pago->estado) }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
