<?php

include_once '../version.php';

switch ($_method) {
    case 'GET':
        if ($_autorizar === 'Bearer ipss.2025') {
            $data = [
                [
                    'id' => 1,
                    'idioma' => 'es-CL',
                    'nombreweb' => 'creatuwebs.com',
                    'descripcionweb' => 'CreaTuWebs - Diseño y desarrollo de sitios web profesionales',
                    'logo' => 'https://creatuwebs.com/img/logo/creatuwebs-logo.png',
                    'color' => 'black',
                    'font' => 'Arial, sans-serif',
                    'activo' => true
                ]
                
            ];
            //echo $_parametroID;
            if (isset($_parametroID)) {
                foreach ($data as $registro) {
                    if ($registro['id'] == $_parametroID) {
                        http_response_code(200);
                        echo json_encode($registro);
                    }
                }
                http_response_code(404);
                echo json_encode(['error' => 'No encontrado']);
            } else {
                //echo 'son todos';
                http_response_code(200);
                echo json_encode($data);
            }
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.']);
        }
        break;
    default:
        http_response_code(501);
        echo json_encode(['error' => 'Método [' . $_method . '] no implementado']);
        break;
}
