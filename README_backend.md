# Backend-2025-T3 - Sebastián Cabezas

Identificación: Valeria Castro Comte
                Andrés Vergara Silva

Instrucciones de Despliegue (Clave): Pasos exactos para levantar el proyecto en XAMPP.

a. "Copiar la carpeta del proyecto dentro de C:\xampp\htdocs\".
b. "Iniciar los servicios de Apache y MySQL en XAMPP".
c. Crear base de datos llamada "creatuwebs" en phpMyAdmin (http://localhost/phpmyadmin).
d. importar script creatuwebs.sql en la base de dato creatuwebs.
e. Crear usuario con el siguiente comando: 

    CREATE USER 'prored'@'localhost' IDENTIFIED BY 'prored_b4ck3nd';
    GRANT ALL PRIVILEGES ON `prored`. * TO 'prored'@'localhost';
    FLUSH PRIVILEGES;

f. Los datos de conección son:

        host = '127.0.0.1'; // localhost
        port = 3306;
        db = 'prored';
        username = 'prored';
        password = 'prored_b4ck3nd';

g. "La URL base de la API es: http://localhost/ipss/api/v1/"

Colección de Postman:

En la carpeta IPSS esta el json ("ipss.postman_collection") con todas las rutas solicitadas (GET, POST, PUT, PATCH, DELETE) y la autenticación Bearer Token configurada.
    
pass : Bearer ipss.2025.T3


## Configuracion sin el archivo ProREP.sql

CREATE DATABASE prored; 

////////////////////////////////////
DROP USER 'prored'@'localhost';

DROP TABLE IF EXISTS empresaTipo;
DROP TABLE IF EXISTS empresa;

CREATE USER 'prored'@'localhost' IDENTIFIED BY 'prored_b4ck3nd';
GRANT ALL PRIVILEGES ON `prored`. * TO 'prored'@'localhost';
FLUSH PRIVILEGES;

//////////////////////////////////////

CREATE TABLE empresaTipo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    codigo VARCHAR(2) NOT NULL UNIQUE,
    icono_fa VARCHAR(50),
    color_tw VARCHAR(30),
    color_css VARCHAR(30),
    activo INT NOT NULL
);

INSERT INTO empresaTipo (id, nombre, codigo, icono_fa, color_tw, color_css, activo) VALUES
(1,'Reciclador de Base','R', 'fa fa-recycle', 'bg-green-100', 'rgb(220,252,231)',1),
(2, 'Valorizador', 'V', 'fa-industry', 'bg-blue-100', '#eff6ff', 1),
(3, 'Consultor', 'C', 'fa-user-tie', 'bg-gray-100', '#f3f4f6', 1),
(4, 'Transportista', 'T', 'fa-truck', 'bg-yellow-100', 'rgb(254 249 195)', 1),
(5, 'Gestor Integral', 'G', 'fa-globe-americas', 'bg-purple-100', 'rgb(243, 232, 255)', 1);

CREATE TABLE empresa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    empresaTipo_id INT NOT NULL,
    activo INT NOT NULL,
    FOREIGN KEY (empresaTipo_id) REFERENCES empresaTipo(id)
);

INSERT INTO empresa (id, nombre, empresaTipo_id, activo) VALUES
(1,'Reciclajes Santiago Ltda.',1,1),
(2, 'Consultora financiera Ltda.', 2, 1),
(3, 'Consultores Asociados S.A.', 3, 1),
(4, 'Transporte Express Ltda.', 4, 1),
(5, 'Gestor Integral Chile S.A.', 5, 1);


## ESTRUCTURA DE CADA ENDPOINT ##

## GET en Gestores ##
Endponit: GET /api/v1/gestores
parametro: Ninguno
Respuesta: 
{
    "mensaje": "OK",
    "data": {
      "id": 1,
      "nombre": "Reciclajes Santiago Ltda.",
      "empresa_tipo": {
        "id": 1,
        "nombre": "Reciclador de Base",
        "codigo": "R",
        "icono": {
          "FontAwesome": "fa-recycle"
        },
        "color": {
          "Tailwind": "bg-green-100",
          "css": "rgb(220 252 231)"
        }
      },
      "activo": true
    }
}
Códigos HTTP: 
200 OK
404 Not Found
401 Unauthorized


## GET en Gestores por ID ##
Endponit: GET /api/v1/gestores?id=1
parametro: ID requerido
Respuesta: 
{
    "mensaje": "OK",
    "data": {
    
      "id": 1,
      "nombre": "Reciclajes Santiago Ltda.",
      "empresa_tipo": {
        "id": 1,
        "nombre": "Reciclador de Base",
        "codigo": "R",
        "icono": {
          "FontAwesome": "fa-recycle"
        },
        "color": {
          "Tailwind": "bg-green-100",
          "css": "rgb(220 252 231)"
        }
      },
      "activo": true
    }
}

Códigos HTTP:
200 OK
404 Not Found
401 Unauthorized


## POST en Gestores ##
Endponit: POST /api/v1/gestores
Body: {
  "nombre": "Reciclajes Santiago Ltda.",
  "empresa_tipo": {
    "id": 1
  }
}
Respuesta:
{
    "mensaje": "OK",
    "data": "Creado correctamente"
}
Códigos HTTP:
200 OK
409 Duplicado
500 Error interno del servidor
401 Sin autorizacion



