<?php

include_once 'version.php';


switch ($_method) {
    case 'GET':
        if ($_autorizar === 'Bearer ipss.2025') {
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
            if (isset($_GET['ejem'])) {
                $idBuscado = intval($_GET['ejem']);
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
                // Si no hay parámetro, devolver 400
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
