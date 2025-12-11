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
    private $titulo;
    private $subtitulo;
    private $texto_boton;
    private $link_boton;
    private $imagen;
    private $orden;
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
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }
    public function getTextoboton()
    {
        return $this->texto_boton;
    }
    public function getLinkboton()
    {
        return $this->link_boton;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function getOrden()
    {
        return $this->orden;
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
    public function setSubtitulo($_n)
    {
        $this->subtitulo = $_n;
    }
    public function setTextoboton($_n)
    {
        $this->texto_boton = $_n;
    }
    public function setLinkboton($_n)
    {
        $this->link_boton = $_n;
    }
    public function setImagen($_n)
    {
        $this->imagen = $_n;
    }
    public function setOrden($_n)
    {
        $this->orden = $_n;
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
        //$query = "SELECT indi.id indi_id, indi.codigo indi_codigo, indi.nombre, indi.unidad_medida_id, unme.simbolo, unme.codigo unme_codigo, unme.nombre_singular, unme.nombre_plural, indi.valor, indi.activo FROM indicador indi INNER JOIN unidad_medida unme ON (indi.unidad_medida_id = unme.id) WHERE indi.id=" . $_actual->getId();
        // echo $query;
        $query = "SELECT * FROM hero WHERE id=" . $_actual->getId();
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
        return $lista[0] ?? null;
    }

    public function add(Indicador $_nuevo)
    {
        $con = new Conexion();
        $nuevoId = count($this->getAll()) + 1;
        $query = "INSERT INTO hero (id, titulo, subtitulo, texto_boton, link_boton, imagen, orden, activo) VALUES (" . $nuevoId . " , '" . $_nuevo->getTitulo() . "', '" . $_nuevo->getSubtitulo() . "',  '" . $_nuevo->getTextoboton() . "',  '" . $_nuevo->getLinkboton() . "', '" . $_nuevo->getImagen() . "','" . $_nuevo->getOrden() . "', TRUE)";

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
        $query = "UPDATE hero SET activo = 0 WHERE id = " . $_actual->getId();
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
        $query = "UPDATE hero SET activo = 1 WHERE id = " . $_actual->getId();
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
        $query = "UPDATE hero SET titulo='" . $_nuevo->getTitulo() . "', subtitulo='" . $_nuevo->getSubtitulo() . "', texto_boton='" . $_nuevo->getTextoboton() ."', link_boton='" . $_nuevo->getLinkboton() ."', imagen='" . $_nuevo->getImagen() ."', orden=" . $_nuevo->getOrden() .  " WHERE id=" . $_nuevo->getId();
        
        //$query = "UPDATE indicador SET codigo='" . $_nuevo->getCodigo() . "', nombre='" . $_nuevo->getNombre() . "', unidad_medida_id=" . $_nuevo->getUnidadMedidaId() . ", valor=" . $_nuevo->getValor() . " WHERE id=" . $_nuevo->getId();
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
