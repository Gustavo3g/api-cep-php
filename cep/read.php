<?php
// required headers
//$headers = apache_request_headers();
//
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//a conexão do banco de dados estará aqui

include_once '../config/database.php';
include_once '../objects/cep.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$enderecos = new Endereco($db);

$stmt = $enderecos->read();
$num = $stmt->rowCount();

if($num > 0 ){
    $enderecos_arr = array();
    $enderecos_arr['registros'] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $endereco_item=array(
            "id" => $id,
            "cep" => $cep,
            "logradouro" => $logradouro,
            "bairro" => $bairro,
            "localidade" => $localidade,
            "uf" => $uf
        );
        array_push($enderecos_arr['registros'], $endereco_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($enderecos_arr);
} else {
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "Nenhum endereço encontrado.")
    );
}
