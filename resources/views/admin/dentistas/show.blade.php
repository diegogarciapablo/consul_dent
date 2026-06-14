<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $dentista->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <p class="text-sm font-semibold text-gray-700">{{ __('Nombre completo') }}</p>
                        <p class="mt-1 text-gray-900">{{ $dentista->user->name }}</p>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <p class="text-sm font-semibold text-gray-700">{{ __('Email') }}</p>
                        <p class="mt-1 text-gray-900">{{ $dentista->user->email }}</p>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <p class="text-sm font-semibold text-gray-700">{{ __('Especialidad') }}</p>
                        <p class="mt-1 text-gray-900">{{ $dentista->especialidad }}</p>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <p class="text-sm font-semibold text-gray-700">{{ __('Nro. Licencia') }}</p>
                        <p class="mt-1 text-gray-900">{{ $dentista->nro_licencia }}</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.dentistas.edit', $dentista) }}" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{ __('Editar') }}</a>
                        <a href="{{ route('admin.dentistas.index') }}" class="inline-flex items-center justify-center rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">{{ __('Volver') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
