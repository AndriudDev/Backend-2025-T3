<?php

// Configuracion de los Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");


$_host = $_SERVER['HTTP_HOST'];
$_method = $_SERVER['REQUEST_METHOD'];
$_uri = $_SERVER['REQUEST_URI'];
$_partes = explode('/', $_uri);

// print_r($_partes);
// print_r(count($_partes) - 1);


//$_parametros = explode('?', $_partes[count($_partes) - 1])[1];
//$_parametroID = explode('id=', $_parametros)[1];

$_parametroID = isset($_GET['id']) ? intval($_GET['id']) : null;
$serid = isset($_GET['serid']) ? intval($_GET['serid']) : null;
$ejem = isset($_GET['ejem']) ? intval($_GET['ejem']) : null;


// Seguridad de la Authorization
$_autorizar = null;
try {
    if(isset(getallheaders()['Authorization'])){
        $_autorizar = getallheaders()['Authorization'];
    }else{
        http_response_code(401);
        echo json_encode(['error' => 'No tiene autorización']);
    }
} catch (\Throwable $th) {
    echo 'Error inesperado: ' . $th;
}

// echo '<p>host: ' . $_host . '</p>';
// echo '<p>metodo: ' . $_method . '</p>';
// echo '<p>uri: ' . $_uri . '</p>';
// echo '<p>partes: ' . print_r($_partes) . '</p>';
// echo '<hr>';

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';