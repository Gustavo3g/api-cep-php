<?php

// required headers
$headers = apache_request_headers();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../objects/cep.php';

// get database connection
$database = new Database();
$db = $database->getConnection();


$endereco = new Endereco($db);

// get endereco id
//$data = json_decode(file_get_contents("php://input"));

$id= $_GET['id'];


if($endereco->delete($id) && $headers['Access-Control-Allow-Methods'] == 'DELETE'){

    // set response code - 200 ok
    http_response_code(200);

    echo json_encode(array("message" => "Endereço deletado."));
}


else{
    // set response code - 503
    http_response_code(503);


    echo json_encode(array("message" => "Endereço não encontrado."));
}
?>