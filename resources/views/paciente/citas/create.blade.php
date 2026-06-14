<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reservar Cita
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-6"
                x-data="{
                    paso: 1,
                    dentista_id: '',
                    tratamiento_id: '',
                    fecha: '',
                    hora_inicio: '',
                    slots: [],
                    cargando: false,
                    mensaje: '',
                    dentistas: {{ Js::from($dentistas->map(fn($d) => ['id' => $d->id, 'name' => $d->user->name])) }},
                    tratamientos: {{ Js::from($tratamientos->map(fn($t) => ['id' => $t->id, 'nombre' => $t->nombre])) }},
                    async cargarSlots() {
                        if (!this.dentista_id || !this.tratamiento_id || !this.fecha) return;
                        this.cargando = true;
                        this.slots = [];
                        this.mensaje = '';
                        const res = await fetch('/paciente/disponibilidad?dentista_id=' + this.dentista_id + '&fecha=' + this.fecha + '&tratamiento_id=' + this.tratamiento_id);
                        const data = await res.json();
                        this.slots = data.slots || [];
                        this.mensaje = data.mensaje || '';
                        this.cargando = false;
                    }
                }">

                {{-- PASO 1 --}}
                <div x-show="paso === 1">
                    <h3 class="text-lg font-semibold mb-4">Paso 1: Seleccioná dentista, tratamiento y fecha</h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dentista</label>
                        <select x-model="dentista_id" @change="cargarSlots()" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Seleccioná un dentista --</option>
                            @foreach($dentistas as $d)
                                <option value="{{ $d->id }}">{{ $d->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tratamiento</label>
                        <select x-model="tratamiento_id" @change="cargarSlots()" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Seleccioná un tratamiento --</option>
                            @foreach($tratamientos as $t)
                                <option value="{{ $t->id }}">{{ $t->nombre }} ({{ $t->duracion_min }} min)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" x-model="fecha" @change="cargarSlots()"
                            min="{{ date('Y-m-d') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <button
                        @click="paso = 2"
                        :disabled="!dentista_id || !tratamiento_id || !fecha"
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed">
                        Ver horarios disponibles
                    </button>
                </div>

                {{-- PASO 2 --}}
                <div x-show="paso === 2">
                    <h3 class="text-lg font-semibold mb-4">Paso 2: Seleccioná un horario</h3>

                    <div x-show="cargando" class="text-center py-8 text-gray-500">
                        Cargando horarios disponibles...
                    </div>

                    <div x-show="!cargando && mensaje" class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                        <p x-text="mensaje"></p>
                    </div>

                    <div x-show="!cargando && slots.length === 0 && !mensaje" class="text-gray-500 text-center py-4">
                        Seleccioná dentista, tratamiento y fecha para ver horarios.
                    </div>

                    <div x-show="!cargando && slots.length > 0" class="grid grid-cols-3 gap-3 mb-6">
                        <template x-for="slot in slots" :key="slot">
                            <button
                                @click="hora_inicio = slot; paso = 3"
                                class="border border-indigo-300 text-indigo-700 py-2 px-3 rounded-md hover:bg-indigo-50 text-sm font-medium"
                                x-text="slot">
                            </button>
                        </template>
                    </div>

                    <button @click="paso = 1" class="text-gray-600 hover:underline text-sm">
                        ← Volver
                    </button>
                </div>

                {{-- PASO 3 --}}
                <div x-show="paso === 3">
                    <h3 class="text-lg font-semibold mb-4">Paso 3: Confirmá tu cita</h3>

                    <div class="bg-gray-50 rounded-lg p-4 mb-6 space-y-2 text-sm">
                        <div><span class="font-medium">Dentista:</span> <span x-text="dentistas.find(d => d.id == dentista_id)?.name || ''"></span></div>
                        <div><span class="font-medium">Tratamiento:</span> <span x-text="tratamientos.find(t => t.id == tratamiento_id)?.nombre || ''"></span></div>
                        <div><span class="font-medium">Fecha:</span> <span x-text="fecha"></span></div>
                        <div><span class="font-medium">Hora:</span> <span x-text="hora_inicio"></span></div>
                    </div>

                    <form method="POST" action="{{ route('paciente.citas.store') }}">
                        @csrf
                        <input type="hidden" name="dentista_id" :value="dentista_id">
                        <input type="hidden" name="tratamiento_id" :value="tratamiento_id">
                        <input type="hidden" name="fecha" :value="fecha">
                        <input type="hidden" name="hora_inicio" :value="hora_inicio">

                        <button type="submit"
                            class="w-full bg-green-600 text-white font-semibold py-3 px-4 rounded-md hover:bg-green-700 mt-4">
                            Confirmar reserva
                        </button>
                    </form>

                    <button @click="paso = 2" class="mt-3 text-gray-600 hover:underline text-sm block">
                        ← Volver
                    </button>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
