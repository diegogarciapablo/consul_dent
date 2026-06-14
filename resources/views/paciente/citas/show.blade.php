<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-6">
                    @php
                        $estadoClases = [
                            'pendiente' => 'bg-yellow-100 text-yellow-800',
                            'confirmada' => 'bg-blue-100 text-blue-800',
                            'completada' => 'bg-green-100 text-green-800',
                            'cancelada' => 'bg-red-100 text-red-800',
                        ];

                        $pagoClases = [
                            'pendiente' => 'bg-yellow-100 text-yellow-800',
                            'pagado' => 'bg-green-100 text-green-800',
                            'rechazado' => 'bg-red-100 text-red-800',
                        ];
                    @endphp

                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 space-y-4">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">{{ __('Dentista') }}</p>
                                <p class="mt-1 text-gray-900">{{ $cita->dentista->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">{{ __('Especialidad') }}</p>
                                <p class="mt-1 text-gray-900">{{ $cita->dentista->especialidad }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">{{ __('Tratamiento') }}</p>
                                <p class="mt-1 text-gray-900">{{ $cita->tratamiento->nombre }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">{{ __('Duración estimada') }}</p>
                                <p class="mt-1 text-gray-900">{{ $cita->tratamiento->duracion_min }} {{ __('minutos') }}</p>
                            </div>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">{{ __('Fecha') }}</p>
                                <p class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">{{ __('Hora') }}</p>
                                <p class="mt-1 text-gray-900">{{ substr($cita->hora_inicio, 0, 5) }} - {{ substr($cita->hora_fin, 0, 5) }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-semibold text-gray-700">{{ __('Estado') }}</p>
                                <span class="mt-1 inline-flex rounded-full px-3 py-1 text-sm font-semibold {{ $estadoClases[$cita->estado] ?? 'bg-gray-100 text-gray-800' }}">{{ ucfirst($cita->estado) }}</span>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-700">{{ __('Notas') }}</p>
                            <p class="mt-1 text-gray-900">{{ $cita->notas ?? __('Sin notas.') }}</p>
                        </div>
                    </div>

                    @if ($cita->pago)
                        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('Pago') }}</h3>
                            <div class="mt-4 grid gap-6 md:grid-cols-3">
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">{{ __('Monto') }}</p>
                                    <p class="mt-1 text-gray-900">${{ number_format($cita->pago->monto, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">{{ __('Método') }}</p>
                                    <p class="mt-1 text-gray-900">{{ $cita->pago->metodo }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">{{ __('Estado del pago') }}</p>
                                    <span class="mt-1 inline-flex rounded-full px-3 py-1 text-sm font-semibold {{ $pagoClases[$cita->pago->estado] ?? 'bg-gray-100 text-gray-800' }}">{{ ucfirst($cita->pago->estado) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-col gap-4 sm:flex-row">
                        <a href="{{ route('paciente.citas.index') }}" class="inline-flex items-center justify-center rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">{{ __('Volver a mis citas') }}</a>

                        @if (in_array($cita->estado, ['pendiente', 'confirmada'], true))
                            @php $deleteMessage = __('¿Estás seguro de que deseas cancelar esta cita?'); @endphp
                            <form action="{{ route('paciente.citas.destroy', $cita) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" onclick="return confirm('{{ $deleteMessage }}');">{{ __('Cancelar cita') }}</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
