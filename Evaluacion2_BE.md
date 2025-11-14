# Evaluación de Backend: API RESTful con PHP Nativo (CRUD) 🛠️

## Resultados de Aprendizaje de la Unidad:
1.  **Construye un servicio API**, incluyendo su estructura y patrones de diseño.
2.  **Implementa la lógica de negocio y persistencia de datos** utilizando PHP nativo, interactuando de forma segura con una base de datos.

---

## En esta Situación Evaluativa, se espera evidenciar que los estudiantes (Indicadores de Logro):

| RA | ID | Indicador de Logro | Énfasis en el Proyecto |
| :---: | :---: | :--- | :--- |
| 1 | 1.1 | Diseña API de manera funcional y cumpliendo especificaciones. | Diseña los *endpoints* CRUD para los recursos `Menu` y `Novios`. |
| 1 | 1.2 | Integra API... funcional de acuerdo al diseño. | La API responde correctamente a las peticiones del *frontend* (E2). |
| 1 | 1.3 | Mantiene API... disponible y funcione sin errores. | La API maneja errores y códigos de estado HTTP correctamente. |
| 1 | 1.4 | Actualiza API... procurando compatibilidad. | Implementa **Soft Delete** (DELETE) y **Patch** (PATCH) sin romper la lógica. |
| 2 | 2.1 | Desarrolla el servicio web RESTful... **CRUD**... | Implementa **GET, POST, PUT, PATCH, DELETE** usando **PHP Nativo**. |
| 2 | 2.2 | Implementa APIs... documentadas de forma clara. | Proporciona una colección de Postman y un `README.md` claro. |
| 2 | 2.3 | Gestiona datos en la base de datos... **CRUD**... | Utiliza **PDO (PHP Data Objects)** para todas las operaciones de BD (previene Inyección SQL). |
| 2 | 2.4 | Realiza pruebas... de integración y... rendimiento. | Demuestra el funcionamiento de todos los *endpoints* vía Postman (Video). |

---

## Características de la Evaluación

* **Modalidad:** Actividad calificada de desarrollo extendida (Sumativa).
* **Carácter:** Grupal (máximo 2 integrantes).
* **Propósito:** Evolucionar la API de Matrimonios (hecha en PHP puro) para soportar operaciones CRUD completas, implementando lógica de negocio avanzada.
* **Puntaje:** 100 puntos.
* **Rúbrica:** Revise la rúbrica detallada disponible en plataforma.

---

## Instrucciones: Evolución del "Proyecto Matrimonios" (API Nativa)

En la evaluación de *backend* anterior (con PHP puro), se crearon los *endpoints* de **lectura (GET)**. En esta evaluación, deberán **expandir** esa API para implementar la **gestión completa de datos (CRUD)**.

El objetivo es que esta API sirva como el *backend* definitivo para la aplicación *frontend* "Proyecto Matrimonios", **sin utilizar ningún framework**.

### 1. Requisitos de Implementación
* **Lenguaje:** Es **obligatorio** el uso de **PHP Nativo (Puro)**. No se permite el uso de *frameworks* (como Laravel, Symfony, etc.) ni de *Micro-frameworks*.
* **Base de Datos:** Deben utilizar la misma estructura de BD de la evaluación anterior (MySQL/MariaDB).
* **Conexión a BD:** Es **obligatorio** el uso de **PDO (PHP Data Objects)** para todas las consultas a la base de datos, utilizando consultas preparadas (`prepare`) para prevenir inyección SQL.
* **Autenticación:** Todas las rutas (excepto las de lectura pública si se define) deben estar protegidas. El *token* estático de autorización es:
    * **Header:** `Authorization`
    * **Valor:** `Bearer ipss.2025.T3`

### 2. Nuevos Requisitos de Endpoints (CRUD) 🔄
Además de mantener los *endpoints* **GET** de la evaluación anterior, ahora deben implementar la gestión completa para los recursos.

**Lógica de Negocio Específica:**
* **`PATCH`**: Se usará **exclusivamente** para **habilitar** un recurso (ej. cambiar `activo: true`).
* **`DELETE`**: No borrará físicamente el registro (Hard Delete). Implementará un **Soft Delete**, lo que significa que **deshabilitará** el recurso (ej. cambiar `activo: false`).

---

#### Recurso: `api/v1/menu/`
* `GET /api/v1/menu/`
    * **Acción:** Listar todos los ítems del menú.
* `GET /api/v1/menu/{id}`
    * **Acción:** Obtener un ítem específico del menú.
