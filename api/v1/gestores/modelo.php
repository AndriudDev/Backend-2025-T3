<?php
/*
CREATE TABLE ejemplos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    imagen VARCHAR(200),
    link VARCHAR(300),
    plan VARCHAR(50), -- "basico", "profesional", etc
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO ejemplos 
(titulo, imagen, link, plan, activo)
VALUES
(
    'Web de Clínica Dental',
    'ejemplos/assets/dental/dental.gif',
    'ejemplos/clinicadental.html',
    'basico',
    TRUE
),
(
    'Web de Profesional Kinesiología',
    'ejemplos/assets/kine/kine.gif',
    'ejemplos/kinesiologia.html',
    'basico',
    TRUE
),
(
    'Web de Portafolio de Desarrollador',
    'ejemplos/assets/portafolio_desarro/port_desarro.gif',
    'ejemplos/portafolio_desarro.html',
    'basico',
    TRUE
);
*/
class Indicador
{
    private $id;
    private $nombre;
    private $empresaTipoId;
    private $activo;

    public function __construct() {}

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmpresaTipoId()
    {
        return $this->empresaTipoId;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setEmpresaTipoId($id)
    {
        $this->empresaTipoId = (int)$id;
    }

    public function setActivo($activo)
    {
        $this->activo = (bool)$activo;
    }



    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        // Seleccionamos empresas con su tipo
        $query = "
        SELECT 
            e.id AS empresa_id,
            e.nombre AS empresa_nombre,
            e.activo AS empresa_activo,
            t.id AS tipo_id,
            t.nombre AS tipo_nombre,
            t.codigo AS tipo_codigo,
            t.icono_fa AS tipo_icono_fa,
            t.color_tw AS tipo_color_tw,
            t.color_css AS tipo_color_css
        FROM empresa e
        INNER JOIN empresaTipo t ON e.empresaTipo_id = t.id
        ORDER BY e.id;
        ";

        $rs = mysqli_query($con->getConnection(), $query);

        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $activoBool = intval($registro['empresa_activo']) === 1 ? true : false;
                $objeto = [
                    "id" => intval($registro['empresa_id']),
                    "nombre" => $registro['empresa_nombre'],
                    "empresa_tipo" => [
                        "id" => intval($registro['tipo_id']),
                        "nombre" => $registro['tipo_nombre'],
                        "codigo" => $registro['tipo_codigo'],
                        "icono" => [
                            "FontAwesome" => $registro['tipo_icono_fa']
                        ],
                        "color" => [
                            "Tailwind" => $registro['tipo_color_tw'],
                            "css" => $registro['tipo_color_css']
                        ]
                    ],
                    "activo" => $activoBool
                ];

                array_push($lista, $objeto);
            }
            mysqli_free_result($rs);
        }

        $con->closeConnection();
        return $lista;
    }

    public function getByNombre(Indicador $_data)
    {
        $con = new Conexion();

        $nombre = trim($_data->getNombre());

        $query = "
        SELECT id, nombre, empresaTipo_id, activo
        FROM empresa
        WHERE nombre = '$nombre'
        LIMIT 1
    ";

        $rs = mysqli_query($con->getConnection(), $query);

        if (!$rs || mysqli_num_rows($rs) === 0) {
            $con->closeConnection();
            return null;
        }

        $registro = mysqli_fetch_assoc($rs);
        $registro['activo'] = $registro['activo'] == 1 ? true : false;

        mysqli_free_result($rs);
        $con->closeConnection();

        return $registro;
    }


    public function getById(Indicador $_actual)
    {
        $lista = [];
        $con = new Conexion();
        //$query = "SELECT indi.id indi_id, indi.codigo indi_codigo, indi.nombre, indi.unidad_medida_id, unme.simbolo, unme.codigo unme_codigo, unme.nombre_singular, unme.nombre_plural, indi.valor, indi.activo FROM indicador indi INNER JOIN unidad_medida unme ON (indi.unidad_medida_id = unme.id) WHERE indi.id=" . $_actual->getId();
        // echo $query;
        $query = "SELECT * FROM ejemplos WHERE id=" . $_actual->getId();


        $rs = mysqli_query($con->getConnection(), $query);
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $registro['activo'] = $registro['activo'] == 1 ? true : false;
                $objeto = [
                    "id" => $registro['id'],
                    "titulo" => $registro['titulo'],
                    "imagen" => $registro['imagen'],
                    "link" => $registro['link'],
                    "plan" => $registro['plan'],
                    //"id" => $registro['id'],
                    "activo" => $registro['activo']
                ];
                array_push($lista, $objeto);
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
        return $lista[0] ?? null;
    }


    public function add(Indicador $_nuevo)
    {
        $con = new Conexion();

        $nombreNuevo = trim($_nuevo->getNombre());

        $queryCheck = "SELECT nombre FROM empresa";
        $rsCheck = mysqli_query($con->getConnection(), $queryCheck);

        if ($rsCheck) {
            while ($row = mysqli_fetch_assoc($rsCheck)) {
                if (trim($row['nombre']) === $nombreNuevo) {
                    mysqli_free_result($rsCheck);
                    $con->closeConnection();
                    return 'DUPLICADO';
                }
            }
            mysqli_free_result($rsCheck);
        }

        $queryInsert = "
        INSERT INTO empresa (nombre, empresaTipo_id, activo)
        VALUES (
            '$nombreNuevo',
            " . $_nuevo->getEmpresaTipoId() . ",
            " . ($_nuevo->getActivo() ? 1 : 0) . "
        )
        ";

        $rsInsert = mysqli_query($con->getConnection(), $queryInsert);

        if ($rsInsert) {
            $con->closeConnection();
            return true;
        }

        $con->closeConnection();
        return false;
    }






    public function disable(Indicador $_data)
    {
        $con = new Conexion();

        $id = (int) $_data->getId();

        $queryCheck = "
        SELECT id
        FROM empresa
        WHERE id = $id
        LIMIT 1
        ";

        $rsCheck = mysqli_query($con->getConnection(), $queryCheck);

        if (!$rsCheck || mysqli_num_rows($rsCheck) === 0) {
            $con->closeConnection();
            return false;
        }

        $queryDisable = "
        UPDATE empresa
        SET activo = 0
        WHERE id = $id
        ";

        mysqli_query($con->getConnection(), $queryDisable);
        $con->closeConnection();

        return true;
    }


    public function enable(Indicador $_data)
{
    $con = new Conexion();

    $id = (int) $_data->getId();

    $queryCheck = "
        SELECT id
        FROM empresa
        WHERE id = $id
        LIMIT 1
    ";

    $rsCheck = mysqli_query($con->getConnection(), $queryCheck);

    if (!$rsCheck || mysqli_num_rows($rsCheck) === 0) {
        $con->closeConnection();
        return false;
    }

    $queryEnable = "
        UPDATE empresa
        SET activo = 1
        WHERE id = $id
    ";

    mysqli_query($con->getConnection(), $queryEnable);
    $con->closeConnection();

    return true;
}


    public function update(Indicador $_data)
    {
        $con = new Conexion();

        $nombre = trim($_data->getNombre());
        $empresaTipoId = $_data->getEmpresaTipoId();
        $activo = $_data->getActivo() ? 1 : 0;

        $query = "
        UPDATE empresa
        SET
            empresaTipo_id = $empresaTipoId,
            activo = $activo
        WHERE nombre = '$nombre'
    ";

        mysqli_query($con->getConnection(), $query);
        $con->closeConnection();

        return true;
    }

    public function existePorId($id)
    {
        $con = new Conexion();

        $query = "SELECT id FROM empresaTipo WHERE id = $id LIMIT 1";
        $rs = mysqli_query($con->getConnection(), $query);

        $existe = $rs && mysqli_num_rows($rs) > 0;

        $con->closeConnection();
        return $existe;
    }

    
}
