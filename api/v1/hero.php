<?php

include_once '../version.php';


switch ($_method) {
    case 'GET':
        if ($_authorization !== 'Bearer ipss.2025.T3') {
            http_response_code(401);
            echo json_encode(['error' => 'No tiene autorización']);
            exit;
        }

        // Requerimos el param bodaId (ej: api/v1/hero/?bodaId=123)
        if (!isset($_GET['bodaId']) || $_GET['bodaId'] === '') {
            http_response_code(400);
            echo json_encode(['error' => 'Parámetro bodaId requerido']);
            exit;
        }

        $bodaId = intval($_GET['bodaId']);

        $response = [
            "id" => $bodaId,
            "boda" => [
                "id" => $bodaId,
                "nombre" => "Isabella & Andrew"
            ],
            "letra" => [
                "chica" => "Are getting Married in",
                "grande" => "Event Started!"
            ],
            "link" => [
                "video" => [
                    "externo" => "https://www.wiselythemes.com/html/neela/images/landscape.mp4"
                ]
            ],
            "activo" => true
        ];

        http_response_code(200);
        echo json_encode($response);
        exit;
        break;

    default:
        http_response_code(501);
        echo json_encode(['error' => 'Método [' . $_method . '] no implementado']);
        break;
}
