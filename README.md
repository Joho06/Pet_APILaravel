# 🐶 API de Personas y Mascotas con JWT (Laravel 11)

Este proyecto es una API RESTful desarrollada con Laravel 11 que permite gestionar personas y sus mascotas. Implementa autenticación JWT, validaciones robustas, políticas de autorización, consumo de API externa (TheDogAPI / TheCatAPI), y arquitectura limpia con Services y Repositories.

---

## 🚀 Instalación y Ejecución

1. **Clonar el repositorio**
git clone https://github.com/tu-usuario/mascotas-api.git
cd mascotas-api

2. **Clonar el repositorio**
composer install

3. **Copiar archivo .env y generar claves**
cp .env.example .env
php artisan key:generate

4. **Configurar base de datos en .env**
DB_DATABASE=PetLaravel
DB_USERNAME=root
DB_PASSWORD=

5. **Migrar y poblar la base de datos**
php artisan migrate --seed

6. **Instalar JWT y publicar configuración**
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret

7. **Levantar el servidor laravle**
php artisan serve

**Autenticación JWT**
Usa tokens JWT para acceder a las rutas protegidas. Se requiere autenticación en todos los endpoints salvo login y registro.

**Endpoints**
Método	Endpoint	Descripción
POST	/api/register	Registrar nuevo usuario
POST	/api/login	Obtener token JWT
GET	/api/user	Datos del usuario autenticado

**Mascotas**
Todas las rutas están protegidas con JWT.

Método	Endpoint	Descripción
GET	/api/mascotas	Listar todas las mascotas
POST	/api/mascotas	Crear mascota (con datos externos)
GET	/api/mascotas/{id}	Ver detalles de una mascota
PUT	/api/mascotas/{id}	Actualizar mascota (solo si es del user)
DELETE	/api/mascotas/{id}	Eliminar mascota (solo si es del user)

**Usuarios y Mascotas**
Método	Endpoint	Descripción
GET	/api/users/{id}/with-pets	Ver persona y todas sus mascotas

**Usuario de Prueba**
Puedes usar este usuario de prueba para iniciar sesión:

Email: javier@example.com
Password: 123456

**Consideraciones a tomar **
Arquitectura basada en principios SOLID: controladores delgados, uso de Services y Repositories.

Validaciones centralizadas en Form Requests.

Respuestas estandarizadas con Laravel API Resources.

Errores manejados de forma global con códigos HTTP apropiados.

Listados paginados automáticamente (?page=1, ?per_page=10).

El proyecto está preparado para extender con otros módulos como mascotas, políticas, Swagger, testing y más.
