<?php

include_once '../version.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === 'Bearer ipss.2025') {
            $data = [
                [
                    'id' => 1,
                    'codigo' => 'UF',
                    'nombre' => 'Unidad de Fomento',
                    'unidad_medida' => 'Pesos',
                    'valor' => 39551.81,
                    'activo' => true
                ],
                [
                    'id' => 2,
                    'codigo' => 'IVP',
                    'nombre' => 'Indice de Valor Promedio',
                    'unidad_medida' => 'Pesos',
                    'valor' => 41125.14,
                    'activo' => true
                ],
            ];

            //echo $_parametroID;
            if (isset($_parametroID)) {
                foreach ($data as $registro) {
                    if ($registro['id'] == $_parametroID) {
                        http_response_code(200);
                        echo json_encode($registro);
                        die();
                    }
                }
                http_response_code(404);
                echo json_encode(['error' => 'No encontrado']);
                die();
            } else {
                //echo 'son todos';
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
