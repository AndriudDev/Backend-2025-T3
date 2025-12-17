<?php

function obtenerEmpresaTipoId($empresaTipo)
{
    if (is_object($empresaTipo) && isset($empresaTipo->id)) {
        return intval($empresaTipo->id);
    }

    if (is_numeric($empresaTipo)) {
        return intval($empresaTipo);
    }

    return null;
}

function expandEmpresaTipo(int $id)
{
    include_once __DIR__ . '/../empresaTipo/modelo.php';

    $modelo = new Indicador();
    return $modelo->getByIdSimple($id);
}
