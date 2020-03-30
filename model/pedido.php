<?php

class Pedido
{
    private $CodPedido;

    private $CPF;
    private $Nome;
    private $Email;
    private $Telefone;
    private $Celular;
    private $CEP;
    private $Endereco;
    private $Numero;
    private $Bairro;
    private $Complemento;

    private $DataPedido;
    private $Data_de_uso;
    private $HorasAlugado;
    private $Hora_Montagem;
    private $Frete;
    private $FormaPagamento;
    Private $Status;
    private $Supervisao;



    private $CodEquipamento;
    private $NomeEqui;
    private $Descricao;
    private $Peso;
    private $Altura;
    private $Comprimento;
    private $Largura;
    private $Preco;
    private $StatusEqui;
    private $Imagem;

/*

	CodPedido INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    CodCliente SMALLINT NOT NULL,
    DataPedido DATETIME, -- hora do envio do pedido 
    Data_de_uso DATE, -- 1970-12-31
    HorasAlugado DOUBLE,  -- Quantidade de horas de aluguel,aluguel cobrado por hora
    Hora_Montagem DATETIME, -- 1970-01-01 00:00:00
    PrecoFinal DECIMAL(8,2),-- preço com o frete
    FormaPagamento VARCHAR(20),
    Status BIT, -- saber se o pedido ja foi realizado 
    Supervisao BIT,-- se tem supervisor adiciona tanto no preço
    
    CONSTRAINT FK_Cliente_Pedido FOREIGN KEY (CodCliente)
		REFERENCES Cliente(CodCliente)*/

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

    
    function CadastrarPedido(){
        $comandoSQL = "INSERT INTO Pedido(CodPedido,CPF,Nome,Email,Celular,
        CEP,Endereco,Numero,Bairro,Complemento,DataPedido,Data_de_uso
        ,HorasAlugado,Hora_Montagem,Frete,FormaPagamento,Status,Supervisao,Telefone)
                            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$this->CodPedido,PDO::PARAM_INT);
        $exec->bindValue(2,$this->CPF,PDO::PARAM_STR);
        $exec->bindValue(3,$this->Nome,PDO::PARAM_STR);
        $exec->bindValue(4,$this->Email,PDO::PARAM_STR);
        $exec->bindValue(5,$this->Celular,PDO::PARAM_STR);
        $exec->bindValue(6,$this->CEP,PDO::PARAM_STR);
        $exec->bindValue(7,$this->Endereco,PDO::PARAM_STR);
        $exec->bindValue(8,$this->Numero,PDO::PARAM_STR);
        $exec->bindValue(9,$this->Bairro,PDO::PARAM_STR);
        $exec->bindValue(10,$this->Complemento,PDO::PARAM_STR);

        
        $exec->bindValue(11,$this->DataPedido,PDO::PARAM_STR);
        $exec->bindValue(12,$this->Data_de_uso,PDO::PARAM_STR);
        $exec->bindValue(13,$this->HorasAlugado,PDO::PARAM_STR);
        $exec->bindValue(14,$this->Hora_Montagem,PDO::PARAM_STR);
        $exec->bindValue(15,$this->Frete,PDO::PARAM_STR);
        $exec->bindValue(16,$this->FormaPagamento,PDO::PARAM_STR);
        $exec->bindValue(17,$this->Status,PDO::PARAM_STR);
        $exec->bindValue(18,$this->Supervisao,PDO::PARAM_STR);
        $exec->bindValue(19,$this->Telefone,PDO::PARAM_STR);
        //$this->con->lastInsertId(); pode rerornar um id errado se utilizado por varios usuarios
        $exec->execute();

        if ($exec->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }

    function CadastrarItens($CodPedido,$CodEquipamento,$Preco){

        $comandoSQL = "INSERT INTO Itens(CodPedido,CodEquipamento,Preco)VALUES(?,?,?)";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$CodPedido,PDO::PARAM_INT);
        $exec->bindValue(2,$CodEquipamento,PDO::PARAM_INT);
        $exec->bindValue(3,$Preco,PDO::PARAM_STR);
        
        $exec->execute();

        if ($exec->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }

    function ConsultarPedido(){
        try{
            $comandoSQL = " SELECT * FROM Pedido";

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

    function RetornarPrecoItem($CodPedido){
        try{
            $comandoSQL = "SELECT SUM(Preco) 'Preco' from Itens where CodPedido = ?";

            $exec = $this->con->prepare($comandoSQL);
            $exec->bindValue(1,$CodPedido,PDO::PARAM_INT);
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




    function RetornarDados($CodPedido){
        $comandoSQL = "SELECT * FROM Pedido WHERE CodPedido = ?";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$CodPedido,PDO::PARAM_INT);
        $exec->execute();

        if ($exec->rowCount() > 0) {

        return $exec->fetch(PDO::FETCH_OBJ);
        }
        else{
            return false;
        }

    }

    function AtualizarPedido(){
            $comandoSQL = "UPDATE Pedido
                            SET CodCliente = ?,
                            DataPedido = ?,
                            Data_de_uso = ?
                            ,HorasAlugado = ?
                            ,Hora_Montagem = ?
                            ,Frete = ?,
                            FormaPagamento = ?
                            ,Status = ?,
                            Supervisao = ?
                            WHERE CodPedido = ?";

            $exec = $this->con->prepare($comandoSQL);
            $exec->bindValue(1,$this->CodCliente,PDO::PARAM_INT);
            $exec->bindValue(2,$this->DataPedido,PDO::PARAM_STR);
            $exec->bindValue(3,$this->Data_de_uso,PDO::PARAM_STR);
            $exec->bindValue(4,$this->HorasAlugado,PDO::PARAM_STR);
            $exec->bindValue(5,$this->Hora_Montagem,PDO::PARAM_STR);
            $exec->bindValue(6,$this->Frete,PDO::PARAM_STR);
            $exec->bindValue(7,$this->FormaPagamento,PDO::PARAM_STR);
            $exec->bindValue(8,$this->Status,PDO::PARAM_INT);
            $exec->bindValue(9,$this->Supervisao,PDO::PARAM_STR);
            $exec->bindValue(10,$this->CodPedido,PDO::PARAM_INT);
            $exec->execute();

            if ($exec->rowCount() > 0) {
                return true;
            }else{
                return false;
            }
    }

    function ExcluirPedido($CodPedido){
        $comandoSQL = "DELETE FROM Itens WHERE CodPedido = ?;
                        DELETE FROM Pedido WHERE CodPedido = ?;
                        ";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$CodPedido,PDO::PARAM_INT);
        $exec->bindValue(2,$CodPedido,PDO::PARAM_INT);
        $exec->execute();

        if ($exec->rowCount() > 0) {
            return true;
        }
        else{
            return false;
        }
    }

    function UpdateStatusPedidoRealizado(){
        $comandoSQL = "UPDATE Pedido
                        SET Status = 'Realizado'
                        WHERE CodPedido = ?";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$this->CodPedido,PDO::PARAM_INT);
        $exec->execute();

        if ($exec->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }

    function UpdateStatusPedidoPendente(){
        $comandoSQL = "UPDATE Pedido
                        SET Status = 'Pendente'
                        WHERE CodPedido = ?";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$this->CodPedido,PDO::PARAM_INT);
        $exec->execute();

        if ($exec->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }

    function ConsultarPedidoEquipamento($CodPedido){
        $comandoSQL = "SELECT p.*, e.Nome 'Equipamento', i.Preco
                        from Pedido AS p inner JOIN Itens AS i inner join Equipamento AS e
                        on p.CodPedido = ? AND i.CodPedido = ?
                        Where e.CodEquipamento = i.CodEquipamento;";

        $exec = $this->con->prepare($comandoSQL);
        $exec->bindValue(1,$CodPedido,PDO::PARAM_INT);
        $exec->bindValue(2,$CodPedido,PDO::PARAM_INT);
        $exec->execute();

        
        if ($exec->rowCount() > 0) {

        return $exec->fetchAll(PDO::FETCH_ASSOC);

            
        }
        else{
            return false;
        }
    }
}
?>