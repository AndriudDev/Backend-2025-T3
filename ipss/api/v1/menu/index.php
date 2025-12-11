<?php

include_once '../version.php';


switch ($_method) {
    case 'GET':
        if ($_autorizar === 'Bearer ipss.2025.T3') {
            /* $data = [
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
                
            ]; */

            include_once '../config/database.php';
            include_once 'modelo.php';
            $modelo = new Indicador();
            $data = $modelo->getAll();

            if (isset($_parametroID)) {
                foreach ($data as $registro) {
                    if ($registro['id'] == $_parametroID) {
                        http_response_code(200);
                        echo json_encode($registro);
                        return;
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
            http_response_code(403);
            echo json_encode(['error' => 'El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.']);
        }
        break;

    case 'POST':
        if ($_autorizar === 'Bearer ipss.2025.T3') {
            include_once '../config/database.php';
            include_once 'modelo.php';
            //echo "POST method en desarrollo";

            $modelo = new Indicador();
            $body = json_decode(file_get_contents("php://input", true));
            $modelo->setNombre($body->nombre);
            $modelo->setLink($body->link);
            $modelo->setOrden($body->orden);
            $modelo->setActivo($body->activo);

            //echo json_encode($body->nombre);
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
        }
        break;
    case 'DELETE':
        if ($_autorizar === 'Bearer ipss.2025.T3') {
            include_once '../config/database.php';
            include_once 'modelo.php';
            $modelo = new Indicador();

            if (!isset($_parametroID)) {
                http_response_code(400);
                echo json_encode(['error' => 'Falta el ID del registro a Deshabilitar']);

                die();
            }
            $modelo->setId($_parametroID);

            $anterior = $modelo->getById($modelo);

            if ($anterior == null) {
                http_response_code(404);
                echo json_encode(['error' => 'El ID del registro a Deshabilitar no existe']);
                die();
            }

            $modelo->setId($_parametroID);

            $respuesta = $modelo->disable($modelo);

            if ($respuesta) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Deshabilitado Exitosamente']);
                die();
            }
            http_response_code(409);
            echo json_encode(['error' => 'No se logró Deshabilitar el registro']);
            die();
        } else {
            http_response_code(403);
            echo json_encode(['error' => 'El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.']);
            die();
        }
        break;
    case 'PATCH':
        if ($_autorizar === 'Bearer ipss.2025.T3') {
            include_once '../config/database.php';
            include_once 'modelo.php';
            $modelo = new Indicador();

            if (!isset($_parametroID)) {
                http_response_code(400);
                echo json_encode(['error' => 'Falta el ID del registro a Deshabilitar']);

                die();
            }
            $modelo->setId($_parametroID);

            $anterior = $modelo->getById($modelo);

            if ($anterior == null) {
                http_response_code(404);
                echo json_encode(['error' => 'El ID del registro a Deshabilitar no existe']);
                die();
            }

            $modelo->setId($_parametroID);

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
        if ($_autorizar === 'Bearer ipss.2025.T3') {
            include_once '../config/database.php';
            include_once 'modelo.php';
            //echo "POST method en desarrollo";

            $modelo = new Indicador();

            if (!isset($_parametroID)) {
                http_response_code(400);
                echo json_encode(['error' => 'Falta el ID del registro a Actualizar']);

                die();
            }
            $modelo->setId($_parametroID);

            $anterior = $modelo->getById($modelo);

            if ($anterior == null) {
                http_response_code(404);
                echo json_encode(['error' => 'El ID del registro a Actualizar no existe']);
                die();
            }


            $body = json_decode(file_get_contents("php://input", true));

            $modelo->setNombre($body->nombre);
            $modelo->setLink($body->link);
            $modelo->setOrden($body->orden);


            $cantidadCambios = 0;

            if (strcmp($anterior['nombre'], $modelo->getNombre())) {
                $cantidadCambios++;
            }
            if ($anterior['link'] != $modelo->getLink()) {
                $cantidadCambios++;
            }
            if ($anterior['orden'] != $modelo->getOrden()) {
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
