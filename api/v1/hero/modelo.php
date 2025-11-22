<?php
/*
CREATE TABLE hero (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    subtitulo VARCHAR(500),
    texto_boton VARCHAR(50),
    link_boton VARCHAR(200),
    imagen VARCHAR(200),
    orden INT NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO hero 
(titulo, subtitulo, texto_boton, link_boton, imagen, orden, activo)
VALUES
(
    'Diseño web a medida para tu negocio',
    'Creamos sitios web atractivos y funcionales que impulsan tu marca y atraen a tus clientes.',
    'Ver Planes',
    '#servicios',
    'assets/carru_1.png',
    1,
    TRUE
),
(
    'Impulsa tu presencia online',
    'Transforma tu idea en una web moderna, rápida y optimizada para todos los dispositivos.',
    'Contáctanos',
    '#contactanos',
    'assets/carru_2.png',
    2,
    TRUE
),
(
    'Webs profesionales para tu negocio',
    'Diseños personalizados que reflejan la esencia de tu marca y generan confianza.',
    'Ver Ejemplos',
    '#portafolio',
    'assets/carru_3.png',
    3,
    TRUE
);
*/
class Indicador
{
    private $id;
    private $codigo;
    private $nombre;
    private $unidad_medida_id;
    private $valor;
    private $activo;

    public function __construct() {}

    // accesadores
    public function getId()
    {
        return $this->id;
    }
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getUnidadMedidaId()
    {
        return $this->unidad_medida_id;
    }
    public function getValor()
    {
        return $this->valor;
    }
    public function getActivo()
    {
        return $this->activo;
    }

    // mutadores
    public function setId($_n)
    {
        $this->id = $_n;
    }
    public function setCodigo($_n)
    {
        $this->codigo = $_n;
    }
    public function setNombre($_n)
    {
        $this->nombre = $_n;
    }
    public function setUnidadMedidaId($_n)
    {
        $this->unidad_medida_id = $_n;
    }
    public function setValor($_n)
    {
        $this->valor = $_n;
    }
    public function setActivo($_n)
    {
        $this->activo = $_n;
    }

    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        //$query = "SELECT indi.id indi_id, indi.codigo indi_codigo, indi.nombre, indi.unidad_medida_id, unme.simbolo, unme.codigo unme_codigo, unme.nombre_singular, unme.nombre_plural, indi.valor, indi.activo FROM indicador indi INNER JOIN unidad_medida unme ON (indi.unidad_medida_id = unme.id);";
        $query = $query = "SELECT * FROM hero";
        $rs = mysqli_query($con->getConnection(), $query);
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $registro['activo'] = $registro['activo'] == 1 ? true : false;
                $objeto = [
                    "id" => $registro['id'],
                    "titulo" => $registro['titulo'],
                    "subtitulo" => $registro['subtitulo'],
                    "texto_boton" => $registro['texto_boton'],
                    "link_boton" => $registro['link_boton'],
                    "imagen" => $registro['imagen'],
                    "orden" => $registro['orden'],
                    //"id" => $registro['id'],
                    "activo" => $registro['activo']
                ];
                array_push($lista, $objeto);
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
        return $lista;
    }

    public function getById(Indicador $_actual)
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT indi.id indi_id, indi.codigo indi_codigo, indi.nombre, indi.unidad_medida_id, unme.simbolo, unme.codigo unme_codigo, unme.nombre_singular, unme.nombre_plural, indi.valor, indi.activo FROM indicador indi INNER JOIN unidad_medida unme ON (indi.unidad_medida_id = unme.id) WHERE indi.id=" . $_actual->getId();
        // echo $query;
        $rs = mysqli_query($con->getConnection(), $query);
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $registro['activo'] = $registro['activo'] == 1 ? true : false;
                $objeto = [
                    "id" => $registro['indi_id'],
                    "codigo" => $registro['indi_codigo'],
                    "nombre" => $registro['nombre'],
                    "valor" => $registro['valor'],
                    "unidad_medida" => [
                        "id" => $registro['unidad_medida_id'],
                        "simbolo" => $registro['simbolo'],
                        "codigo" => $registro['unme_codigo'],
                        "nombre" => [
                            "singular" => $registro['nombre_singular'],
                            "plural" => $registro['nombre_plural'],
                        ],
                    ],
                    "activo" => $registro['activo']
                ];
                array_push($lista, $objeto);
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
        return $lista[0];
    }

    public function add(Indicador $_nuevo)
    {
        $con = new Conexion();
        $nuevoId = count($this->getAll()) + 1;
        $query = "INSERT INTO indicador (id, codigo, nombre, unidad_medida_id, valor, activo) VALUES (" . $nuevoId . " ,'" . $_nuevo->getCodigo() . "', '" . $_nuevo->getNombre() . "', " . $_nuevo->getUnidadMedidaId() . ", " . $_nuevo->getValor() . ", TRUE)";
        try {
            $rs = mysqli_query($con->getConnection(), $query);
            $con->closeConnection();
            if ($rs) {
                return true;
            }
        } catch (\Throwable $th) {
            echo 'Error al agregar: ' + $th;
            return false;
        }
    }

    public function disable(Indicador $_actual)
    {
        $con = new Conexion();
        $query = "UPDATE indicador SET activo = 0 WHERE id = " . $_actual->getId();
        // echo $query;
        try {
            $rs = mysqli_query($con->getConnection(), $query);
            $con->closeConnection();
            if ($rs) {
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            echo 'Error al agregar: ' + $th;
            return false;
        }
    }

    public function enable(Indicador $_actual)
    {
        $con = new Conexion();
        $query = "UPDATE indicador SET activo = 1 WHERE id = " . $_actual->getId();
        // echo $query;
        try {
            $rs = mysqli_query($con->getConnection(), $query);
            $con->closeConnection();
            if ($rs) {
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            echo 'Error al agregar: ' + $th;
            return false;
        }
    }

    public function update(Indicador $_nuevo)
    {
        $con = new Conexion();
        $query = "UPDATE indicador SET codigo='" . $_nuevo->getCodigo() . "', nombre='" . $_nuevo->getNombre() . "', unidad_medida_id=" . $_nuevo->getUnidadMedidaId() . ", valor=" . $_nuevo->getValor() . " WHERE id=" . $_nuevo->getId();
        //echo $query;
        try {
            $rs = mysqli_query($con->getConnection(), $query);
            $con->closeConnection();
            if ($rs) {
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            echo 'Error al agregar: ' + $th;
            return false;
        }
    }
}
