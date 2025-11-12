<?php

include_once '../version.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === 'Bearer ipss.2025') {
            $data = [
                [
                    'id' => 111,
                    'boda' => [
                        'id' => 111,
                        'nombre' => 'Ana & Sebastián'
                    ],
                    'letra' => [
                        'chica' => 'En un tiempito más...',
                        'grande' => '¡Nos Casaremos!'
                    ],
                    'link' => [
                        'video' => [
                            'externo' => 'https://www.wiselythemes.com/html/neela/images/landscape.mp4'
                        ]
                    ],
                    'activo' => true
                ],
                [
                    'id' => 123,
                    'boda' => [
                        'id' => 123,
                        'nombre' => 'Isabella & Andrew'
                    ],
                    'letra' => [
                        'chica' => 'Are getting Married in',
                        'grande' => 'Event Started!'
                    ],
                    'link' => [
                        'video' => [
                            'externo' => 'https://www.wiselythemes.com/html/neela/images/landscape.mp4'
                        ]
                    ],
                    'activo' => true
                ],
                
            ];

            //echo $_parametroID;
            if (isset($_bodaId)) {
                // echo 'es uno';
                foreach ($data as $registro) {
                    if ($registro['boda']['id'] == $_bodaId) {
                        http_response_code(200);
                        echo json_encode($registro);
                        die();
                    }
                }
                http_response_code(404);
                echo json_encode(['error' => 'No encontrado']);
                die();
            } else {
                // echo 'son todos';
                http_response_code(200);
                echo json_encode($data);
                die();
            }
        } else {
            http_response_code(403);
            echo json_encode(['error' => 'El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.']);
            die();
        }
        break;
    default:
        http_response_code(501);
        echo json_encode(['error' => 'Método [' . $_method . '] no implementado']);
        break;
}
