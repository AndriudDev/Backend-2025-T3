
<?php

include_once 'version.php';


switch ($_method) {
    case 'GET':
        if ($_autorizar === 'Bearer ipss.2025') {

            // Requerimos el param bodaId (ej: api/v1/hero/?bodaId=123)
            //if (!isset($_GET['bodaId']) || $_GET['bodaId'] === '') {

            //$bodaId = intval($_GET['bodaId']);

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
            if (isset($_GET['serid'])) {
                $idBuscado = intval($_GET['serid']);
                foreach ($respuesta as $item) {
                    if ($item['id'] === $idBuscado) {
                        http_response_code(200);
                        echo json_encode($item);
                        exit;
                    }
                }
                // Si no se encuentra
                http_response_code(404);
                echo json_encode(['error' => 'No encontrado']);
                exit;
            } else {
                // Si no hay parámetro, devolver 
                http_response_code(200);
                echo json_encode($respuesta);
                exit;
            }
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada. (No tiene autorización)']);
        }
        break;
    default:
        http_response_code(501);
        echo json_encode(['error' => 'Método [' . $_method . '] no implementado']);
        break;
}
