<?php
require_once("../../model/Usuario.php");
$usuarios = new Usuario();
$usuarios->url = "https://jsonplaceholder.typicode.com/users/".$_GET['id']."/todos";
$result = array();



if($json =  $usuarios->getApi()){
    $result['status'] ="Ok";
    $result['data']   = $json;
}
else{
    $result['status'] = "Error";
    $result['mensaje'] = "Error al obtener  todos";
}
echo json_encode($result);
?>