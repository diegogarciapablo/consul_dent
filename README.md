# ConsulDent — Sistema de Gestión de Clínica Dental

Sistema web para gestión de citas, pacientes y dentistas, desarrollado con **Laravel 11 + Laravel Sail (Docker)**.

---

## Requisitos previos

Antes de comenzar, asegurate de tener instalado en tu máquina:

- Windows 10/11 con WSL2 habilitado
- Ubuntu instalado desde la Microsoft Store (distro recomendada)
- [Docker Desktop para Windows](https://www.docker.com/products/docker-desktop/)
- Visual Studio Code con la extensión **Remote - WSL** instalada
- Git (incluido en Ubuntu por defecto)

> ⚠️ **IMPORTANTE:** TODOS los comandos de este proyecto deben ejecutarse desde **WSL2 Ubuntu**, NUNCA desde PowerShell, CMD ni Git Bash nativo. Sail no funciona en entornos MINGW.

---

## Configuración de Docker Desktop

1. Abrí Docker Desktop
2. Andá a **Settings → Resources → WSL Integration**
3. Habilitá la integración para tu distro Ubuntu
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

> ⚠️ Es **OBLIGATORIO** clonar dentro de `~/proyectos/` (filesystem de Linux), **NO** en `/mnt/c/`. Clonar en la ruta de Windows causa que el proyecto cargue extremadamente lento y genera errores de permisos.

### 3. Instalá las extensiones de PHP necesarias

Laravel 11 requiere varias extensiones de PHP que no vienen instaladas por defecto en Ubuntu. Ejecutá:

```bash
sudo apt update && sudo apt install php php-cli php-mbstring php-xml php-dom php-curl php-zip unzip curl -y
```

> ⚠️ **Observación importante:** Si omitís este paso y corrés `composer install` directamente, obtendrás errores como `ext-dom missing` y `ext-xml missing`. El paquete `php8.x-xml` resuelve ambas extensiones a la vez.

### 4. Instalá Composer (si no lo tenés)

Verificá si ya está instalado:

```bash
composer --version
```

Si dice `command not found`, instalalo:

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 5. Instalá las dependencias de PHP

```bash
composer install
```

> ⚠️ Si obtenés el error `Failed to open stream: vendor/autoload.php` al correr comandos artisan, es porque saltaste este paso. La carpeta `vendor/` no existe hasta que corrés `composer install`.

### 6. Configurá el archivo de entorno

Primero generá el `.env` a partir del archivo de ejemplo:

```bash
cp .env.example .env
```

Luego abrilo con el editor de texto:

```bash
nano .env
```

> 📋 **En este punto pedile a otro desarrollador del equipo que te envíe el contenido de su `.env`**, ya que contiene las credenciales reales del proyecto (base de datos, clave de app, etc.) que no se incluyen en el repositorio.

Una vez que tengas el contenido:

1. Seleccioná todo el texto en `nano` con `Ctrl+K` repetidamente hasta borrar todo
2. Pegá el contenido recibido del compañero con clic derecho → Pegar (o `Shift+Insert` en algunas terminales)
3. Guardá con `Ctrl+O` y presioná `Enter`
4. Salí con `Ctrl+X`

> ⚠️ **`DB_HOST` debe ser `mysql`** (nombre del contenedor Docker), nunca `127.0.0.1`. Si el `.env` del compañero tiene `127.0.0.1`, cambialo a `mysql` antes de guardar, de lo contrario obtendrás el error `Host mysql not found`.

### 7. Generá la clave de la aplicación (solo si `APP_KEY` está vacío)

Verificá primero si ya tiene clave:

```bash
grep APP_KEY .env
```

- Si ves `APP_KEY=base64:xxxxx...` → **no hace falta generarla**, ya viene del equipo.
- Si ves `APP_KEY=` vacío → generala:

```bash
php artisan key:generate
```

### 8. Levantá los contenedores con Sail

```bash
./vendor/bin/sail up -d
```

Esto levanta dos contenedores:

- `consul_dent-laravel.test-1` — Aplicación Laravel (PHP)
- `consul_dent-mysql-1` — Base de datos MySQL 8.4

Verificá que ambos aparezcan como **Running** en Docker Desktop → Containers.

> ⚠️ Si al levantar Sail ves warnings como `The "DB_PASSWORD" variable is not set`, revisá que el `.env` tenga todas las variables de base de datos completas. Bajá y volvé a levantar los contenedores después de corregirlo:
> ```bash
> ./vendor/bin/sail down
> ./vendor/bin/sail up -d
> ```

### 9. Creá el usuario y base de datos en MySQL

> ⚠️ **Paso adicional necesario la primera vez.** El contenedor MySQL arranca sin el usuario `sail` ni la base de datos `clinica_dental`. Si los omitís, obtendrás el error `Access denied for user 'sail'`.

Entrá al contenedor MySQL como root (presioná Enter cuando pida contraseña):

```bash
docker exec -it consul_dent-mysql-1 mysql -u root -p
```

Ejecutá estos comandos dentro del prompt de MySQL:

```sql
CREATE DATABASE IF NOT EXISTS clinica_dental;
CREATE USER IF NOT EXISTS 'sail'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON clinica_dental.* TO 'sail'@'%';
FLUSH PRIVILEGES;
EXIT;
```

### 10. Instalá dependencias JavaScript y compilá assets

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

### 11. Creá las tablas y cargá los datos de prueba

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

Esto crea todas las tablas y carga los datos iniciales automáticamente.

### 12. Abrí el proyecto en VS Code

```bash
code .
```

Cuando VS Code pregunte si confiás en el host `wsl.localhost`, marcá **"Permanently allow"** y hacé clic en Allow.

---

## Acceder al sistema

Abrí tu navegador y entrá a:

```
http://localhost
```

> ⚠️ Usá siempre `http://localhost`, **NUNCA** `http://127.0.0.1:8000`. Esa URL corresponde a `php artisan serve` que no funciona con Sail.

> ⚠️ **Si ves la página "Apache2 Default Page" en lugar del sistema**, es porque Apache está instalado en tu WSL2 y ocupa el puerto 80. Deshabilitalo con:
> ```bash
> sudo systemctl stop apache2
> sudo systemctl disable apache2
> ```
> Luego volvé a intentar `http://localhost`.

---

## Usuarios de prueba

Tras ejecutar el seeder, los usuarios disponibles son:

| Rol | Email | Password |
|-----|-------|----------|
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
|------------|---------|-----|
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
|-----|--------|----------|
| Admin | Gestión total: tratamientos, dentistas, pacientes, citas, pagos | `/admin/*` |
| Dentista | Su agenda y horarios de disponibilidad | `/dentista/*` |
| Paciente | Reservar y ver sus citas | `/paciente/*` |

---

## Solución de problemas frecuentes

**El sitio carga muy lento**
→ Asegurate de que el proyecto esté en `~/proyectos/` y NO en `/mnt/c/`. Moverlo al filesystem de Linux resuelve el problema.

**Error: `Failed to open stream: vendor/autoload.php`**
→ No corriste `composer install`. Ejecutalo antes de cualquier comando artisan.

**Error al instalar dependencias: `ext-dom missing` / `ext-xml missing`**
→ Instalá las extensiones faltantes:
```bash
sudo apt install php8.5-xml php8.5-dom php8.5-curl php8.5-mbstring php8.5-zip -y
```

**Warnings: `The "DB_PASSWORD" variable is not set`**
→ El `.env` tiene variables de base de datos vacías. Completalas y reiniciá los contenedores con `sail down && sail up -d`.

**Error: `Access denied for user 'sail'@'...'`**
→ El usuario MySQL no existe todavía. Seguí el paso 9 de esta guía para crearlo manualmente via `docker exec`.

**Error: `Host mysql not found`**
→ Estás usando `php artisan serve` en lugar de Sail, o `DB_HOST` está seteado como `127.0.0.1`. Usá siempre `./vendor/bin/sail up -d` y verificá que `DB_HOST=mysql` en el `.env`.

**Error 403 al intentar acceder a una sección**
→ El usuario con el que estás logueado no tiene el rol correcto para esa URL. Cerrá sesión y logueate con el usuario adecuado.

**Los contenedores no levantan**
→ Verificá que Docker Desktop esté corriendo y que WSL Integration esté habilitada para Ubuntu.

**Error al correr migrate**
→ Asegurate de que los contenedores estén corriendo (`./vendor/bin/sail up -d`) y de que el usuario y base de datos MySQL existan (paso 9) antes de correr comandos artisan.

**Aparece la página "Apache2 Default Page" en `http://localhost`**
→ Apache2 está instalado en WSL2 y ocupa el puerto 80. Deshabilitalo:
```bash
sudo systemctl stop apache2
sudo systemctl disable apache2
```