## PUT en Gestores ##
Endponit: PUT /api/v1/gestores
Body:{
  "nombre": "Reciclajes Santiago Ltda.",
  "empresa_tipo": {
    "id": 2
  },
  "activo": true
}
Respuesta:
{
    "mensaje": "OK",
    "data": "Actualizado correctamente"
}
Códigos HTTP:
200 OK
404 Not Found
401 Sin autorizacion


## DELETE en Gestores ##
Endponit: DELETE /api/v1/gestores?id=1
Body: Ninguno
Respuesta:
{
    "mensaje": "OK",
    "data": "Deshabilitado correctamente"
}
Códigos HTTP:
200 OK
404 Not Found
500 Error interno del servidor
401 Sin autorizacion


## PATCH en Gestores ##
Endponit: PATCH /api/v1/gestores?id=1
Body: Ninguno
Respuesta:
{
    "mensaje": "OK",
    "data": "Habilitado correctamente"
}
Códigos HTTP:
200 OK
401 Sin autorizacion
500 Error interno del servidor
401 Sin autorizacion


## EmpresaTipo ##

## GET en EmpresaTipo ##
Endponit: GET /api/v1/empresaTipo
parametro: Ninguno
Respuesta: 
{
    "mensaje": "OK",
    "data": {
    "id": 1,
    "nombre": "Reciclajes Santiago Ltda.",
    "empresa_tipo": {
        "id": 7,
        "nombre": "Reciclador de Bas2e",
        "codigo": "R1",
        "icono": {
            "FontAwesome": "fa-recycle"
        },
        "color": {
            "Tailwind": "bg-green-100",
            "css": "rgb(220 252 231)"
        }
    },
    "activo": false
}
}
Códigos HTTP: 
200 OK
404 Not Found
401 Unauthorized


## GET en EmpresaTipo por ID ##
Endponit: GET /api/v1/empresaTipo?id=1
parametro: ID requerido
Respuesta: 
{
    "mensaje": "OK",
    "data": {
    "id": 1,
    "nombre": "Reciclajes Santiago Ltda.",
    "empresa_tipo": {
        "id": 7,
        "nombre": "Reciclador de Bas2e",
        "codigo": "R1",
        "icono": {
            "FontAwesome": "fa-recycle"
        },
        "color": {
            "Tailwind": "bg-green-100",
            "css": "rgb(220 252 231)"
        }
    },
    "activo": false
}
}
Códigos HTTP:
200 OK
404 Not Found
401 Unauthorized


## POST en EmpresaTipo ##
Endponit: POST /api/v1/empresaTipo
Body: {
  "nombre": "Reciclador de Bas2e",
  "codigo": "R1",
  "icono": {
    "FontAwesome": "fa-recycle"
  },
  "color": {
    "Tailwind": "bg-green-100",
    "css": "rgb(220 252 231)"
  }
}
Respuesta:
{
    "mensaje": "OK",
    "data": "Creado correctamente"
}
Códigos HTTP:
200 OK
409 Duplicado
500 Error interno del servidor
401 Sin autorizacion


## PUT en EmpresaTipo ##
Endponit: PUT /api/v1/empresaTipo
Body:{
    "id": 1,
    "nombre": "Reciclador de Base",
    "codigo": "R",
    "icono": {
        "FontAwesome": "fa-recycle11"
    },
    "color": {
        "Tailwind": "bg-green123123123-100",
        "css": "rgb(220 252 231)"
    }
}
Respuesta:
{
    "mensaje": "OK",
    "data": "Actualizado correctamente"
}
Códigos HTTP:
200 OK
404 Not Found
401 Sin autorizacion


## DELETE en EmpresaTipo ##
Endponit: DELETE /api/v1/empresaTipo?id=1
Body: Ninguno
Respuesta:
{
    "mensaje": "OK",
    "data": "Deshabilitado correctamente"
}
Códigos HTTP:
200 OK
400 Bad Request
500 Error interno del servidor
401 Sin autorizacion


## PATCH en EmpresaTipo ##
Endponit: PATCH /api/v1/empresaTipo?id=1
Body: Ninguno
Respuesta:
{
    "mensaje": "OK",
    "data": "Habilitado correctamente"
}
Códigos HTTP:
200 OK
400 Bad Request
500 Error interno del servidor
401 Sin autorizacion





///////////////////
En caso que xamp msql se rompa:
    ingresar a xamp/msql
    renombrar data a data_old
    copiar carpeta backup y nombrarla data
    en la carpeta data_old, copiar ibdata1 , ib_logfile1, ib_logfile0 y las carpetas de las base de datos
    copiarlas y pegarlas en data
    finalmente, crear denuevo el usuario

    CREATE USER 'creatuwebs'@'localhost' IDENTIFIED BY 'creatuwebs_b4ck3nd';
GRANT ALL PRIVILEGES ON `creatuwebs`. * TO 'creatuwebs'@'localhost';
FLUSH PRIVILEGES;