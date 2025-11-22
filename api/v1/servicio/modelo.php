<?php
/*
CREATE TABLE servicio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    precio INT NOT NULL,
    descripcion VARCHAR(300),
    color_tema VARCHAR(20),
    detalles JSON,              -- aquí van las características del plan
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO servicio 
(nombre, precio, descripcion, color_tema, detalles, activo)
VALUES
(
    'Página Web Básica',
    59990,
    'Ideal para emprendedores o negocios pequeños.',
    'secondary',
    '[
        "Diseño personalizado",
        "Hasta 4 páginas",
        "5 Correos Corporativos",
        "Diseño Responsive",
        "Alta en Buscadores",
        "Dominio y hosting (1 año)",
        "Botón Redes Sociales",
        "Certificado SSL",
        "Soporte básico",
        "Botón Contacto Whatsapp",
        "Mapa Ubicación Google Maps",
        "Capacitación"
    ]',
    TRUE
),
(
    'Página Web Autoadministrable',
    109990,
    'Incluye panel para editar contenidos sin conocimientos técnicos.',
    'primary',
    '[
        "Diseño personalizado",
        "Hasta 10 páginas",
        "10 Correos Corporativos",
        "Diseño Responsive",
        "Alta en Buscadores",
        "Dominio y hosting (1 año)",
        "Botón Redes Sociales",
        "Certificado SSL",
        "Soporte básico",
        "Botón Contacto Whatsapp",
        "Mapa Ubicación Google Maps",
        "Posicionamiento Google (SEO)",
        "Sitio Autoadministrable",
        "Formulario de Contacto",
        "Crear Textos e imágenes",
        "Capacitación"
    ]',
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
        $query = $query = "SELECT * FROM servicio";
        $rs = mysqli_query($con->getConnection(), $query);
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $registro['activo'] = $registro['activo'] == 1 ? true : false;
                $objeto = [
                    "id" => $registro['id'],
                    "nombre" => $registro['nombre'],
                    "precio" => $registro['precio'],
                    "descripcion" => $registro['descripcion'],
                    "color_tema" => $registro['color_tema'],
                    "detalles" => json_decode($registro['detalles']),
                    //"font" => $registro['font'],
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
