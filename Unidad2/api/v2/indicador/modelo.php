<?php
/*
CREATE TABLE unidad_medida(
    id  INT PRIMARY KEY AUTO_INCREMENT,
    simbolo VARCHAR(5) NOT NULL,
    codigo VARCHAR(5) NOT NULL UNIQUE,
    nombre_singular VARCHAR(50) NOT NULL,
    nombre_plural VARCHAR(50) NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE indicador(
    id  INT PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(10) NOT NULL UNIQUE,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    unidad_medida_id INT NOT NULL,
    valor DECIMAL(7,2) NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT FALSE,
    CONSTRAINT fk_indicador_unidad_medida FOREIGN KEY (unidad_medida_id) REFERENCES unidad_medida (id)
);

INSERT INTO unidad_medida (simbolo, codigo, nombre_singular, nombre_plural, activo)
VALUES ('$', 'CLP', 'Peso Chileno', 'Pesos Chilenos', TRUE);

INSERT INTO indicador (codigo, nombre, unidad_medida_id, valor, activo)
VALUES ('UF', 'Unidad de Fomento', 1, 39551.80, TRUE);
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
        $query = "SELECT indi.id indi_id, indi.codigo indi_codigo, indi.nombre, indi.unidad_medida_id, unme.simbolo, unme.codigo unme_codigo, unme.nombre_singular, unme.nombre_plural, indi.valor, indi.activo FROM indicador indi INNER JOIN unidad_medida unme ON (indi.unidad_medida_id = unme.id);";
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
        return $lista;
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
}
