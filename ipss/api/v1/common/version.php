<?php
// Configuracion de los Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, PATCH, PUT, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Content-Type: application/json; charset=UTF-8");

// Responder a preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$_host = $_SERVER['HTTP_HOST'];
$_method = $_SERVER['REQUEST_METHOD'];
$_uri = $_SERVER['REQUEST_URI'];
$_partes = explode('/', $_uri);
//echo '<1ero>' . $_method;
// print_r($_partes);
// print_r(count($_partes) - 1);


//$_parametros = explode('?', $_partes[count($_partes) - 1])[1];
//$_parametroID = explode('id=', $_parametros)[1];

//$_parametroID = isset($_GET['id']) ? intval($_GET['id']) : null;
//$serid = isset($_GET['serid']) ? intval($_GET['serid']) : null;
//$hero = isset($_GET['hero']) ? intval($_GET['hero']) : null;
//$ejem = isset($_GET['ejem']) ? intval($_GET['ejem']) : null;


if(isset(explode('?', $_partes[count($_partes) - 1])[1])){
    $_parametros = '?' . explode('?', $_partes[count($_partes) - 1])[1];
} else {
    $_parametros = null;
}


if(isset(explode('?id=', $_parametros)[1])){
    $_parametroID = explode('?id=', $_parametros)[1];
} else {
    $_parametroID = null;
}



// Seguridad de la Authorization
$_autorizar = null;
$headers = getallheaders();

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