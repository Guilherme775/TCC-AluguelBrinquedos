USE BrinquedosFesta;


select * from pedido;

select * from itens where CodPedido = "36301";

select * FROM Pedido Where Status != "Realizado";

-- contatos do cliente
-- endereço completo 
-- itens do pedido
-- preco de tudo 


select p.*, e.Nome, i.Preco
from Pedido AS p inner JOIN Itens AS i inner join Equipamento AS e
on p.CodPedido = "36301" AND i.CodPedido = "36301"
Where e.CodEquipamento = i.CodEquipamento;



-- retorna o preco dos equipamento de um pedido
select SUM(Preco) from Itens where CodPedido = "97611";




SELECT E.Nome , E.Preco , D.DataDisponivel 
FROM Equipamento AS E INNER JOIN Datas AS D 
ON E.CodEquipamento = D.CodEquipamento; 
SELECT * FROM Cliente WHERE Nome LIKE 'Rodolfo%';


insert into Imagens (Imagem,CodEquipamento)
value ('1.jpg', 12);
insert into Imagens (Imagem,CodEquipamento)
value ('2.jpg', 12);
insert into Imagens (Imagem,CodEquipamento)
value ('3.jpg', 12);

select * from Imagens where CodEquipamento = 11;



SELECT * FROM Equipamento WHERE CodEquipamento != 12;

INSERT INTO Itens(CodPedido,CodEquipamento,Preco)
VALUES(1,1,'1000');







INSERT INTO  Administrador(Nome,Email,Login,Senha,NivelAcesso)
Values ('blabla', 'daniel@gmail.com','blaba213','123',1);

INSERT INTO  Cliente(Celular)
Values ('1234567897');

select * from cliente;

UPDATE Usuario 
SET Senha = '123'
WHERE Email = 'danielfernandesdk27@gmail.com';

SELECT * FROM Usuario 
WHERE Login = 'Daniel' AND Senha = 'a3dd91d922fcff42f64ac37e9140b02a00e4ce01' AND Tipo = 'Administrador';

INSERT INTO Equipamento (Nome,Descricao,Preco) 
VALUES ('Piscina de Bolinhas','100m X 200m',80.00);
INSERT INTO Equipamento (Nome,Descricao,Preco) 
VALUES ('Cama elástica','165m X 298m Material Super Elastico',120.00);
INSERT INTO Equipamento (Nome,Descricao,Preco) 
VALUES ('Castelo inflável','138m X 120m Anti-furo',150.00);
INSERT INTO Equipamento (Nome,Descricao,Preco) 
VALUES ('Alogão Doce','3 velocidades',100.00);


Select nome from equipamento where nome LIKE '%cama%';

SELECT E.Nome , E.Preco , D.DataDisponivel 
FROM Equipamento AS E INNER JOIN Datas AS D 
ON E.CodEquipamento = D.CodEquipamento; 
SELECT * FROM Cliente WHERE Nome LIKE 'Rodolfo%';

INSERT INTO Supervisao(CodSupervisao,TipoSupervisao,ValorSupervisao)
VALUES(0,0);

select * from Equipamento;

INSERT INTO Aluguel (CodCliente,CodEquipamento,DataAluguel,Data_de_uso,
HorasAlugado,DataMontagem,DataDesmontagem,EnderecoMontagem,
Supervisao,PrecoFinal,FormaPagamento) 
VALUES (1,4,'2019-07-30 02:30:55','2019-08-05',
3.5,'2019-08-05 14:00:00','2019-08-05 17:00:00','Rua das rosas, 485-Jardim Nemus',
0,556.47,'Cartão');
select * from Aluguel;