* `POST /api/v1/menu/`
    * **Acción:** Crear un nuevo ítem de menú.
    * **Body (JSON):** `{ "nombre": "Nuevo Link", "link": "#nuevo", "activo": true }`
* `PUT /api/v1/menu/{id}`
    * **Acción:** Actualizar **completamente** un ítem de menú.
    * **Body (JSON):** `{ "nombre": "Link Editado", "link": "#editado", "activo": true }`
* `PATCH /api/v1/menu/{id}`
    * **Acción:** **Habilitar** un ítem de menú.
    * **Lógica:** Debe ejecutar `UPDATE menu SET activo = 1 WHERE id = {id}`.
* `DELETE /api/v1/menu/{id}`
    * **Acción:** **Deshabilitar** (Soft Delete) un ítem de menú.
    * **Lógica:** Debe ejecutar `UPDATE menu SET activo = 0 WHERE id = {id}`.

---

#### Recurso: `api/v1/novios/` (Nuevo Recurso CRUD)
Para gestionar la información de la sección "Petición de Mano", crearán *endpoints* para el recurso `novio`. (Se asume que la tabla `novio` tiene un campo `activo` de tipo booleano).

* `GET /api/v1/novios/{id}`
    * **Acción:** Obtener los detalles de un novio/a específico.
* `POST /api/v1/novios/`
    * **Acción:** Crear un nuevo perfil de novio/a.
    * **Body (JSON):** `{ "boda_id": 123, "apodo": "Alex", "nombre": "Alex Smith", "tipo_novio_id": 1, "descripcion": "...", "activo": true }`
* `PUT /api/v1/novios/{id}`
    * **Acción:** Actualizar **completamente** el perfil de un novio/a.
    * **Body (JSON):** `{ "boda_id": 123, "apodo": "Alex B.", "nombre": "Alex B. Smith", "tipo_novio_id": 1, "descripcion": "Nueva desc.", "activo": true }`
* `PATCH /api/v1/novios/{id}`
    * **Acción:** **Habilitar** el perfil de un novio/a.
    * **Lógica:** `UPDATE novio SET activo = 1 WHERE id = {id}`.
* `DELETE /api/v1/novios/{id}`
    * **Acción:** **Deshabilitar** (Soft Delete) el perfil de un novio/a.
    * **Lógica:** `UPDATE novio SET activo = 0 WHERE id = {id}`.

---

## 💻 Tecnologías Utilizadas

* **Lenguaje:** **PHP Nativo (Puro)** (versión 7.4 o superior).
* **Base de Datos:** MySQL / MariaDB.
* **Conexión:** **PDO (PHP Data Objects) - (Obligatorio)**.
* **Servidor:** **XAMPP** / MAMP / LAMP (o similar).

## 📦 Requisitos de Entrega

La entrega debe ser un archivo comprimido (.zip) que contenga 3 elementos:

1.  **Código Fuente (100%):**
    * Todos los archivos `.php` con la implementación de la API.
    * El código debe estar organizado (ej. `api/v1/menu.php`, `api/v1/novios.php`, `config/database.php`).

2.  **Documentación (`README.md`):**
    * **Identificación:** Nombres y apellidos de los integrantes.
    * **Instrucciones de Despliegue (Clave):** Pasos exactos para levantar el proyecto en **XAMPP**.
        * Ejemplo:
            1.  "Copiar la carpeta del proyecto dentro de `C:\xampp\htdocs\`".
            2.  "Iniciar los servicios de Apache y MySQL en XAMPP".
            3.  "Importar el script `boda_db.sql` en phpMyAdmin (http://localhost/phpmyadmin)".
            4.  "La URL base de la API es: `http://localhost/nombre_proyecto/api/v1/`".
    * **Colección de Postman:**
        * El archivo de exportación de la colección de **Postman** (`.json`) con todas las rutas (GET, POST, PUT, PATCH, DELETE) y la autenticación `Bearer Token` configurada.

3.  **Evidencia en Video (Obligatorio) 📹:**
    * Un archivo de video (`.mp4`, `.webm`) de **máximo 5 minutos**.
    * En el video deben **demostrar el funcionamiento en Postman** de **TODOS** los *endpoints* CRUD de un recurso (ej. `menu`).
    * Deben mostrar:
        * **POST:** Creando un nuevo recurso (mostrar el *body* JSON).
        * **PUT:** Actualizando el recurso creado.
        * **PATCH:** Habilitando un recurso.
        * **DELETE:** Deshabilitando (Soft Delete) un recurso.
        * **Base de Datos:** Mostrar (brevemente) cómo los cambios se reflejan en la tabla de la base de datos (ej. el `activo` cambiando de `1` a `0`).
