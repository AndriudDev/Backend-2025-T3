<?php

include_once '../common/version.php';
include_once '../common/response.php';
include_once '../common/database.php';
include_once '../common/validators.php';
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
                            //http_response_code(200);
                            jsonResponse(200, 'OK', $registro);
                            //echo json_encode($registro);
                            return;
                        }
                    }
                    //http_response_code(404);
                    jsonResponse(404, 'Error', 'Registro no encontrado');
                    //echo json_encode(['error' => 'No encontrado']);
                    exit;
                } else {
                    //echo 'son todos';
                    //http_response_code(200);
                    jsonResponse(200, 'OK', $data);
                    //echo json_encode($data);
                    exit;
                }
            } else {
                //http_response_code(401);
                jsonResponse(401, 'Error', 'Sin autorización');
            }
        } catch (Exception $e) {
            jsonResponse(500, 'Error interno del servidor', ['detalle' => $e->getMessage()]);
        }
        break;
    case 'POST':
        try {
            if ($_autorizar !== 'Bearer ipss.2025.T3') {
                jsonResponse(401, 'ERROR', 'Sin autorización');
            }
            $body = json_decode(file_get_contents("php://input"));

            if (!$body || !isset($body->nombre)) {
                jsonResponse(400, 'ERROR', 'Falta el nombre');
            }
            $modelo = new Indicador();
            $modelo->setNombre($body->nombre);
            $modelo->setActivo($body->activo ?? true);
            $empresaTipoId = obtenerEmpresaTipoId($body->empresa_tipo ?? null);
            if ($empresaTipoId === null) {
                jsonResponse(400, 'ERROR', 'empresa_tipo inválido');
            }
            $empresaTipoModelo = new Indicador();

            if (!$empresaTipoModelo->existePorId($empresaTipoId)) {
                jsonResponse(409, 'ERROR', 'El tipo de empresa no existe');
            }
            $modelo->setEmpresaTipoId($empresaTipoId);
            $respuesta = $modelo->add($modelo);
            if ($respuesta === true) {
                jsonResponse(200, 'OK', 'Creado correctamente');
            }
            if ($respuesta === 'DUPLICADO') {
                jsonResponse(409, 'ERROR', 'El nombre ya existe');
            }
            jsonResponse(500, 'ERROR', 'Error al crear');
        } catch (Exception $e) {
            jsonResponse(500, 'Error interno del servidor', ['detalle' => $e->getMessage()]);
        }
        break;

    case 'PUT':
        try {
            if ($_autorizar === 'Bearer ipss.2025.T3') {

                $modelo = new Indicador();
                $body = json_decode(file_get_contents("php://input"));

                if ($body === null) {
                    jsonResponse(400, 'Error', 'JSON mal formado');
                }

                $modelo->setNombre($body->nombre ?? '');
                $modelo->setActivo($body->activo ?? true);

                $empresaTipoId = null;
                if (isset($body->empresa_tipo)) {
                    if (is_object($body->empresa_tipo)) {
                        $empresaTipoId = $body->empresa_tipo->id ?? null;
                    } elseif (is_int($body->empresa_tipo)) {
                        $empresaTipoId = $body->empresa_tipo;
                    }
                }

                if ($empresaTipoId === null) {
                    jsonResponse(400, 'Error', 'Falta empresa_tipo.id');
                }

                $empresaTipoModelo = new Indicador();

                if (!$empresaTipoModelo->existePorId($empresaTipoId)) {
                    jsonResponse(409, 'Error', 'El tipo de empresa no existe');
                }

                $modelo->setEmpresaTipoId($empresaTipoId);

                $existe = $modelo->getByNombre($modelo);

                if ($existe === null) {
                    jsonResponse(404, 'Error', 'Registro no encontrado');
                }

                $modelo->update($modelo);
                jsonResponse(200, 'OK', 'Actualizado correctamente');
            } else {
                jsonResponse(401, 'Error', 'Sin autorización');
            }
        } catch (Exception $e) {
            jsonResponse(500, 'Error interno del servidor', ['detalle' => $e->getMessage()]);
        }
        break;


    case 'DELETE':
        try {
            if ($_autorizar === 'Bearer ipss.2025.T3') {

                $modelo = new Indicador();
                if (!isset($_parametroID)) {
                    jsonResponse(404, 'Error', 'Registro no encontrado');
                    //http_response_code(400);
                    //echo json_encode(['error' => 'Falta el ID del registro a deshabilitar']);
                    exit;
                }

                $modelo->setId($_parametroID);

                $respuesta = $modelo->disable($modelo);

                if ($respuesta === true) {
                    jsonResponse(200, 'OK', 'Deshabilitado correctamente');
                    // http_response_code(200);
                    // echo json_encode(['mensaje' => 'Deshabilitado Exitosamente']);
                    exit;
                }
                jsonResponse(500, 'Error', 'Error al crear');
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
                $modelo = new Indicador();

                if (!isset($_parametroID)) {
                    jsonResponse(404, 'Error', 'Registro no encontrado');
                    // http_response_code(400);
                    // echo json_encode(['error' => 'Falta el ID del registro a Deshabilitar']);

                    die();
                }
                $modelo->setId($_parametroID);

                $respuesta = $modelo->enable($modelo);

                if ($respuesta) {
                    jsonResponse(200, 'OK', 'Encendido correctamente');

                    //http_response_code(200);
                    //echo json_encode(['mensaje' => 'Encendido Exitosamente']);
                    die();
                }
                jsonResponse(500, 'Error', 'Error al crear');
                //http_response_code(500);
                //echo json_encode(['error' => 'No se logró encender el registro']);
                die();
            } else {
                jsonResponse(401, 'Error', 'Sin autorización');
                // http_response_code(403);
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
