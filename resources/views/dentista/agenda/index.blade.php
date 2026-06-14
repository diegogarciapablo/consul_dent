<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Mi Agenda</h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Agenda del dentista</h3>
                    <p class="mt-1 text-sm text-gray-600">Consulta tus citas y filtra por fecha.</p>
                </div>
                <a href="{{ route('dentista.horarios.index') }}" class="inline-flex items-center justify-center rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Gestionar mis horarios
                </a>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <aside class="space-y-4 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h4 class="text-sm font-semibold uppercase tracking-wide text-gray-500">Próximos 7 días</h4>
                    <div class="space-y-2">
                        @for ($i = 0; $i < 7; $i++)
                            @php
                                $dia = \Carbon\Carbon::today()->addDays($i);
                                $fechaDia = $dia->format('Y-m-d');
                                $citasCount = $citasSemana->get($fechaDia)?->count() ?? 0;
                                $esSeleccionado = $fecha === $fechaDia;
                            @endphp

                            <a href="{{ route('dentista.agenda.index', ['fecha' => $fechaDia]) }}" class="block rounded-xl border px-4 py-3 text-left transition {{ $esSeleccionado ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-gray-200 bg-white text-gray-700 hover:border-indigo-400 hover:bg-indigo-50' }}">
                                <p class="text-sm font-medium">{{ $dia->locale('es')->isoFormat('dddd') }}</p>
                                <p class="mt-1 text-sm text-gray-500">{{ $dia->format('d/m') }}</p>
                                <p class="mt-2 text-xs font-semibold uppercase tracking-wide text-gray-500">{{ $citasCount }} cita{{ $citasCount === 1 ? '' : 's' }}</p>
                            </a>
                        @endfor
                    </div>
                </aside>

                <section class="lg:col-span-2 space-y-6">
                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">
                                    {{ \Carbon\Carbon::parse($fecha)->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY') }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Citas programadas para este día.</p>
                            </div>
                            <form method="GET" action="{{ route('dentista.agenda.index') }}" class="flex items-center gap-2">
                                <input type="date" name="fecha" value="{{ $fecha }}" class="rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                <button type="submit" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Ver
                                </button>
                            </form>
                        </div>
                    </div>

                    @if ($citas->isEmpty())
                        <div class="rounded-xl border border-dashed border-gray-300 bg-white p-6 text-center text-gray-600 shadow-sm">
                            No tenés citas para este día.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($citas as $cita)
                                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ substr($cita->hora_inicio, 0, 5) }} - {{ substr($cita->hora_fin, 0, 5) }}
                                            </p>
                                            <p class="mt-2 text-sm text-gray-600">{{ $cita->paciente->user->name }}</p>
                                            <p class="mt-1 text-sm text-gray-500">Tratamiento: {{ $cita->tratamiento->nombre }}</p>
                                        </div>
                                        <div class="flex flex-col items-start gap-3 sm:items-end">
                                            @php
                                                $estadoClasses = [
                                                    'pendiente' => 'bg-yellow-100 text-yellow-800',
                                                    'confirmada' => 'bg-blue-100 text-blue-800',
                                                    'completada' => 'bg-green-100 text-green-800',
                                                    'cancelada' => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp
                                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $estadoClasses[$cita->estado] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($cita->estado) }}
                                            </span>
                                            <a href="{{ route('dentista.citas.show', $cita) }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Ver detalle
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
