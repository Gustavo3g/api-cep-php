<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/cep.php';

$database = new Database();
$db = $database->getConnection();

$endereco = new Endereco($db);

$endereco->id = isset($_GET['id']) ? $_GET['id'] : die();

$endereco->readOne();

if($endereco->cep != null){

    $endereco_arr = array(
        "id" => $endereco->id,
        "cep" => $endereco->cep,
        "logradouro" => $endereco->logradouro,
        "bairro" => $endereco->bairro,
        "localidade" => $endereco->localidade,
        "uf" => $endereco->uf
    );
     // set response code - 200 OK
    http_response_code(200);
    // make it json format
    echo json_encode($endereco_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Endereço inexistente"));
}