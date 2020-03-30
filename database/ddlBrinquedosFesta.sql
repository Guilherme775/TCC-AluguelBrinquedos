USE mysql;

DROP DATABASE BrinquedosFesta;

CREATE DATABASE BrinquedosFesta CHARACTER SET UTF8 COLLATE=utf8_unicode_ci; /* criação do BD */

USE BrinquedosFesta; -- usar o bd BRINQUEDOSFESTA

/*Tabelas de usuarios são separadas por terem diferentes dados armazenados*/

-- para admin, supervisor e cliente
CREATE TABLE Usuario(
	CodUsuario SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(50),
    Email VARCHAR(50),-- para recuperar senha
    Login VARCHAR(25),
    Senha VARCHAR(40),/*para criptografia*/
    Tipo ENUM('super','Administrador','Moderador') -- moderador pode fazer os pedidos
);

/* Criação da tabela EQUIPAMENTO Tudo relacionado com o EQUIPAMENTO */
CREATE TABLE Equipamento(
	CodEquipamento SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100),
    Descricao VARCHAR(1000),
    Peso DECIMAL(7,2),/*em KG*/
    Altura DECIMAL(7,2),/*em Metros*/
    Comprimento DECIMAL(7,2),/*em Metros*/
    Largura DECIMAL(7,2),/*em Metros*/
    Preco DECIMAL(8,2),
    Status ENUM('Alugado','Disponivel'),
    Imagem VARCHAR(100)
);

	
/*
CREATE TABLE Imagens(
	Imagem VARCHAR(100),
    CodEquipamento SMALLINT,
    
    CONSTRAINT FK_Equipamento_Imagens FOREIGN KEY (CodEquipamento) 
		REFERENCES Equipamento(CodEquipamento)
);*/
    
-- Normalização, criação da tabela DATAS
CREATE TABLE DatasDisponivel(
	DataInicial DATETIME NOT NULL,
    DataFinal DATETIME NOT NULL,
	
    CodEquipamento SMALLINT NOT NULL, -- pesquisar normalização
    
    CONSTRAINT FK_Equipamento_Datas FOREIGN KEY (CodEquipamento)
    REFERENCES Equipamento(CodEquipamento)
);

/* Visivel para o CLIENTE e para o ADMINISTRADOR */
CREATE TABLE Pedido(
	CodPedido INT(5) NOT NULL PRIMARY KEY,

    CPF CHAR(11) NOT NULL,/*opcinal para o cliente */
    Nome VARCHAR(50),
    Telefone CHAR(10),
    Celular CHAR(11),
    Email VARCHAR(50),
    
    CEP CHAR(8),
    Endereco VARCHAR(200),
    Numero VARCHAR(5),
    Bairro VARCHAR(50),
    Complemento VARCHAR(50),
    
    
    DataPedido DATETIME, -- hora do envio do pedido 
    Data_de_uso DATE, -- 1970-12-31
    HorasAlugado DOUBLE,  -- Quantidade de horas de aluguel,aluguel cobrado por hora
    Hora_Montagem TIME, -- 1970-01-01 00:00:00
    Frete DECIMAL(8,2),-- preço com o frete
    FormaPagamento ENUM('Dinheiro','Cartão','Mercado Pago'),
    Status ENUM('Pendente', 'Realizado'),
    Supervisao BIT-- se tem supervisor adiciona tanto no preço
); 

CREATE TABLE Itens(
	CodItem SMALLINT NOT NULL PRIMARY KEY auto_increment,
    CodPedido INT(5) NOT NULL,
    CodEquipamento SMALLINT NOT NULL,
    Preco DECIMAL(8,2), -- preço do equipamento novamente, campo a ser preenchido depois / não vai pegar esse preço do banco de dados
    
    
	CONSTRAINT FK_Pedido_Itens FOREIGN KEY (CodPedido) 
		REFERENCES Pedido(CodPedido),
 
	CONSTRAINT FK_Equipamento_Itens FOREIGN KEY (CodEquipamento) 
		REFERENCES Equipamento(CodEquipamento)
);

INSERT INTO `usuario` (`CodUsuario`, `Nome`, `Email`, `Login`, `Senha`, `Tipo`) VALUES
(1, 'Daniel', 'daniel@gmail.com', 'Daniel', 'd0ae5744f1ba8b6cf2db51985d2047332fdc00cb', 'Administrador'),
(2, 'Pedro', 'pedro@gmail.com', 'pedro', 'a3dd91d922fcff42f64ac37e9140b02a00e4ce01', 'Administrador'),
(4, 'Luiz', 'luiz@gmail.com', 'luiz', 'a3dd91d922fcff42f64ac37e9140b02a00e4ce01', 'Administrador'),
(6, 'Fabricio', 'fabricio@gmail.com', 'fabricio', 'a3dd91d922fcff42f64ac37e9140b02a00e4ce01', 'Administrador'),
(8, 'Guilherme', 'guilherme@gmail.com', 'guilherme', 'a3dd91d922fcff42f64ac37e9140b02a00e4ce01', 'Administrador');

