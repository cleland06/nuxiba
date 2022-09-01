<?php
require_once("../../model/Usuario.php");
$usuarios = new Usuario();
$usuarios->url = "https://jsonplaceholder.typicode.com/post/".$_GET['id']."/comments";
$result = array();



if($json =  $usuarios->getApi()){
    $result['status'] ="Ok";
    $result['data']   = $json;
}
else{
    $result['status'] = "Error";
    $result['mensaje'] = "Error al obtener el post";
}
echo json_encode($result);
?>