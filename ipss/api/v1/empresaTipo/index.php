<?php

include_once '../common/version.php';
include_once '../common/response.php';
include_once '../common/database.php';
include_once 'modelo.php';

switch ($_method) {
    case 'GET':
        try {
            if ($_autorizar === 'Bearer ipss.2025.T3') {

                $modelo = new Indicador();

                //$modelo = new ModeloIndicador($conexion);
                $data = $modelo->getAll();
                //$modelo->closeConnection();


                if (isset($_parametroID)) {
                    foreach ($data as $registro) {
                        if ($registro['id'] == $_parametroID) {
                            jsonResponse(200, 'OK', $registro);
                            //http_response_code(200);
                            //echo json_encode($registro);
                            return;
                        }
                    }
                    jsonResponse(404, 'Error', 'No encontrado');
                    //http_response_code(404);
                    // echo json_encode(['error' => 'No encontrado']);
                } else {
                    jsonResponse(200, 'OK', $data);
                    //echo 'son todos';
                    //http_response_code(200);
                    //echo json_encode($data);
                }
            } else {
                jsonResponse(401, 'Error', 'Sin autorización');
                //http_response_code(401);
                // echo json_encode(['error' => 'El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.']);
            }
        } catch (Exception $e) {
            jsonResponse(500, 'Error interno del servidor', ['detalle' => $e->getMessage()]);
        }
        break;
    case 'POST':
        try {
            if ($_autorizar === 'Bearer ipss.2025.T3') {


                $modelo = new Indicador();
                $body = json_decode(file_get_contents("php://input"), true);

                // nombre
                $modelo->setNombre($body['nombre']);

                // codigo
                $modelo->setCodigo($body['codigo']);

                // icono.FontAwesome
                $modelo->setIconoFa($body['icono']['FontAwesome']);

                // color
                $modelo->setColorTw($body['color']['Tailwind']);
                $modelo->setColorCss($body['color']['css']);

                // activo por defecto TRUE
                $modelo->setActivo($body['activo'] ?? true);

                $respuesta = $modelo->add($modelo);

                if ($respuesta === true) {
                    jsonResponse(200, 'OK', 'Creado correctamente');
                    //http_response_code(201);
                    //echo json_encode(['mensaje' => 'Creado Exitosamente']);
                    exit;
                }

                if ($respuesta === 'DUPLICADO_NOMBRE') {
                    jsonResponse(409, 'Error', 'El nombre ya existe');
                    //http_response_code(409);
                    //echo json_encode(['error' => 'El nombre esta duplicado. Cambiar el nombre']);
                    exit;
                }

                if ($respuesta === 'DUPLICADO_CODIGO') {
                    jsonResponse(409, 'Error', 'El codigo ya existe');
                    //http_response_code(409);
                    //echo json_encode(['error' => 'El código esta duplicado. Cambiar el código']);
                    exit;
                }
                jsonResponse(500, 'Error', 'Error al crear');
                //http_response_code(500);
                //echo json_encode(['error' => 'Error al crear']);
                exit;
            } else {
                jsonResponse(401, 'Error', 'Sin autorización');
                //http_response_code(403);
                //echo json_encode(['error' => 'No autorizado']);
            }
        } catch (Exception $e) {
            jsonResponse(500, 'Error interno del servidor', ['detalle' => $e->getMessage()]);
        }
        break;

    case 'PUT':
        try {
            if ($_autorizar === 'Bearer ipss.2025.T3') {

                $body = json_decode(file_get_contents("php://input"));

                if (!isset($body->id)) {
                    jsonResponse(400, 'Error', 'Falta el ID');
                    //http_response_code(400);
                    //echo json_encode(['error' => 'Falta el ID']);
                    exit;
                }

                if (!isset($body->nombre)) {
                    jsonResponse(400, 'Error', 'Falta el nombre');
                    //http_response_code(400);
                    //echo json_encode(['error' => 'Falta el nombre']);
                    exit;
                }

                $modelo = new Indicador();
                $modelo->setId($body->id);
                $existeId = $modelo->setNombre($body->nombre);
                $modelo->setCodigo($body->codigo);
                $modelo->setIconoFa($body->icono->FontAwesome ?? null);
                $modelo->setColorTw($body->color->Tailwind ?? null);
                $modelo->setColorCss($body->color->css ?? null);
                $modelo->setActivo($body->activo ?? true);

                $existe = $modelo->getByNombre($modelo);

                if ($existe === null) {
                    jsonResponse(404, 'Error', 'Registro no encontrado');
                    //http_response_code(404);
                    //echo json_encode(['error' => 'Nombre de empresa no encontrado']);
                    exit;
                }
                $modelo->update($modelo);
                jsonResponse(200, 'OK', 'Actualizado correctamente');
                //http_response_code(200);
                //echo json_encode(['mensaje' => 'Actualizado correctamente']);
                exit;
            } else {
                jsonResponse(401, 'Error', 'Sin autorización');
                //http_response_code(403);
                //echo json_encode(['error' => 'No autorizado']);
                exit;
            }
        } catch (Exception $e) {
            jsonResponse(500, 'Error interno del servidor', ['detalle' => $e->getMessage()]);
        }
        break;


    case 'DELETE':
        try {
            if ($_autorizar === 'Bearer ipss.2025.T3') {

                if (!isset($_parametroID)) {
                    jsonResponse(400, 'Error', 'Falta el ID del registro a deshabilitar');
                    //http_response_code(400);
                    //echo json_encode(['error' => 'Falta el ID del registro a deshabilitar']);
                    exit;
                }

                $modelo = new Indicador();
                $modelo->setId($_parametroID);

                $respuesta = $modelo->disable($modelo);

                if ($respuesta === true) {
                    jsonResponse(200, 'OK', 'Deshabilitado correctamente');
                    //http_response_code(200);
                    //echo json_encode(['mensaje' => 'Deshabilitado Exitosamente']);
                    exit;
                }
                jsonResponse(500, 'Error', 'No se logró deshabilitar el registro');
                //http_response_code(500);
                //echo json_encode(['error' => 'No se logró deshabilitar el registro']);
                exit;
            } else {
                jsonResponse(401, 'Error', 'Sin autorización');
                //http_response_code(403);
                //echo json_encode(['error' => 'No autorizado']);
                exit;
            }
        } catch (Exception $e) {
            jsonResponse(500, 'Error interno del servidor', ['detalle' => $e->getMessage()]);
        }
        break;

    case 'PATCH':
        try {


            if ($_autorizar === 'Bearer ipss.2025.T3') {

                if (!isset($_parametroID)) {
                    jsonResponse(400, 'Error', 'Falta el ID del registro a deshabilitar');
                    //http_response_code(400);
                    //echo json_encode(['error' => 'Falta el ID del registro a Deshabilitar']);

                    die();
                }

                $modelo = new Indicador();
                $modelo->setId($_parametroID);

                $respuesta = $modelo->enable($modelo);

                if ($respuesta) {
                    jsonResponse(200, 'OK', 'Encendido correctamente');
                    //http_response_code(200);
                    //echo json_encode(['mensaje' => 'Encendido Exitosamente']);
                    die();
                }
                jsonResponse(500, 'Error', 'No se logró activar el registro');
                //http_response_code(500);
                //echo json_encode(['error' => 'No se logró encender el registro']);
                die();
            } else {
                jsonResponse(401, 'Error', 'Sin autorización');
                //http_response_code(403);
                //echo json_encode(['error' => 'El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.']);
                die();
            }
        } catch (Exception $e) {
            jsonResponse(500, 'Error interno del servidor', ['detalle' => $e->getMessage()]);
        }
        break;


    default:
        jsonResponse(405, 'Error', 'Metodo no permitido');
        //http_response_code(405);
        //echo json_encode(['error' => 'Método no permitido']);;
        break;
}
