<?php
// required headers
$headers = apache_request_headers();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database
include_once '../config/database.php';
include_once '../objects/cep.php';


$database = new Database();
$db = $database->getConnection();

//echo "ok";
$endereco = new Endereco($db);
//echo "teste";
$data = json_decode(file_get_contents("php://input"));
// certificando que os dados não estão vazios
if(!empty($data->cep)){

    $cep_ = $data->cep;
    $url = "http://viacep.com.br/ws/$cep_/json/";
    $address = json_decode(file_get_contents($url));

    $endereco->cep = $address->cep;
    $endereco->logradouro = $address->logradouro;
    $endereco->bairro = $address->bairro;
    $endereco->localidade = $address->localidade;
    $endereco->uf = $address->uf;


    if($endereco->create()){
        // set response code - 201 created

        http_response_code(201);
        echo json_encode($address);

    } else{

        // set response code - 503
        http_response_code(503);

        echo json_encode(array("message" => "Não foi possivel criar o endereço."));
    }
} else {
    http_response_code(400);

    echo json_encode(array("message" => "Não foi possivel cadastrar o endereço, verifique o cep informado"));
}