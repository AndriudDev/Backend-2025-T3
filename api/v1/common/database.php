<?php
class Conexion
{
    private $connection;
    private $host;
    private $username;
    private $password;
    private $db;
    private $port;
    private $server;

    public function __construct()

    //{
    //    $this->server = $_SERVER['SERVER_NAME'];
    //    $this->connection = null;
    //    $this->host = '127.0.0.1'; // localhost
    //    $this->port = 3306;
    //    $this->db = 'creatuwebs';
    //    $this->username = 'creatuwebs';
    //    $this->password = 'creatuwebs_b4ck3nd';
    //}
    {
        $this->server = $_SERVER['SERVER_NAME'];
        $this->connection = null;
        $this->host = '127.0.0.1'; // localhost
        $this->port = 3306;
        $this->db = 'prored';
        $this->username = 'prored';
        $this->password = 'prored_b4ck3nd';
    }
    
    public function getConnection()
    {
        try {
            $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db, $this->port);
            mysqli_set_charset($this->connection, 'utf8'); // ñá¿
            if (!$this->connection) {
                throw new Exception(":( Error en la conexion: " + mysqli_connect_error());
            }
            return $this->connection;
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            die(":( Error en la conexion de la base de datos.");
        }
    }

    public function closeConnection()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
}
