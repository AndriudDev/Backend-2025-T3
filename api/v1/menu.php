<?php
include_once 'version.php';

switch ($_method) {
    case 'GET':
        // Verificación de Authorization
        if ($_autorizar === 'Bearer ipss.2025') {

            // Datos de ejemplo del menú
            $infomenu = [
                [
                    "id" => 1,
                    "nombre" => "Inicio",
                    "link" => "#home",
                    "activo" => true
                ],
                [
                    "id" => 2,
                    "nombre" => "Portafolio",
                    "link" => "#portafolio",
                    "activo" => true
                ],
                [
                    "id" => 3,
                    "nombre" => "Servicios",
                    "link" => "#servicios",
                    "activo" => true
                ],
                [
                    "id" => 4,
                    "nombre" => "FAQ",
                    "link" => "https://creatuwebs.com/faq",
                    "activo" => true
                ],
                [
                    "id" => 5,
                    "nombre" => "Contactanos",
                    "link" => "https://creatuwebs.com/contactanos",
                    "activo" => true
                ]
            ];
            // Si viene el parámetro id, buscamos un solo registro
            if (isset($_GET['id'])) {
                $idBuscado = intval($_GET['id']);
                foreach ($infomenu as $item) {
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
                // Si no hay parámetro, devolver todo el menú
                http_response_code(200);
                echo json_encode($infomenu);
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
