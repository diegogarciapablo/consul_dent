<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConsulDent — Tu salud dental, nuestra prioridad</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800">
    <!-- Navbar -->
    <header class="bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">ConsulDent</a>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 hover:text-indigo-600 transition">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">Registrarse</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <main>
        <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 to-sky-600 text-white">
            <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="text-base font-semibold uppercase tracking-[0.3em] text-indigo-100">Bienvenido a ConsulDent</p>
                    <h1 class="mt-6 text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl">Tu salud dental, nuestra prioridad</h1>
                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-indigo-100">Reservá citas con los mejores especialistas de forma fácil y rápida.</p>
                    <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-md bg-white px-8 py-3 text-sm font-semibold text-indigo-700 shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-50">Reservar una cita</a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-md border border-white/30 bg-white/10 px-8 py-3 text-sm font-semibold text-white transition hover:bg-white/20">Iniciar sesión</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section class="bg-slate-50 py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Por qué elegir ConsulDent</h2>
                    <p class="mx-auto mt-4 max-w-2xl text-base text-slate-600">La plataforma ideal para gestionar tus citas dentales con seguridad y rapidez.</p>
                </div>
                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                        <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Reserva en línea</h3>
                        <p class="text-slate-600">Agendá tu cita en minutos desde cualquier dispositivo.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                        <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m6 2a2 2 0 11-4 0m0 0a2 2 0 11-4 0m6 0a2 2 0 11-4 0m0 0a2 2 0 11-4 0" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Dentistas especializados</h3>
                        <p class="text-slate-600">Contamos con profesionales en distintas especialidades.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                        <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Seguimiento de citas</h3>
                        <p class="text-slate-600">Consultá el estado de tus citas en tiempo real.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-900 py-8 text-center text-sm text-slate-400">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            &copy; {{ date('Y') }} ConsulDent
        </div>
    </footer>
</body>
</html>
