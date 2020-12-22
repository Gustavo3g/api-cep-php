<?php
// required headers
//$headers = apache_request_headers();
//
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Content-Type: aplication/xls");
header("Content-Disposition:attachment; filename = exelcep.xls");
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
    $enderecos_arr = array();

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
        array_push($enderecos_arr, $endereco_item);
    }
//    var_dump($enderecos_arr);

//    exit();
    $arqexel = "<meta charset='UTF-8'>";

    $arqexel .= "<table border='1'>
    <thead>
        <tr>
            <th>CEP</th>
            <th>Logradouro</th>
            <th>Bairro</th>
            <th>Localidade</th>
            <th>Uf</th>
        </tr>
    </thead>
    <tbody>";
    foreach ($enderecos_arr as $adress){
        $arqexel .="  
                <tr>
                <td>{$adress['cep']}</td>
                <td>{$adress['logradouro']}</td>
                <td>{$adress['bairro']}</td>
                <td>{$adress['localidade']}</td>
                <td>{$adress['uf']}</td>
                </tr>";
    }
    $arqexel .= "</tbody>
                    </table>";


    echo $arqexel;


}