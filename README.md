# Factoring Backend

Backend para la aplicación de Factoring, construido con **Laravel**. Se encarga de manejar la lógica de negocio, persistencia de datos, autenticación y exposición de APIs REST.

---

## Características

- API REST para operaciones de factoring.  
- Gestión de clientes y facturas.  
- Operaciones de cesión de facturas y marcado de facturas como pagadas.  
- Middleware de seguridad con API Key.  
- Migraciones y seeders para la base de datos.  

---

## Requisitos

- PHP >= 8.0  
- Composer  
- Servidor web (Apache, Nginx, o el servidor interno de Laravel)  
- Base de datos (MySQL/MariaDB, PostgreSQL, SQLite, etc.)  
- Node.js + npm/yarn (si se requieren assets o build)  

---

## Instalación

0. Clonar el proyecto
```bash
git clone https://github.com/josesotocepeda/factoring-backend.git
cd factoring-backend
composer install
```
1. Crear base de datos llamada 'financia_prueba'
2. Crear achivo .env
```bash
cp .env.example .env
```
3. Configura tu conexión a la base de datos y la API_KEY en .env
```bash
API_KEY=test_key_123

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=financia_prueba
DB_USERNAME=root
DB_PASSWORD=
```
4. Ejecuta migraciones y seeders
```bash
  php artisan migrate --seed
```

---

## Ejecución
```bash
  php artisan serve
```

La aplicación quedará disponible en:
```bash
  http://127.0.0.1:8000
```

---

## Endpoints Principales
Todos los endpoints están protegidos con el middleware api_key.

| Método | Ruta                         | Controlador/Acción             | Descripción                              |
| ------ | ---------------------------- | ------------------------------ | ---------------------------------------- |
| GET    | `/api/clients`               | `ClientController@index`       | Listar todos los clientes                |
| GET    | `/api/clients/{id}/invoices` | `ClientController@invoices`    | Listar facturas de un cliente específico |
| POST   | `/api/invoices`              | `InvoiceController@store`      | Registrar una nueva factura              |
| POST   | `/api/factoring/cede`        | `FactoringController@cede`     | Ceder una factura al factoring           |
| POST   | `/api/factoring/mark-paid`   | `FactoringController@markPaid` | Marcar una factura como pagada           |

---

## Autor
Jose Luis Soto
jose.luis.soto.cepeda@gmail.com
+569 8836 2440



