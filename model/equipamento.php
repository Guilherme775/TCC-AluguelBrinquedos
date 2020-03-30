<?php
class Equipamento
{
    private $CodEquipamento;
    private $Nome;
    private $Descricao;
    private $Peso;
    private $Altura;
    private $Comprimento;
    private $Largura;
    private $Preco;
    private $Status;
    private $Imagem;
/*
    CodEquipamento INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(20),
    Descricao VARCHAR(100),
    Peso DECIMAL(4,2),
    Altura DECIMAL(4,2),
    Comprimento DECIMAL(4,2),
    Largura DECIMAL(4,2),
    Preco DECIMAL(8,2),
    Status ENUM('Alugado','Disponivel')
*/
    //get e set 
    function __get($atributo)
    {
        return $this->$atributo;
    }
    function __set($atributo,$value)
    {
        $this->$atributo = $value;    
    }

    //conectar como BD
    private $con;
    /**
     * Class constructor.
     */
    function __construct()
    {
        include_once("conexao.php");
        $classe_con = new Conexao();
        $this->con = $classe_con->Conectar();
       
    }

    /*bindValue e PDO::PARAM_ serve para enviar cada tipo de dado de forma correta ao banco.
    Garante q o banco receba o parametro desejado*/
    function CadastrarEquipamento(){
        $comandoSQL = "INSERT INTO Equipamento(Nome,Descricao,Peso,Altura,Comprimento,Largura,Preco,Status,Imagem)
                            VALUES(?,?,?,?,?,?,?,?,?)";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$this->Nome,PDO::PARAM_STR);
        $exec->bindValue(2,$this->Descricao,PDO::PARAM_STR);
        $exec->bindValue(3,$this->Peso,PDO::PARAM_STR);
        $exec->bindValue(4,$this->Altura,PDO::PARAM_STR);
        $exec->bindValue(5,$this->Comprimento,PDO::PARAM_STR);
        $exec->bindValue(6,$this->Largura,PDO::PARAM_STR);
        $exec->bindValue(7,$this->Preco,PDO::PARAM_STR);
        $exec->bindValue(8,$this->Status,PDO::PARAM_STR);
        $exec->bindValue(9,$this->Imagem,PDO::PARAM_STR);
        $exec->execute();

        if ($exec->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }

    function ConsultarEquipamento(){
        try{
            $comandoSQL = " SELECT * FROM Equipamento";

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

    function RetornarDadosObj($CodEquipamento){
        $comandoSQL = "SELECT * FROM Equipamento WHERE CodEquipamento = ?";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$CodEquipamento,PDO::PARAM_INT);
        $exec->execute();

        if ($exec->rowCount() > 0) {

        return $exec->fetch(PDO::FETCH_OBJ);
        }
        else{
            return false;
        }

    }


    /*UPDATE ATUALIZA*/
    function AtualizarEquipamento(){
        //try {
            $comandoSQL = "UPDATE Equipamento 
                            SET Nome =?, 
                            Descricao = ?, 
                            Peso = ?, 
                            Altura = ?,
                            Comprimento = ?,
                            Largura = ?,
                            Preco = ?,
                            Status = ?,
                            Imagem = ?
                            WHERE CodEquipamento = ?";

            $exec = $this->con->prepare($comandoSQL);
            $exec->bindValue(1,$this->Nome,PDO::PARAM_STR);
            $exec->bindValue(2,$this->Descricao,PDO::PARAM_STR);
            $exec->bindValue(3,$this->Peso,PDO::PARAM_STR);
            $exec->bindValue(4,$this->Altura,PDO::PARAM_STR);
            $exec->bindValue(5,$this->Comprimento,PDO::PARAM_STR);
            $exec->bindValue(6,$this->Largura,PDO::PARAM_STR);
            $exec->bindValue(7,$this->Preco,PDO::PARAM_STR);
            $exec->bindValue(8,$this->Status,PDO::PARAM_STR);
            $exec->bindValue(9,$this->Imagem,PDO::PARAM_STR);
            $exec->bindValue(10,$this->CodEquipamento,PDO::PARAM_INT);
            $exec->execute();

            if ($exec->rowCount() > 0) {
                return true;
            }else{
                return false;
            }

        // } catch (PDOException $e) {
        //     echo $e->getMessage();
        // }
    }

    /*DELETE*/

    function ExcluirEquipamento($CodEquipamento){
        $comandoSQL = "DELETE FROM Equipamento WHERE CodEquipamento = ?";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$CodEquipamento,PDO::PARAM_INT);
        $exec->execute();

        if ($exec->rowCount() > 0) {
            return true;
        }
        else{
            return false;
        }
    }

    function RetornarDados($CodEquipamento){
        $comandoSQL = "SELECT * FROM Equipamento WHERE CodEquipamento = ?";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$CodEquipamento,PDO::PARAM_INT);
        $exec->execute();

        $dados = array();

        if ($exec->rowCount() > 0) {

            //return $exec->fetchAll(PDO::FETCH_OBJ);

                //laço de repetição para armazenar dados no vetor
            foreach ($exec->fetchAll() as $valores) {
                
                $equi = new Equipamento();


                $equi->CodEquipamento = $valores['CodEquipamento'];
                $equi->Nome = $valores['Nome'];
                $equi->Descricao = $valores['Descricao'];
                $equi->Peso = $valores['Peso'];
                $equi->Altura = $valores['Altura'];
                $equi->Comprimento = $valores['Comprimento'];
                $equi->Largura = $valores['Largura'];
                $equi->Preco = $valores['Preco'];
                $equi->Status = $valores['Status'];
                $equi->Imagem = $valores['Imagem'];
                
                $dados[] = $equi;
            }
        }
        else{
            $dados = false;
        }
       return $dados;//retorno da função   
    }

    function ConsultarDiferente($CodEquipamento){
        $comandoSQL = "SELECT * FROM Equipamento WHERE CodEquipamento != ?";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$CodEquipamento,PDO::PARAM_INT);
        $exec->execute();

        $dados = array();

        if ($exec->rowCount() > 0) {

            //return $exec->fetchAll(PDO::FETCH_ASSOC);

                //laço de repetição para armazenar dados no vetor
            foreach ($exec->fetchAll() as $valores) {
                
                $equi = new Equipamento();


                $equi->CodEquipamento = $valores['CodEquipamento'];
                $equi->Nome = $valores['Nome'];
                $equi->Descricao = $valores['Descricao'];
                $equi->Peso = $valores['Peso'];
                $equi->Altura = $valores['Altura'];
                $equi->Comprimento = $valores['Comprimento'];
                $equi->Largura = $valores['Largura'];
                $equi->Preco = $valores['Preco'];
                $equi->Status = $valores['Status'];
                $equi->Imagem = $valores['Imagem'];
                
                $dados[] = $equi;
            }
        }
        else{
            $dados = false;
        }
       return $dados;//retorno da função   
    }
}
?>