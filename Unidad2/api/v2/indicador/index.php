<?php

include_once '../version.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === 'Bearer ipss.2025') {
            // $data = [
            //     [
            //         'id' => 1,
            //         'codigo' => 'UF',
            //         'nombre' => 'Unidad de Fomento',
            //         'unidad_medida' => 'Pesos',
            //         'valor' => 39551.81,
            //         'activo' => true
            //     ],
            //     [
            //         'id' => 2,
            //         'codigo' => 'IVP',
            //         'nombre' => 'Indice de Valor Promedio',
            //         'unidad_medida' => 'Pesos',
            //         'valor' => 41125.14,
            //         'activo' => true
            //     ],
            // ];

            include_once '../conexion.php';
            include_once 'modelo.php';

            $modelo = new Indicador();
            $data = $modelo->getAll();

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
    case 'POST':
        if ($_authorization === 'Bearer ipss.2025') {
            include_once '../conexion.php';
            include_once 'modelo.php';

            $modelo = new Indicador();

            $body = json_decode(file_get_contents("php://input", true));

            $modelo->setCodigo($body->codigo);
            $modelo->setNombre($body->nombre);
            $modelo->setUnidadMedidaId($body->unidad_medida->id);
            $modelo->setValor($body->valor);

            $respuesta = $modelo->add($modelo);

            if ($respuesta) {
                http_response_code(201);
                echo json_encode(['mensaje' => 'Creado Exitosamente']);
                die();
            }
            http_response_code(409);
            echo json_encode(['error' => 'No se logró crear el registro']);
            die();
        } else {
            http_response_code(403);
            echo json_encode(['error' => 'El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.']);
            die();
        }
        break;
    case 'DELETE':
        if ($_authorization === 'Bearer ipss.2025') {

            include_once '../conexion.php';
            include_once 'modelo.php';

            $modelo = new Indicador();

            $modelo->setId($_parametroID);

            $respuesta = $modelo->disable($modelo);

            if ($respuesta) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Apagado Exitosamente']);
                die();
            }
            http_response_code(409);
            echo json_encode(['error' => 'No se logró apagar el registro']);
            die();
        } else {
            http_response_code(403);
            echo json_encode(['error' => 'El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.']);
            die();
        }
        break;
    case 'PATCH':
        if ($_authorization === 'Bearer ipss.2025') {

            include_once '../conexion.php';
            include_once 'modelo.php';

            $modelo = new Indicador();

            $body = json_decode(file_get_contents("php://input", true));

            // print_r($body->id);

            $modelo->setId($body->id);

            $respuesta = $modelo->enable($modelo);

            if ($respuesta) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Encendido Exitosamente']);
                die();
            }
            http_response_code(409);
            echo json_encode(['error' => 'No se logró encender el registro']);
            die();
        } else {
            http_response_code(403);
            echo json_encode(['error' => 'El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.']);
            die();
        }
        break;
    case 'PUT':
        if ($_authorization === 'Bearer ipss.2025') {

            include_once '../conexion.php';
            include_once 'modelo.php';

            $modelo = new Indicador();

            $body = json_decode(file_get_contents("php://input", true));

            $modelo->setId($body->id);
            $modelo->setCodigo($body->codigo);
            $modelo->setNombre($body->nombre);
            $modelo->setValor($body->valor);
            $modelo->setUnidadMedidaId($body->unidad_medida->id);

            $anterior = $modelo->getById($modelo);

            $cantidadCambios = 0;

            if (strcmp($anterior['codigo'], $modelo->getCodigo())) {
                $cantidadCambios++;
            }
            if ($anterior['nombre'] != $modelo->getNombre()) {
                $cantidadCambios++;
            }
            if ($anterior['valor'] != $modelo->getValor()) {
                $cantidadCambios++;
            }
            if ($anterior['unidad_medida']['id'] != $modelo->getUnidadMedidaId()) {
                $cantidadCambios++;
            }

            if ($cantidadCambios > 0) {
                $respuesta = $modelo->update($modelo);
                if ($respuesta) {
                    http_response_code(200);
                    echo json_encode(['mensaje' => 'Actualizado Exitosamente']);
                    die();
                }
                http_response_code(409);
                echo json_encode(['error' => 'No se Actualizó como querías.']);
                die();
            }
            http_response_code(409);
            echo json_encode(['error' => 'No se hicieron cambios']);
            die();
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
