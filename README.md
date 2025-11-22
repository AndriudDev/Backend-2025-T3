# Backend-2025-T3


CREATE DATABASE creatuwebs; 

////////////////////////////////////

CREATE USER 'creatuwebs'@'localhost' IDENTIFIED BY 'creatuwebs_b4ck3nd';
GRANT ALL PRIVILEGES ON 'creatuwebs'. * TO 'creatuwebs'@'localhost';
FLUSH PRIVILEGES;

//////////////////////////////////////

CREATE TABLE menu (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    link VARCHAR(200) NOT NULL,
    orden INT NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO menu ( nombre, link, orden, activo)
VALUES ('Inicio', '#home', 0, TRUE);

INSERT INTO menu ( nombre, link, orden, activo)
VALUES ('Portafolio', '#portafolio', 1, TRUE);

INSERT INTO menu ( nombre, link, orden, activo)
VALUES ('Servicios', '#servicios', 2, TRUE);

INSERT INTO menu ( nombre, link, orden, activo)
VALUES ('FAQ', 'https://creatuwebs.com/faq', 3, TRUE);

INSERT INTO menu ( nombre, link, orden, activo)
VALUES ('Contactanos', 'https://creatuwebs.com/contactanos', 4, TRUE);


////////////////////////////////////

CREATE TABLE hero (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    subtitulo VARCHAR(500),
    texto_boton VARCHAR(50),
    link_boton VARCHAR(200),
    imagen VARCHAR(200),
    orden INT NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO hero 
(titulo, subtitulo, texto_boton, link_boton, imagen, orden, activo)
VALUES
(
    'Diseño web a medida para tu negocio',
    'Creamos sitios web atractivos y funcionales que impulsan tu marca y atraen a tus clientes.',
    'Ver Planes',
    '#servicios',
    'assets/carru_1.png',
    1,
    TRUE
),
(
    'Impulsa tu presencia online',
    'Transforma tu idea en una web moderna, rápida y optimizada para todos los dispositivos.',
    'Contáctanos',
    '#contactanos',
    'assets/carru_2.png',
    2,
    TRUE
),
(
    'Webs profesionales para tu negocio',
    'Diseños personalizados que reflejan la esencia de tu marca y generan confianza.',
    'Ver Ejemplos',
    '#portafolio',
    'assets/carru_3.png',
    3,
    TRUE
);


//////////////////////////////////////

CREATE TABLE servicio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    precio INT NOT NULL,
    descripcion VARCHAR(300),
    color_tema VARCHAR(20),
    detalles JSON,              -- aquí van las características del plan
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO servicio 
(nombre, precio, descripcion, color_tema, detalles, activo)
VALUES
(
    'Página Web Básica',
    59990,
    'Ideal para emprendedores o negocios pequeños.',
    'secondary',
    '[
        "✅Diseño personalizado",
        "✅Hasta 4 páginas",
        "✅5 Correos Corporativos",
        "✅Diseño Responsive",
        "✅Alta en Buscadores",
        "✅Dominio y hosting (1 año)",
        "✅Botón Redes Sociales",
        "✅Certificado SSL",
        "✅Soporte básico",
        "✅Botón Contacto Whatsapp",
        "✅Mapa Ubicación Google Maps",
        "✅Capacitación"
    ]',
    TRUE
),
(
    'Página Web Autoadministrable',
    109990,
    'Incluye panel para editar contenidos sin conocimientos técnicos.',
    'primary',
    '[
        "✅Diseño personalizado",
        "✅Hasta 10 páginas",
        "✅10 Correos Corporativos",
        "✅Diseño Responsive",
        "✅Alta en Buscadores",
        "✅Dominio y hosting (1 año)",
        "✅Botón Redes Sociales",
        "✅Certificado SSL",
        "✅Soporte básico",
        "✅Botón Contacto Whatsapp",
        "✅Mapa Ubicación Google Maps",
        "✅Posicionamiento Google (SEO)",
        "✅Sitio Autoadministrable",
        "✅Formulario de Contacto",
        "✅Crear Textos e imágenes",
        "✅Capacitación"
    ]',
    TRUE
);



////////////////////////////////////////

CREATE TABLE ejemplos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    imagen VARCHAR(200),
    link VARCHAR(300),
    plan VARCHAR(50), -- "basico", "profesional", etc
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO ejemplos 
(titulo, imagen, link, plan, activo)
VALUES
(
    'Web de Clínica Dental',
    'ejemplos/assets/dental/dental.gif',
    'ejemplos/clinicadental.html',
    'basico',
    TRUE
),
(
    'Web de Profesional Kinesiología',
    'ejemplos/assets/kine/kine.gif',
    'ejemplos/kinesiologia.html',
    'basico',
    TRUE
),
(
    'Web de Portafolio de Desarrollador',
    'ejemplos/assets/portafolio_desarro/port_desarro.gif',
    'ejemplos/portafolio_desarro.html',
    'basico',
    TRUE
);


////////////////////////////////////////
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