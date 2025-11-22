<?php
/*
CREATE TABLE menu (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    link VARCHAR(200) NOT NULL,
    orden INT NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO menu ( nombre, link, orden, activo)
VALUES ('Inicio', '#home', 0, TRUE);

INSERT INTO menu ( nombre, link, orden, activo)
VALUES ('Portafolio', '#portafolio', 1, TRUE);

INSERT INTO menu ( nombre, link, orden, activo)
VALUES ('Servicios', '#servicios', 2, TRUE);

INSERT INTO menu ( nombre, link, orden, activo)
VALUES ('FAQ', 'https://creatuwebs.com/faq', 3, TRUE);

INSERT INTO menu ( nombre, link, orden, activo)
VALUES ('Contactanos', 'https://creatuwebs.com/contactanos', 4, TRUE);
*/
class Indicador
{
    private $id;
    private $nombre;
    private $orden;
    private $link;
    private $activo;

    public function __construct() {}

    // accesadores
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getOrden()
    {
        return $this->orden;
    }
    public function getLink()
    {
        return $this->link;
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
    public function setNombre($_n)
    {
        $this->nombre = $_n;
    }
    public function setOrden($_n)
    {
        $this->orden = $_n;
    }
    public function setLink($_n)
    {
        $this->link = $_n;
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
        $query = $query = "SELECT * FROM menu";
        $rs = mysqli_query($con->getConnection(), $query);
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $registro['activo'] = $registro['activo'] == 1 ? true : false;
                $objeto = [
                    "id" => $registro['id'],
                    "nombre" => $registro['nombre'],
                    "orden" => $registro['orden'],
                    "link" => $registro['link'],
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
        //$query = "SELECT * FROM menu WHERE id=" . $_actual->getId();
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
        $query = "INSERT INTO menu (id, nombre, link, orden, activo) VALUES (" . $nuevoId . " , '" . $_nuevo->getNombre() . "', '" . $_nuevo->getLink() . "',  " . $_nuevo->getOrden() . ", TRUE)";

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
        $query = "UPDATE menu SET activo = 0 WHERE id = " . $_actual->getId();
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
