<?php
header('Content-Type: application/json');
require_once("../../model/Usuario.php");
$usuarios = new Usuario();
$_POST = $data = json_decode( file_get_contents('php://input') ,true );
$usuarios->data = $_POST;
$usuarios->url = "https://jsonplaceholder.typicode.com/todos";
$result = array();
if($json =  $usuarios->postApi()){
    $result['status'] ="Ok";
    $result['data']   = $json;
}
else{
    $result['status'] = "Error";
    $result['mensaje'] = "Error al obtener el post";
}
echo json_encode($result);
?>