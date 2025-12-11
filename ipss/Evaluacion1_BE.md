# Evaluación 1 de Backend

## Resultados de Aprendizaje de la unidad:
1.1 Aplica los principios del desarrollo backend y su rol en la arquitectura de una aplicación de software.

1.2 Utiliza el lenguaje de programación backend para interactuar con el servidor web.

## En esta situación evaluativa, se espera evidenciar que los estudiantes:
1.1.1 Identifica los componentes principales de una arquitectura de backend y su función en el desarrollo de una aplicación de software.

1.1.2 Explica el rol del desarrollo backend en la arquitectura de una aplicación de software de manera concisa y completa.

1.1.3 Revisa la calidad del desarrollo backend de una aplicación de software con criterios definidos y objetivos.

1.1.4 Desarrolla una API RESTful utilizando un framework de backend.

1.1.6 Resuelve problemas de rendimiento y escalabilidad en una aplicación de backend.

1.2.1 Diseña solicitudes HTTP donde el servidor responde a las solicitudes del cliente de manera precisa y eficiente.

1.2.2 Gestiona la lógica de negocio para que ésta se ejecute de manera precisa y coherente con los requisitos de la aplicación.

1.2.3 Interactúa con bases de datos cuya realización es segura y eficiente.

# Características de la evaluación

- Esta es una actividad calificada de la unidad y es de carácter grupal de máximo 2 integrantes.
- Para conocer cómo serás evaluado, revisa la pauta de evaluación disponible en plataforma.
- Esta es una actividad evaluativa de desarrollo extendida donde se debe resolver una problemática, buscando la mejor solución mediante el trabajo colaborativo y propuesta de un proyecto.
- Esta actividad evaluativa implicará la entrega de un producto que deberá cargar a la plataforma.
- Se evalúa al 60% de exigencia para nota 4,0, con un puntaje total en la evaluación del 100%.

# Instrucciones

## Proyecto Matrimonios o Proyecto Personal

### Proyecto Matrimonios

El proyecto consiste en el desarrollo de una página web para una empresa que hace páginas a los novios que desean contraer matrimonio.

La página web se enfocará en presentar a los novios, así como proporcionar información sobre el evento.

#### Objetivos:
- Presentar de manera clara y atractiva los servicios ofrecidos por la empresa.
- Proporcionar información detallada sobre los novios.
- Facilitar el contacto de los novios con sus invitados.

### Proyecto Matrimonios o Proyecto Personal

La página web constará de las siguientes secciones principales:

1. Sección **Header y Menú Principal**:
Incluirá un encabezado con el nombre de la empresa y un menú principal que permita
acceder a las diferentes secciones de la página.

2. Sección **Hero**:
Incluirá una bienvenida a los invitados a la página de los novios, donde se podrá colocar un video de fondo, el nombre o alias de los novios, un texto en un texto de tamaño pequeño y otro en un texto de tamaño más grande.

3. Sección **Petición de Mano**:
Historia de la petición de mano, donde además se presentan los novios con una descripción corta, imagen, identificación de novio o novia. Incluyendo sus redes sociales.

# Tecnologías Utilizadas
- Debe utilizar el lenguaje de programación PHP, sin uso de frameworks, ya que esa materia se verá en Desarrollo Web I.
- La autenticación GET para los endpoint es Authorization Bearer: ipss.2025.T3

# Salidas Esperadas
Una vez pegado al endpoint, se debe obtener la siguiente información:

## api/v1/menu/
```json
[
    {
        "id": 1,
        "nombre": "Inicio",
        "link": "#home",
        "activo": true
    },
    {
        "id": 2,
        "nombre": "Novi@s",
        "link": "#novios",
        "activo": true
    },
    {
        "id": 3,
        "nombre": "Nuestra Historia",
        "link": "#history",
        "activo": false
    }
]
```
## api/v1/menu/?id=1
```json
{
    "id": 1,
    "nombre": "Inicio",
    "link": "#home",
    "activo": true
}
```
## api/v1/hero/?bodaId=123
```json
{
    "id": 123,
    "boda": {
        "id": 123,
        "nombre": "Isabella & Andrew"
    },
    "letra": {
        "chica": "Are getting Married in",
        "grande": "Event Started!"
    },
    "link": {
        "video": {
            "externo": "https://www.wiselythemes.com/html/neela/images/landscape.mp4"
        }
    },
    "activo": true
}
```
## api/v1/peticion/?bodaId=123
```json
{
    "id": 123,
    "boda": {
        "id": 123,
        "nombre": "Isabella & Andrew"
    },
    "título": "Petición de Mano",
    "descripción": "Bajo las luces de la terraza, Andrew se arrodilló, con el corazón latiéndole fuerte. Sacó una caja de terciopelo. \"Isabella, has transformado mi vida en una aventura. Eres mi futuro, mi calma y mi alegría. ¿Me harías el inmenso honor de ser mi esposa?\" Ella, con lágrimas en los ojos, asintió y susurró: \"Sí, mi amor, ¡mil veces sí!\"",
    "novios": [
        {
            "id": 247,
            "apodo": "Isabella",
            "nombre": "Isabella Walker",
            "tipo": {
                "id": 2,
                "nombre": "Novia"
            },
            "descripción": "La musa radiante de Andrew, acepta su futuro con lágrimas de inmensa felicidad en sus ojos. Ella es la calma y la alegría que él atesorará por siempre.",
            "redes": [
                {
                    "red": {
                        "id": 1,
                        "nombre": "Facebook",
                        "icono": "fab fa-facebook-square"
                    },
                    "link": "https://web.facebook.com/isabellaandrew.4391752747601439"
                },
                {
                    "red": {
                        "id": 2,
                        "nombre": "Instagram",
                        "icono": "fab fa-instagram-square"
                    },
                    "link": "https://www.instagram.com/isab.ellaandrew6393/"
                }
            ]
        },
        {
            "id": 248,
            "apodo": "Andrew",
            "nombre": "Andrew Miller",
            "tipo": {
                "id": 1,
                "nombre": "Novio"
            },
            "descripción": "Con el corazón fuerte y valiente, es el hombre que convierte la vida de Isabella en una aventura de calma y alegría. Su amor y su promesa son su hermoso futuro compartido.",
            "redes": [
                {
                    "red": {
                        "id": 1,
                        "nombre": "Facebook",
                        "icono": "fab fa-facebook-square"
                    },
                    "link": "https://web.facebook.com/andrewjackmiller"
                },
                {
                    "red": {
                        "id": 3,
                        "nombre": "Twitter",
                        "icono": "fab fa-twitter-square"
                    },
                    "link": "https://x.com/miller_cricket?lang=es"
                }
            ]
        }
    ],
    "activo": true
}
```

# Requisitos de Entrega
La entrega debe ser un archivo comprimido (.zip) que contenga:

- Código Fuente (100%): Todos los archivos PHP con la implementación de la API (incluyendo la estructura de carpetas definida).

- Documentación (20% del puntaje total): Un archivo README.md o Documentacion.pdf que debe incluir:

- Identificación: Nombres y apellidos de los integrantes.

- Instrucciones de Despliegue: Pasos claros para configurar y hacer funcionar la aplicación (dónde poner el código (XAMPP), endpoint base, etc.).

- Pruebas de Postman/curl: Incluir al menos dos ejemplos de request y response exitosos (código 200) y un ejemplo de request fallido (código 401) mostrando el uso del header Authorization.

URL de referencia: https://www.wiselythemes.com/html/neela/index-onepage-video.html
