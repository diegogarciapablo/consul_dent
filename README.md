# Sistema de gestión de clínica dental

## 1. DESCRIPCIÓN GENERAL

- **Nombre del proyecto:** Sistema de gestión de clínica dental
- **Stack tecnológico:** Laravel (PHP) + Laravel Sail (Docker) + Breeze (Blade) + Alpine.js + MySQL

## 2. ENTORNO DE DESARROLLO

Requisitos previos: Docker Desktop (WSL2 backend), WSL2 con una distro (ej. `Ubuntu`).

Comandos para levantar el proyecto (ejecutar desde WSL2 Ubuntu):

```bash
wsl -d Ubuntu
cd /mnt/c/Proyectos/clinica-dental
./vendor/bin/sail up -d
```

IMPORTANTE: TODOS los comandos relacionados con Sail/Artisan/Composer/NPM deben ejecutarse desde WSL2 (distro `Ubuntu`) — NUNCA desde PowerShell o Git Bash nativos en Windows, porque Sail no soporta Windows nativo/MINGW.

URLs de acceso:
- Aplicación: http://localhost
- MySQL: puerto 3306 (expuesto por Sail)
- Vite (dev): puerto 5173

Versiones relevantes observadas:
- MySQL: `8.4` (según `compose.yaml` generado por Sail)
- Laravel Framework: `13.15.0` (instalado en el proyecto)
- PHP: revisar desde WSL con `./vendor/bin/sail php -v` o `./vendor/bin/sail artisan --version` una vez Sail esté corriendo
- Node / NPM: revisar con `node -v` y `npm -v` dentro de WSL

## 3. PAQUETES Y DEPENDENCIAS INSTALADAS

Salida de `composer show` (paquetes principales instalados — `require` y `require-dev`):

- `laravel/framework` (13.15.0): El framework Laravel.
- `laravel/sail` (1.62.0): Scaffolding y archivos Docker para ejecutar la app en contenedores (Sail).
- `laravel/tinker` (3.0.2): REPL interactivo para Laravel.
- `fakerphp/faker` (1.24.1): Generador de datos falsos para pruebas/seeds.
- `nunomaduro/collision` (8.9.4): Manejo de errores para consola en desarrollo.
- `phpunit/phpunit` (12.5.29): Framework de pruebas unitarias.
- `laravel/pint` (1.29.1): Formateador de código para PHP (Pint).
- `guzzlehttp/guzzle` (7.11.1): Cliente HTTP para PHP.
- `monolog/monolog` (3.10.0): Registro de logs.

(La lista completa de paquetes instalados puede consultarse ejecutando `composer show` desde el proyecto — la salida completa fue recopilada durante el proceso.)

Salida de dependencias npm (intended devDependencies en `package.json`):

El proyecto contiene las siguientes `devDependencies` en `package.json`:

- `vite` (^8.0.0): Bundler/Dev server moderno para frontend.
- `tailwindcss` (^4.0.0): Framework CSS utilitario.
- `@tailwindcss/vite` (^4.0.0): Integración Tailwind + Vite.
- `laravel-vite-plugin` (^3.1): Plugin Vite para Laravel.
- `concurrently` (^9.0.1): Ejecutar múltiples scripts npm en paralelo.

Nota: en el momento de generar este README los módulos npm NO estaban instalados (`npm list --depth=0` devolvió `UNMET DEPENDENCY`). Para instalar ejecuta (desde WSL2):

```bash
./vendor/bin/sail npm install
```

y luego:

```bash
./vendor/bin/sail npm run build
```

## 4. ESTRUCTURA DE CARPETAS RELEVANTES (hasta 2-3 niveles)

Ruta del proyecto: `C:/Proyectos/clinica-dental` (acceder desde WSL2 en `/mnt/c/Proyectos/clinica-dental`)

- app/
  - Http/
    - Controllers/
      - Controller.php
  - Models/
  - Providers/
- bootstrap/
- config/
- database/
  - factories/
  - migrations/
  - seeders/
  - database.sqlite
- public/
  - index.php
  - favicon.ico
  - .htaccess
- resources/
  - views/
    - welcome.blade.php
  - js/
  - css/
- routes/
  - web.php
  - console.php
- storage/
- vendor/

## Notas finales y próximos pasos sugeridos

- Levantar Sail desde WSL2 (`Ubuntu`) y verificar que el servicio MySQL esté `healthy`.
- Ejecutar `./vendor/bin/sail composer require laravel/breeze --dev` y luego `./vendor/bin/sail artisan breeze:install` para instalar Breeze (Blade) cuando quieras seguir con la instalación de la interfaz de autenticación.
- Instalar dependencias npm dentro del contenedor y compilar assets (`./vendor/bin/sail npm install` y `./vendor/bin/sail npm run build`).

Si querés, ahora puedo:
- Ejecutar `./vendor/bin/sail up -d` desde WSL2 y continuar con la instalación de Breeze, o
- Esperar a que confirmes y te voy guiando paso a paso.

---
Generado automáticamente: estado recopilado desde `C:/Proyectos/clinica-dental` el 2026-06-13.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
