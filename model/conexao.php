<?php
class Conexao{

     private $host = 'localhost';
     private $usuario = 'root';
     private $senha = '';
     private $bd = 'BrinquedosFesta';

    function Conectar(){
        try {
        $con = new PDO (
            "mysql:host=$this->host;dbname=$this->bd;charset=utf8",
            "$this->usuario",
            "$this->senha");

            //$con->exec("set names utf8");//resolver o problema dos caracteres
            //$con->exec("SET CHARACTER SET utf8");//resolver o problema dos caracteres
            //para exibir erro
            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $con;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>