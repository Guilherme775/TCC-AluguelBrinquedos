<?php

class cliente
{
    private $CodCliente;
    private $CPF;
    private $Nome;
    private $Email;
    private $Celular;
    private $CEP;
    private $Endereco;
    private $Numero;
    private $Bairro;
    private $Complemento;

    function __get($atributo)
    {
        return $this->$atributo;
    }
    function __set($atributo,$value)
    {
        $this->$atributo = $value;    
    }

    private $con;
    
    function __construct()
    {
        include_once("conexao.php");
        $classe_con = new Conexao();
        $this->con = $classe_con->Conectar();
    }

    function CadastrarCliente(){
        $comandoSQL = "INSERT INTO cliente(CPF,Nome,Email,Celular,
        CEP,Endereco,Numero,Bairro,Complemento)
                        VALUES (?,?,?,?,?,?,?,?,?)";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$this->CPF,PDO::PARAM_STR);
        $exec->bindValue(2,$this->Nome,PDO::PARAM_STR);
        $exec->bindValue(3,$this->Email,PDO::PARAM_STR);
        $exec->bindValue(4,$this->Celular,PDO::PARAM_STR);
        $exec->bindValue(5,$this->CEP,PDO::PARAM_STR);
        $exec->bindValue(6,$this->Endereco,PDO::PARAM_STR);
        $exec->bindValue(7,$this->Numero,PDO::PARAM_STR);
        $exec->bindValue(8,$this->Bairro,PDO::PARAM_STR);
        $exec->bindValue(9,$this->Complemento,PDO::PARAM_STR);

        $exec->execute();

        if ($exec->rowCount() > 0) {
            return true;
        }else{
        return false;
        }
    }

    function ConsultarCliente(){
        try{
        $comandoSQL = "SELECT * FROM cliente";

        $exec = $this->con->prepare($comandoSQL);
            $exec->execute();

            if ($exec->rowCount() > 0) {
                return $exec->fetchAll(PDO::FETCH_OBJ);//retorna todos como objeto
            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function RetornarDados($CodCliente){
        $comandoSQL = "SELECT * FROM cliente WHERE CodCliente = ?";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$CodCliente,PDO::PARAM_INT);
        $exec->execute();

        if ($exec->rowCount() > 0) {

        return $exec->fetch(PDO::FETCH_OBJ);
        }
        else{
            return false;
        }

    }

    function AtualizarCliente(){
        $comandoSQL = "UPDATE cliente
                        SET CPF = ?,
                        Nome = ?,
                        Email = ?,
                        Celular = ?,
                        CEP = ?,
                        Endereco = ?,
                        Numero = ?,
                        Bairro = ?,
                        Complemento = ?
                        WHERE CodCliente = ?";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$this->CPF,PDO::PARAM_STR);
        $exec->bindValue(2,$this->Nome,PDO::PARAM_STR);
        $exec->bindValue(3,$this->Email,PDO::PARAM_STR);
        $exec->bindValue(4,$this->Celular,PDO::PARAM_STR);
        $exec->bindValue(5,$this->CEP,PDO::PARAM_STR);
        $exec->bindValue(6,$this->Endereco,PDO::PARAM_STR);
        $exec->bindValue(7,$this->Numero,PDO::PARAM_STR);
        $exec->bindValue(8,$this->Bairro,PDO::PARAM_STR);
        $exec->bindValue(9,$this->Complemento,PDO::PARAM_STR);
        $exec->bindValue(10,$this->CodCliente,PDO::PARAM_INT);
        $exec->execute();

        if ($exec->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
}

    function ExcluirCliente(){
        $comandoSQL = "DELETE FROM cliente WHERE CodCliente = ?";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$this->CodCliente,PDO::PARAM_INT);
        $exec->execute();

        if ($exec->rowCount() > 0) {
            return true;
         }
        else{
            return false;
        }
    }
}
?>