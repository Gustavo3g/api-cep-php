<?php
class Endereco {

    // database connection and table name
    private $conn;

    // object properties
    public $id;
    public $cep;
    public $logradouro;
    public $bairro;
    public $localidade;
    public $uf;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM enderecos ORDER BY id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();
        return $stmt;
    }

    function create(){

        $query = "INSERT INTO enderecos (cep,logradouro,bairro, localidade, uf) VALUES ('".$this->cep."','".$this->logradouro."','".$this->bairro."','".$this->localidade."','".$this->uf."')";

        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        return true;

        }else{
            return false;
        }

    }
     function readOne(){
        $query = "SELECT * FROM enderecos WHERE id = '".$this->id."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->cep = $row['cep'];
        $this->logradouro = $row['logradouro'];
        $this->bairro = $row['bairro'];
        $this->localidade = $row['localidade'];
        $this->uf = $row['uf'];
    }

    public function update(){
        $query = "UPDATE enderecos 
        SET 
            cep = '".$this->cep."', 
            logradouro ='".$this->logradouro."',
            bairro = '".$this->bairro."',
            localidade = '".$this->localidade."', 
            uf = '".$this->uf."' 
            WHERE id = '".$this->id."' ";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function delete($id){
        $query = "DELETE FROM enderecos WHERE id = '".$id."'";

        $stmt = $this->conn->prepare($query);

         if($stmt->execute()){
            return true;
        }
        return false;


    }

}
?>