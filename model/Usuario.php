<?php

class Usuario 
{ 

    private $curl;
    private $response;
    private $err;
    public  $url;
    public  $data;

    function __construct()
    {
        $this->curl = curl_init(); //inicia la sesión cURL

        
    }

    private function conectar($url = "https://jsonplaceholder.typicode.com/users",$metoth){
        $params = array(
            CURLOPT_URL => "$this->url", //url a la que se conecta
            CURLOPT_RETURNTRANSFER => true, //devuelve el resultado como una cadena del tipo curl_exec
            CURLOPT_FOLLOWLOCATION => true, //sigue el encabezado que le envíe el servidor
            CURLOPT_ENCODING => "", // permite decodificar la respuesta y puede ser"identity", "deflate", y "gzip", si está vacío recibe todos los disponibles.
            CURLOPT_MAXREDIRS => 10, // Si usamos CURLOPT_FOLLOWLOCATION le dice el máximo de encabezados a seguir
            CURLOPT_TIMEOUT => 30, // Tiempo máximo para ejecutar
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // usa la versión declarada
            CURLOPT_CUSTOMREQUEST => $metoth, // el tipo de petición, puede ser PUT, POST, GET o Delete dependiendo del servicio
        );

        ($this->data != "")? $params[CURLOPT_POSTFIELDS] = json_encode($this->data):null;
        
        curl_setopt_array($this->curl, $params); //curl_setopt_array configura las opciones para una transferencia cURL
        
        $this->response = curl_exec($this->curl);// respuesta generada
        $this->err = curl_error($this->curl); // muestra errores en caso de existir
        
        curl_close($this->curl); // termina la sesión 
        
        if ($this->err) {
            return "cURL Error #:" . $this->err; // mostramos el error
        } else {
            return $this->response; // en caso de funcionar correctamente
        }
    }

    public function getApi(){

        $result = $this->conectar($this->url,'GET');
        return json_decode($result);
    }

    public function postApi(){

        $result = $this->conectar($this->url,'POST');
        return json_decode($result);
    }

    



}

?>