INSERT INTO Equipamento (`Nome`, `Descricao`, `Peso`, `Altura`, `Comprimento`, `Largura`, `Preco`, `Status`, `Imagem`) 
VALUES
('Castelo Infável', 'Brinquedos infláveis fazem a alegria da criançada em qualquer festa infantil, são brinquedos que chamam muito a atenção e proporcionam horas de muita diversão.', '0.00', '0.00', '0.00', '0.00', '544.00', 'Disponivel', '5ddb04bcaaa78.jpg'),
('Cama elástica', 'A cama elástica é sempre o brinquedo mais querido e procurado nas festas e não há criança que não goste de passar horas pulando e brincando sem parar, por isso, é um brinquedo ideal para buffets, condomínios, clubes, casas e hotéis.', '0.00', '0.00', '0.00', '0.00', '200.50', 'Disponivel', '5ddb04ea23e38.jpg'),
('Piscina de bolinhas', 'Uma festa infantil não é uma festa sem uma piscina de bolinhas, ela é um item indispensável que vai encantar as crianças e deixar a festa muito mais divertida!', '0.00', '0.00', '0.00', '0.00', '120.99', 'Disponivel', '5ddb04af0d2f0.jpg'),
('Máquina de Algodão Doce', 'Uma Máquina de Algodão Doce é um acessório indispensável para deixar uma festinha infantil ainda mais divertida para as crianças, até mesmo para os adultos. Aqui na Magia Brinquedos nós temos modelos de alta qualidade, fácil manejo e transporte e com preços incríveis. Confira os nosso produtos!', '0.00', '0.00', '0.00', '0.00', '232.65', 'Disponivel', '5ddb04f7109a0.jpg');

INSERT INTO `pedido` (`CodPedido`, `CPF`, `Nome`, `Telefone`, `Celular`, `Email`, `CEP`, `Endereco`, `Numero`, `Bairro`, `Complemento`, `DataPedido`, `Data_de_uso`, `HorasAlugado`, `Hora_Montagem`, `Frete`, `FormaPagamento`, `Status`, `Supervisao`) VALUES
(22004, '11111111111', 'aa', '', '', 'a@11111a.com', '66666666', '6', '6', '6', '6', '2019-12-03 04:39:01', '2019-12-03', 8, '06:59:00', '35.00', 'Cartão', 'Pendente', b'1'),
(36301, '22222222222', 'Rodolfo', '', '', 'a@a.com', '22222222', '2', '2', '2', '', '2019-12-02 18:20:21', '2019-12-02', 2, '22:02:00', '29.00', 'Dinheiro', 'Pendente', b'1'),
(44833, '77777777777', 'Daniel2', '', '', 'a222@a.com', '77777777', 'reerrereer', '34', 'reerrere', '', '2019-12-03 05:08:20', '2019-12-03', 45, '05:04:00', '65.00', 'Dinheiro', 'Pendente', b'1'),
(87394, '42321478139', 'Daniel Felix Fernandes', '1199820957', '1139098852', 'Daniel@gmail.com', '07914060', 'Rua Olavo Bilac ', '425', 'Jardim Magalhães', 'Perto a Igreja Jesus', '2019-12-03 03:38:18', '2019-12-05', 5, '15:50:00', '25.00', 'Cartão', 'Pendente', b'1'),
(97611, '33333333333', 'Rodolfo', '', '', '3a@a.com', '33333333', '33', '33', '33', '', '2019-12-02 18:52:30', '2019-12-02', 33, '03:33:00', '29.00', 'Cartão', 'Realizado', b'1');

INSERT INTO `itens` (`CodItem`, `CodPedido`, `CodEquipamento`, `Preco`) VALUES
(1, 36301, 4, '232.65'),
(2, 36301, 2, '200.50'),
(3, 97611, 2, '200.50'),
(4, 97611, 1, '544.00'),
(5, 87394, 2, '200.50'),
(6, 87394, 1, '544.00'),
(7, 22004, 1, '544.00'),
(8, 22004, 3, '120.99'),
(9, 22004, 4, '232.65'),
(10, 44833, 2, '200.50'),
(11, 44833, 1, '544.00'),
(12, 44833, 3, '120.99'),
(13, 44833, 4, '232.65');


