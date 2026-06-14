 # ConsulDent — Sistema de Gestión de Clínica Dental

 Sistema web para gestión de citas, pacientes y dentistas, desarrollado con Laravel 11 + Laravel Sail (Docker).

 ---

 ## Requisitos previos

 Antes de comenzar, asegurate de tener instalado en tu máquina:

 - **Windows 10/11** con **WSL2** habilitado
 - **Ubuntu** instalado desde la Microsoft Store (distro recomendada)
 - **Docker Desktop** para Windows — [descargar aquí](https://www.docker.com/products/docker-desktop/)
 - **Visual Studio Code** con la extensión **Remote - WSL** instalada
 - **Git** (incluido en Ubuntu por defecto)

 > ⚠️ IMPORTANTE: TODOS los comandos de este proyecto deben ejecutarse desde WSL2 Ubuntu, NUNCA desde PowerShell, CMD ni Git Bash nativo. Sail no funciona en entornos MINGW.

 ---

 ## Configuración de Docker Desktop

 1. Abrí Docker Desktop
 2. Andá a **Settings → Resources → WSL Integration**
 3. Habilitá la integración para tu distro **Ubuntu**
 4. Hacé clic en **Apply & Restart**

 ---

 ## Instalación del proyecto

 ### 1. Abrí WSL2 Ubuntu

 Desde el menú inicio de Windows, abrí **Ubuntu**.

 ### 2. Cloná el repositorio dentro del filesystem de Linux

 ```bash
 mkdir -p ~/proyectos
 cd ~/proyectos
 git clone <URL_DEL_REPOSITORIO> consul_dent
 cd consul_dent
 ```

 > ⚠️ Es OBLIGATORIO clonar dentro de `~/proyectos/` (filesystem de Linux), NO en `/mnt/c/`. Clonar en la ruta de Windows causa que el proyecto cargue extremadamente lento.

 ### 3. Instalá las dependencias de PHP

 ```bash
 composer install
 ```

 > Si no tenés Composer instalado en WSL2:
 > ```bash
 > sudo apt update && sudo apt install php php-cli php-mbstring unzip curl
 > curl -sS https://getcomposer.org/installer | php
 > sudo mv composer.phar /usr/local/bin/composer
 > ```

 ### 4. Copiá el archivo de entorno

 ```bash
 cp .env.example .env
 ```

 ### 5. Generá la clave de la aplicación

 ```bash
 php artisan key:generate
 ```

 ### 6. Levantá los contenedores con Sail

 ```bash
 ./vendor/bin/sail up -d
 ```

 Esto levanta dos contenedores:
 - `consul_dent-laravel.test-1` — Aplicación Laravel (PHP)
 - `consul_dent-mysql-1` — Base de datos MySQL 8.4

 Verificá que ambos aparezcan como **Running** en Docker Desktop → Containers.

 ### 7. Instalá dependencias JavaScript y compilá assets

 ```bash
 ./vendor/bin/sail npm install
 ./vendor/bin/sail npm run build
 ```

 ### 8. Creá las tablas y cargá los datos de prueba

 ```bash
 ./vendor/bin/sail artisan migrate:fresh --seed
 ```

 Esto crea todas las tablas y carga los datos iniciales automáticamente.

 ### 9. Abrí el proyecto en VS Code

 ```bash
 code .
 ```

 Cuando VS Code pregunte si confiás en el host `wsl.localhost`, marcá **"Permanently allow"** y hacé clic en **Allow**.

 ---

## Acceder al sistema

Abrí tu navegador y entrá a:

http://localhost

> Usá siempre `http://localhost`, NUNCA `http://127.0.0.1:8000`. Esa URL corresponde a `php artisan serve` que no funciona con Sail.

 ---

 ## Usuarios de prueba

 Tras ejecutar el seeder, los usuarios disponibles son:

 | Rol | Email | Password |
 |---|---|---|
 | Administrador | admin@clinicadental.test | password |
 | Dentista | carlos.mendoza@clinicadental.test | password |
 | Dentista | ana.rodriguez@clinicadental.test | password |
 | Dentista | luis.fernandez@clinicadental.test | password |

 Para ver los emails de los pacientes generados automáticamente:

 ```bash
 ./vendor/bin/sail artisan tinker --execute="App\Models\User::where('role', 'paciente')->get(['name','email'])->each(fn(\$u) => print(\$u->name.' | '.\$u->email.PHP_EOL));"
 ```

 ---

 ## Comandos útiles del día a día

 ```bash
 # Levantar el proyecto
 cd ~/proyectos/consul_dent
 ./vendor/bin/sail up -d

 # Detener el proyecto
 ./vendor/bin/sail down

 # Ver logs en tiempo real
 ./vendor/bin/sail logs -f

 # Resetear base de datos con datos de prueba
 ./vendor/bin/sail artisan migrate:fresh --seed

 # Limpiar caché
 ./vendor/bin/sail artisan cache:clear
 ./vendor/bin/sail artisan config:clear
 ./vendor/bin/sail artisan route:clear

 # Ver todas las rutas
 ./vendor/bin/sail artisan route:list

 # Correr comandos artisan
 ./vendor/bin/sail artisan <comando>

 # Correr comandos npm
 ./vendor/bin/sail npm <comando>
 ```

 ---

 ## Stack tecnológico

 | Tecnología | Versión | Uso |
 |---|---|---|
 | Laravel | 11.x | Framework PHP principal |
 | Laravel Sail | — | Entorno Docker para desarrollo |
 | Laravel Breeze | — | Autenticación (Blade stack) |
 | Alpine.js | 3.x | Interactividad frontend |
 | Tailwind CSS | 3.x | Estilos |
 | MySQL | 8.4 | Base de datos |
 | PHP | 8.5 | Lenguaje backend |

 ---

 ## Estructura de roles

 | Rol | Acceso | URL base |
 |---|---|---|
 | Admin | Gestión total: tratamientos, dentistas, pacientes, citas, pagos | `/admin/*` |
 | Dentista | Su agenda y horarios de disponibilidad | `/dentista/*` |
 | Paciente | Reservar y ver sus citas | `/paciente/*` |

 ---

 ## Solución de problemas frecuentes

 **El sitio carga muy lento**
 → Asegurate de que el proyecto esté en `~/proyectos/` y NO en `/mnt/c/`. Moverlo al filesystem de Linux resuelve el problema.

 **Error: "Host mysql not found"**
 → Estás usando `php artisan serve` en lugar de Sail. Usá siempre `./vendor/bin/sail up -d` y accedé por `http://localhost`.

 **Error 403 al intentar acceder a una sección**
 → El usuario con el que estás logueado no tiene el rol correcto para esa URL. Cerrá sesión y logueate con el usuario adecuado.

 **Los contenedores no levantan**
 → Verificá que Docker Desktop esté corriendo y que WSL Integration esté habilitada para Ubuntu.

 **Error al correr migrate**
 → Asegurate de que los contenedores estén corriendo (`./vendor/bin/sail up -d`) antes de correr comandos artisan.
