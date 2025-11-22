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
    private $titulo;
    private $imagen;
    private $link;
    private $plan;
    private $activo;

    public function __construct() {}

    // accesadores
    public function getId()
    {
        return $this->id;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function getLink()
    {
        return $this->link;
    }
    public function getPlan()
    {
        return $this->plan;
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
    public function setTitulo($_n)
    {
        $this->titulo = $_n;
    }
    public function setImagen($_n)
    {
        $this->imagen = $_n;
    }
    public function setLink($_n)
    {
        $this->link = $_n;
    }
    public function setPlan($_n)
    {
        $this->plan = $_n;
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
        $query = $query = "SELECT * FROM ejemplos";
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
        $query = "INSERT INTO ejemplos (id, titulo, imagen, link, plan, activo) VALUES (" . $nuevoId . " , '" . $_nuevo->getTitulo() . "', '" . $_nuevo->getImagen() . "',  '" . $_nuevo->getLink() . "',  '" . $_nuevo->getPlan() . "', TRUE)";
        
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
        $query = "UPDATE ejemplos SET activo = 0 WHERE id = " . $_actual->getId();
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
        $query = "UPDATE ejemplos SET activo = 1 WHERE id = " . $_actual->getId();
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
