# Backend-2025-T3
Backend 2025 T3. Sebastián Cabezas Ríos

CREATE DATABASE creatuwebs; 

CREATE TABLE menu(
    id  INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(6) NOT NULL,
    link VARCHAR(20) NOT NULL UNIQUE,
    activo BOOLEAN NOT NULL DEFAULT FALSE
); 

INSERT INTO menu ( nombre, link, activo)
VALUES ('Inicio', '#home', TRUE);

INSERT INTO menu ( nombre, link, activo)
VALUES ('Portafolio', '#portafolio', TRUE);

INSERT INTO menu ( nombre, link, activo)
VALUES ('Servicios', '#servicios', TRUE);

INSERT INTO menu ( nombre, link, activo)
VALUES ('FAQ', 'https://creatuwebs.com/faq', TRUE);

INSERT INTO menu ( nombre, link, activo)
VALUES ('Contactanos', 'https://creatuwebs.com/contactanos', TRUE);


////////////////////////////////////

CREATE USER 'creatuwebs'@'localhost' IDENTIFIED BY 'creatuwebs_b4ck3nd';
GRANT ALL PRIVILEGES ON 'creatuwebs'. * TO 'creatuwebs'@'localhost';
FLUSH PRIVILEGES;

//////////////////////////////////////

CREATE TABLE menu(
    id  INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(6) NOT NULL,
    link VARCHAR(20) NOT NULL UNIQUE,
    activo BOOLEAN NOT NULL DEFAULT FALSE
); 


//! portafolio
$respuesta = [
                [
                    "id" => 1,
                    "titulo" => "Diseño web a medida para tu negocio",
                    "subtitulo" => "Creamos sitios web atractivos y funcionales que impulsan tu marca y atraen a tus clientes.",
                    "Boton" => [
                        "texto" => "Ver Planes",
                        "link" => "#servicios"
                    ],
                    "imagen" => "https://creatuwebs.com/img/hero/img_1.jpg",
                    "activo" => true
                ],
                [
                    "id" => 2,
                    "titulo" => "Impulsa tu presencia online",
                    "subtitulo" => "Transforma tu idea en una web moderna, rápida y optimizada para todos los dispositivos.",
                    "Boton" => [
                        "texto" => "Contactanos",
                        "link" => "https://creatuwebs.com/contactanos"
                    ],
                    "imagen" => "https://creatuwebs.com/img/hero/img_2.jpg",
                    "activo" => true
                ],
                [
                    "id" => 3,
                    "titulo" => "Webs profesionales para tu negocio",
                    "subtitulo" => "Diseños personalizados que reflejan la esencia de tu marca y generan confianza.",
                    "Boton" => [
                        "texto" => "Ver Ejemplos",
                        "link" => "#portafolio"
                    ],
                    "imagen" => "https://creatuwebs.com/img/hero/img_3.jpg",
                    "activo" => true
                ]
            ];

//! servicios
$respuesta = [
                [
                    "id" => 1,
                    "titulo" => "Página Web Básica",
                    "precio" => "$59.990",
                    "Boton" => [
                        "texto" => "Seleccionar",
                        "link" => "https://creatuwebs.com/contactanos"
                    ],
                    "texto" => "
                    ✅ Diseño personalizado
                    ✅ Hasta 4 páginas
                    ✅ 5 Correos Corporativos
                    ✅ Diseño Responsive
                    ✅ Alta en Buscadores
                    ✅ Dominio y hosting (1 año)
                    ✅ Botón Redes Sociales
                    ✅ Certificado SSL
                    ✅ Soporte básico
                    ✅ Botón Contacto Whatsapp
                    ✅ Mapa Ubicación Google Maps
                    ✅ Capacitación
                    ",
                    "activo" => true
                ],
                [
                    "id" => 2,
                    "titulo" => "Página Web Autoadministrable",
                    "precio" => "$109.990",
                    "Boton" => [
                        "texto" => "Seleccionar",
                        "link" => "https://creatuwebs.com/contactanos"
                    ],
                    "texto" => "
                    ✅ Diseño personalizado
                    ✅ Hasta 10 páginas
                    ✅ 10 Correos Corporativos
                    ✅ Diseño Responsive
                    ✅ Alta en Buscadores
                    ✅ Dominio y hosting (1 año)
                    ✅ Botón Redes Sociales
                    ✅ Certificado SSL
                    ✅ Soporte básico
                    ✅ Botón Contacto Whatsapp
                    ✅ Mapa Ubicación Google Maps
                    ✅ Posicionamiento Google (SEO)
                    ✅ Sitio Autoadministrable
                    ✅ Formulario de Contacto
                    ✅ Crear Textos e imágenes
                    ✅ Capacitación
                    ",
                    "activo" => true
                ]
            ];

//! hero
$respuesta = [
                [
                    "id" => 1,
                    "titulo" => "Diseño web a medida para tu negocio",
                    "subtitulo" => "Creamos sitios web atractivos y funcionales que impulsan tu marca y atraen a tus clientes.",
                    "Boton" => [
                        "texto" => "Ver Planes",
                        "link" => "#servicios"
                    ],
                    "imagen" => "https://creatuwebs.com/img/hero/img_1.jpg",
                    "activo" => true
                ],
                [
                    "id" => 2,
                    "titulo" => "Impulsa tu presencia online",
                    "subtitulo" => "Transforma tu idea en una web moderna, rápida y optimizada para todos los dispositivos.",
                    "Boton" => [
                        "texto" => "Contactanos",
                        "link" => "https://creatuwebs.com/contactanos"
                    ],
                    "imagen" => "https://creatuwebs.com/img/hero/img_2.jpg",
                    "activo" => true
                ],
                [
                    "id" => 3,
                    "titulo" => "Webs profesionales para tu negocio",
                    "subtitulo" => "Diseños personalizados que reflejan la esencia de tu marca y generan confianza.",
                    "Boton" => [
                        "texto" => "Ver Ejemplos",
                        "link" => "#portafolio"
                    ],
                    "imagen" => "https://creatuwebs.com/img/hero/img_3.jpg",
                    "activo" => true
                ]
            ];