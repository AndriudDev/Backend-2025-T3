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
    private $codigo;
    private $icono_fa;
    private $color_tw;
    private $color_css;
    private $activo;

    public function __construct() {}

    public function getId()
    {
        return $this->id;
    }

    public function setId($_n)
    {
        $this->id = $_n;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($_n)
    {
        $this->nombre = $_n;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($_n)
    {
        $this->codigo = $_n;
    }

    public function getIconoFa()
    {
        return $this->icono_fa;
    }

    public function setIconoFa($_n)
    {
        $this->icono_fa = $_n;
    }

    public function getColorTw()
    {
        return $this->color_tw;
    }

    public function setColorTw($_n)
    {
        $this->color_tw = $_n;
    }

    public function getColorCss()
    {
        return $this->color_css;
    }

    public function setColorCss($_n)
    {
        $this->color_css = $_n;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($_n)
    {
        $this->activo = $_n;
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
        SELECT id
        FROM empresaTipo
        WHERE nombre = '$nombre'
        LIMIT 1
    ";

        $rs = mysqli_query($con->getConnection(), $query);

        if (!$rs || mysqli_num_rows($rs) === 0) {
            $con->closeConnection();
            return null;
        }

        mysqli_free_result($rs);
        $con->closeConnection();

        return true;
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
        $codigoNuevo = trim($_nuevo->getCodigo());

        $queryCheck = "
        SELECT nombre, codigo
        FROM empresaTipo
    ";

        $rsCheck = mysqli_query($con->getConnection(), $queryCheck);

        if ($rsCheck) {
            while ($row = mysqli_fetch_assoc($rsCheck)) {

                if (trim($row['nombre']) === $nombreNuevo) {
                    mysqli_free_result($rsCheck);
                    $con->closeConnection();
                    return 'DUPLICADO_NOMBRE';
                }

                if (trim($row['codigo']) === $codigoNuevo) {
                    mysqli_free_result($rsCheck);
                    $con->closeConnection();
                    return 'DUPLICADO_CODIGO';
                }
            }

            mysqli_free_result($rsCheck);
        }

        $queryInsert = "
        INSERT INTO empresaTipo (
            nombre,
            codigo,
            icono_fa,
            color_tw,
            color_css,
            activo
        ) VALUES (
            '$nombreNuevo',
            '$codigoNuevo',
            '" . $_nuevo->getIconoFa() . "',
            '" . $_nuevo->getColorTw() . "',
            '" . $_nuevo->getColorCss() . "',
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

        $id = intval($_data->getId());

        $query = "
        UPDATE empresaTipo
        SET activo = 0
        WHERE id = $id
    ";

        mysqli_query($con->getConnection(), $query);
        $con->closeConnection();

        return true;
    }



    public function enable(Indicador $_data)
    {
        $con = new Conexion();

        $id = intval($_data->getId());

        $query = "
        UPDATE empresaTipo
        SET activo = 1
        WHERE id = $id
    ";

        mysqli_query($con->getConnection(), $query);
        $con->closeConnection();

        return true;
    }



    public function update(Indicador $_data)
    {
        $con = new Conexion();

        $nombre = trim($_data->getNombre());
        $codigo = trim($_data->getCodigo());
        $iconoFa = $_data->getIconoFa();
        $colorTw = $_data->getColorTw();
        $colorCss = $_data->getColorCss();
        $activo = $_data->getActivo() ? 1 : 0;

        $query = "
        UPDATE empresaTipo
        SET
            codigo = '$codigo',
            icono_fa = '$iconoFa',
            color_tw = '$colorTw',
            color_css = '$colorCss',
            activo = $activo
        WHERE nombre = '$nombre'
    ";

        mysqli_query($con->getConnection(), $query);
        $con->closeConnection();

        return true;
    }


    public function getByIdSimple(int $id)
{
    $con = new Conexion();

    $query = "
        SELECT
            id,
            nombre,
            codigo,
            icono_fa,
            color_tw,
            color_css,
            activo
        FROM empresaTipo
        WHERE id = $id
        LIMIT 1
    ";

    $rs = mysqli_query($con->getConnection(), $query);

    if (!$rs || mysqli_num_rows($rs) === 0) {
        $con->closeConnection();
        return null;
    }

    $r = mysqli_fetch_assoc($rs);

    mysqli_free_result($rs);
    $con->closeConnection();

    return [
        "id" => (int)$r['id'],
        "nombre" => $r['nombre'],
        "codigo" => $r['codigo'],
        "icono" => [
            "FontAwesome" => $r['icono_fa']
        ],
        "color" => [
            "Tailwind" => $r['color_tw'],
            "css" => $r['color_css']
        ],
        "activo" => (int)$r['activo'] === 1
    ];
}



}
