create database loja;
use loja;
CREATE TABLE vendedor (
   cod_vendedor INTEGER(3) PRIMARY KEY NOT NULL,
   nome_vendedor VARCHAR(15) NOT NULL,
   salario_vendedor INTEGER NOT NULL,
   comissao_vendedor CHAR NOT NULL
);

CREATE TABLE cliente (
   cod_cliente INTEGER(3) PRIMARY KEY NOT NULL,
   nome_cliente VARCHAR (15) NOT NULL,
   endereco_cliente VARCHAR(30) NOT NULL,
   cidade_cliente VARCHAR(30) NOT NULL,
   cidade_cep VARCHAR(30) NOT NULL,
   uf_cliente VARCHAR(2) NOT NULL,
   cgc_cliente VARCHAR(30) NOT NULL,
   ie_cliente VARCHAR(4) NULL 
);

CREATE TABLE produto (
	cod_produto INTEGER(3) PRIMARY KEY NOT NULL,
	unidade_produto VARCHAR(3) NOT NULL,
	desc_produto VARCHAR(20) NOT NULL,
	valor_unitario INTEGER(8) NOT NULL,
    prod_status int default 0,
    qtd integer not null
);

CREATE TABlE pedido (
	cod_pedido INTEGER(3) PRIMARY KEY NOT NULL,
	prazo_entrega INTEGER(2) NOT NULL,
	cod_cliente INTEGER(3) NOT NULL,
	cod_vendedor INTEGER(3) NOT NULL,
    ped_status int default 0,
    ped_date date,
	CONSTRAINT fk_cod_cliente FOREIGN KEY (cod_cliente) REFERENCES cliente(cod_cliente),
	CONSTRAINT fk_cod_vendedor FOREIGN KEY (cod_vendedor) REFERENCES vendedor(cod_vendedor)
	on delete cascade
    on update cascade
);



CREATE TABLE item_pedido (
	cod_pedido INTEGER(3) NOT NULL,
	cod_produto INTEGER(3) NOT NULL,
	qtd_pedido INTEGER(3) NOT NULL,
    item_status int default 0,
	PRIMARY KEY (cod_pedido, cod_produto),
	CONSTRAINT fk_cod_pedido FOREIGN KEY (cod_pedido) REFERENCES pedido(cod_pedido),
	CONSTRAINT fk_cod_produto FOREIGN KEY (cod_produto) REFERENCES produto(cod_produto)
    on delete cascade
    on update cascade
);

INSERT INTO cliente VALUES (720, 'Ana', 'Rua 17 n. 19', 'Niterói', '24358310', 'rj', '12113231/0001-24', '2134');
INSERT INTO cliente VALUES (870, 'Flávio', 'Av. Pres. Vargas 10', 'São Paulo', '22763931', 'sp', '22534126/9387-9', '4631');
INSERT INTO cliente VALUES (110, 'Jorge', 'Rua Caiapo 131', 'Curitiba', '30078500', 'pr', '14512764/9834-8', '0');
INSERT INTO cliente VALUES (222, 'Lúcia', 'Rua Itabira 123 Loja 9', 'Belo Horizonte', '22124391', 'mg', '28315213/9348-8', '2985');
INSERT INTO cliente VALUES (830, 'Maurício', 'Av.  Paulista 1236 sl/2345', 'São Paulo', '3012683', 'sp', '2316985/7465-6', '9343');
INSERT INTO cliente VALUES (130, 'Edmar', 'Rua da Praia sn/', 'Salvador', '30079300', 'ba', '23463284/234-9', '7121');
INSERT INTO cliente VALUES (410, 'Rodolfo', 'Largo da Lapa 27 sobrado', 'Rio de Janeiro', '30078900', 'rj', '12835128/2346-6', '7431');
INSERT INTO cliente VALUES (20,  'Beth', 'Av. Climério n. 45', 'São Paulo', '25679300', 'sp', '32485126/7326-8', '9280');
INSERT INTO cliente VALUES (157, 'Paulo', 'Tv. Moraes c/3', 'Lodrina', ' ', 'pr', '32848223/324-2', '1923');
INSERT INTO cliente VALUES (180, 'Lívio', 'Av. Beira Mar n. 1256', 'Florianópolis', '30077500', 'sc', '12736571/2147-4', '0');
INSERT INTO cliente VALUES (260, 'Susana', 'Rua Lopes Mendes 12', 'Niterói', '30046500', 'rj', '21763571/232-9', '2530');
INSERT INTO cliente VALUES (290, 'Renato', 'Rua Meireles n. 123 bl.2', 'São Paulo', '30225900', 'sp', '13276571/1231-4', '1820');
INSERT INTO cliente VALUES (390, 'Sebastião', 'Rua da Igreja n. 10', 'Uberaba', '30438700', 'mg', '32176547/213-3', '9071');

INSERT INTO produto VALUES (25, 'KG', 'Queijo', '0.97',0, 130);
INSERT INTO produto VALUES (31, 'BAR', 'Chocolate', '0.87',0, 150 );
INSERT INTO produto VALUES (78, 'L', 'Vinho', '2.00',0,210);
INSERT INTO produto VALUES (22, 'M', 'Linho', '0.11',0,250);
INSERT INTO produto VALUES (30, 'SAC', 'Açúcar', '0.3',0,230);
INSERT INTO produto VALUES (53, 'M', 'Linha', '1.8',0,440);
INSERT INTO produto VALUES (13, 'G', 'Ouro', '6.18',0,300);
INSERT INTO produto VALUES (45, 'M', 'Madeira', '0.25',0,200);
INSERT INTO produto VALUES (87, 'M', 'Cano', '1.97',0,100);
INSERT INTO produto VALUES (77, 'M', 'Papel', '1.05',0,500);
INSERT INTO produto VALUES (10, 'KG', 'Tomate', '4.00',0,0);

insert into vendedor values (209, 'José', 1800.00, 'C');
insert into vendedor values (111, 'Carlos', 2490.00, 'A');
insert into vendedor values (11, 'João', 2780.00, 'C');
insert into vendedor values (240, 'Antônio', 9500.00, 'C');
insert into vendedor values (720, 'Felipe', 4600.00, 'A');
insert into vendedor values (213, 'Jonas', 2300.00, 'A');
insert into vendedor values (101, 'João', 2650.00, 'C');
insert into vendedor values (310, 'Josias', 870.00, 'B');
insert into vendedor values (250, 'Maurício', 2930.00, 'B');

INSERT INTO pedido VALUES (121, 20, 410, 209,0, '2018-10-10');
INSERT INTO pedido VALUES (97, 20, 720, 101,0, '2018-07-10');
INSERT INTO pedido VALUES (101, 15, 720, 101,0,'2018-08-10');
INSERT INTO pedido VALUES (137, 20, 720, 720,0,'2018-09-10');
INSERT INTO pedido VALUES (148, 20, 720, 101,0,'2018-10-15');
INSERT INTO pedido VALUES (189, 15, 870, 213,0,'2018-10-20');
INSERT INTO pedido VALUES (104, 30, 110, 101,0,'2018-10-12');
INSERT INTO pedido VALUES (203, 30, 830, 250,0,'2018-12-10');
INSERT INTO pedido VALUES (98, 20, 410, 209,0,'2018-11-12');
INSERT INTO pedido VALUES (143, 30, 20, 111,0,'2018-08-01');
INSERT INTO pedido VALUES (105, 15, 180, 240,0,'2018-02-10');
INSERT INTO pedido VALUES (111, 20, 260, 11,0,'2018-12-12');
INSERT INTO pedido VALUES (103, 20, 260, 11,0,'2018-03-20');
INSERT INTO pedido VALUES (91, 20, 260, 11,0,'2018-03-20');
INSERT INTO pedido VALUES (138, 20, 260, 11,0,'2018-03-26');
INSERT INTO pedido VALUES (108, 15, 290, 310,0,'2018-09-24');
INSERT INTO pedido VALUES (119, 30, 390, 250,0,'2018-09-10');
INSERT INTO pedido VALUES (127, 10, 410, 11,0,'2018-09-02');

INSERT INTO item_pedido values (121, 25, 10,0);
INSERT INTO item_pedido values (121, 31, 35,0);
INSERT INTO item_pedido values (97, 77, 20,0);
INSERT INTO item_pedido values (101, 31, 9,0);
INSERT INTO item_pedido values (101, 78, 18,0);
INSERT INTO item_pedido values (101, 13, 5,0);
INSERT INTO item_pedido values (98, 77, 5,0);
INSERT INTO item_pedido values (148, 45, 8,0);
INSERT INTO item_pedido values (148, 31, 7,0);
INSERT INTO item_pedido values (148, 77, 3,0);
INSERT INTO item_pedido values (148, 25, 10,0);
INSERT INTO item_pedido values (148, 78, 30,0);
INSERT INTO item_pedido values (104, 53, 32,0);
INSERT INTO item_pedido values (203, 31, 6,0);
INSERT INTO item_pedido values (189, 78, 45,0);
INSERT INTO item_pedido values (143, 31, 20,0);
INSERT INTO item_pedido values (143, 78, 10,0);
INSERT INTO item_pedido values (105, 78, 10,0);
INSERT INTO item_pedido values (111, 25, 10,0);
INSERT INTO item_pedido values (111, 78, 70,0);
INSERT INTO item_pedido values (103, 53, 37,0);
INSERT INTO item_pedido values (91, 77, 40,0);
INSERT INTO item_pedido values (138, 22, 10,0);
INSERT INTO item_pedido values (138, 77, 35,0);
INSERT INTO item_pedido VALUES (138, 53, 18,0);
INSERT INTO item_pedido VALUES (108, 13, 17,0);
INSERT INTO item_pedido VALUES (119, 77, 40,0);
INSERT INTO item_pedido VALUES (119, 13, 6,0);
INSERT INTO item_pedido VALUES (119, 22, 10,0);
INSERT INTO item_pedido VALUES (119, 53, 43,0);
INSERT INTO item_pedido VALUES (137, 13, 8,0);


-- Exercicios 1
select nome_cliente, cidade_cliente, uf_cliente from cliente order by uf_cliente, cidade_cliente asc;
-- Exercicios 2
select cgc_cliente, nome_cliente, endereco_cliente from cliente;
-- Exercicios 2
select cod_pedido, cod_produto, qtd_pedido from item_pedido where qtd_pedido > 25;
-- Exercicios 3
select * from cliente where cidade_cliente = 'Niterói';
-- Exercicios 4
select * from produto where unidade_produto = 'M' and valor_unitario = '2';
-- Exercicios 5
-- Exercicios 6
-- Exercicios 7
-- Exercicios 8
-- Exercicios 9
select * from produto where desc_produto like 'Q%';
-- Exercicios 10
select * from vendedor where nome_vendedor not like 'Jo%';
-- Exercicios 11
select * from vendedor where comissao_vendedor in ('A','B');
-- Exercicios 12
-- Exercicios 13
select nome_vendedor,salario_vendedor from vendedor order by nome_vendedor;
-- Exercicios 14 OUTRA PAG
-- Exercicios 15
-- Exercicios 16
-- Exercicios 17
select sum(qtd_pedido) from (select qtd_pedido from item_pedido where cod_produto = '78') as t;
-- Exercicios 18
select avg(salario_vendedor) from (select salario_vendedor from vendedor) as t;
-- Exercicios 19
select count(cod_vendedor) from (select cod_vendedor from vendedor where salario_vendedor > 2500) as q;
-- Exercicios 20
select * from item_pedido group by cod_pedido;
-- Exercicios 21
select * from item_pedido where qtd_pedido > 3;
-- Exercicios 22
update produto set valor_unitario = 3 where desc_produto = 'papel';
-- Exercicios 23;
update vendedor set salario_vendedor = salario_vendedor*1.27 + 100;
-- Exercicios 24
select avg(valor_unitario) as media from produto;
select * from produto where valor_unitario<(select avg(valor_unitario) as media from produto) and unidade_produto = 'KG';

update produto set valor_unitario = valor_unitario*1.025 where valor_unitario<(select avg(valor_unitario) as media from produto) and unidade_produto = 'KG';
-- Exercicios 25
-- Exercicios 26
select * from vendedor;
SET SQL_SAFE_UPDATES = 0;
drop procedure ajusteSalario;
delimiter $$
create procedure ajusteSalario(in codvend int, in taxa float)
begin
	set taxa = taxa/100;
    update vendedor set salario_vendedor = salario_vendedor * taxa where codvend = cod_vendedor; 
end $$

call ajusteSalario(11, 200);

select * from item_pedido where cod_produto = 13;
delete from produto where cod_produto = 13;
drop trigger excluiritens;
create trigger proibirexclusao before delete on produto for each row
begin
	update produto set valor_unitario = 0 where OLD.cod_produto = cod_produto;
end $$


delimiter $$
create trigger excluiritens before delete on produto for each row
begin
	delete from item_pedido where OLD.cod_produto = item_pedido.cod_produto;
end$$


delimiter ;
create table pedido_fim(
	cod_pedido INTEGER(3) PRIMARY KEY NOT NULL,
	prazo_entrega INTEGER(2) NOT NULL,
	cod_cliente INTEGER(3) NOT NULL,
	cod_vendedor INTEGER(3) NOT NULL,
	ped_status int default 0,
	CONSTRAINT fk_cod_cliente_fim FOREIGN KEY (cod_cliente) REFERENCES cliente(cod_cliente),
	CONSTRAINT fk_cod_vendedor_fim FOREIGN KEY (cod_vendedor) REFERENCES vendedor(cod_vendedor)
	on delete cascade
    on update cascade
);

create table item_fim(
	cod_pedido INTEGER(3) NOT NULL,
	cod_produto INTEGER(3) NOT NULL,
	qtd_pedido INTEGER(3) NOT NULL,
    item_status int default 0,
	PRIMARY KEY (cod_pedido, cod_produto),
	CONSTRAINT fk_cod_pedido_fim FOREIGN KEY (cod_pedido) REFERENCES pedido_fim(cod_pedido),
	CONSTRAINT fk_cod_produto_fim FOREIGN KEY (cod_produto) REFERENCES produto(cod_produto)
	on delete cascade
    on update cascade
);

create table produto_req(
	cod int primary key,
    qtd int,
    qtd_comprar int
);
create table produto_falta(
	dia varchar(10),
    cod_produto int primary key,
    qtd int,
    qtdv int
);

create table historico_prod(
	cod int primary key,
    qtd int,
    valor integer(8),
    usuario varchar(60),
    data varchar(10)
);

create table historico_prod_preco(
	cod int primary key,
    qtd int,
    valor_atual integer(8),
    valor_antigo integer(8),
    usuario varchar(60),
    data varchar(10)
);

create table tentativa_log(
	cod int primary key,
    data varchar(10),
    operacao varchar(30),
    usuario varchar(60)
);

create table item_cancelado(
	cod_pedido INTEGER(3) NOT NULL,
	cod_produto INTEGER(3) NOT NULL,
	qtd_pedido INTEGER(3) NOT NULL,
    item_status int default 0,
	PRIMARY KEY (cod_pedido, cod_produto),
	CONSTRAINT fk_cod_pedido_canc FOREIGN KEY (cod_pedido) REFERENCES pedido(cod_pedido),
	CONSTRAINT fk_cod_produto_canc FOREIGN KEY (cod_produto) REFERENCES produto(cod_produto)
	on delete cascade
    on update cascade
);

select * from produto;
delimiter $$
create trigger inseriritem before insert on item_pedido for each row
begin
	update produto set qtd = qtd - new.qtd_pedido where new.cod_produto = cod_produto;
end $$

delimiter $$
create procedure baixaestoque(in cod int, in qtdv int)
begin
	
	declare qtd int;
    select cod;
    set qtd = (select qtd from produto where cod = cod_produto);
	if(qtdv >= qtd) then
			insert into produto_falta values( curdate(), cod, qtd, qtdv);
			select * from produto_falta;
	else
		update produto set produto.qtd = produto.qtd - qtdv where cod = produto.cod_produto;
        select 'Produto Atualizado';
    end if;
end$$



-- exercicio 3
delimiter $$
create procedure verestoque(in cod int, in qtdmin int)
begin
	declare qtde int;
    set qtde = (select produto.qtd from produto where cod = cod_produto);
    if(qtde < qtdmin)then
		insert into produto_req values(cod, qtde, qtdmin-qtde);
        select * from produto_req;
	end if;
end$$

-- trigger
delimiter $$
create trigger excluirprod before delete on produto for each row
begin
	if(old.qtd >0) then
		insert into tentativa_log values (old.cod_produto, curdate(), 'delete', current_user());
        update produto set produto.prod_status = 0 where produto.cod_produto = old.cod_produto;
    else
		insert into historico_prod values (old.cod_produto, old.qtd, old.valor_unitario, current_user(), curdate());
	end if;
end $$
create table pedido_cancelado(
	cod_pedido INTEGER(3) PRIMARY KEY NOT NULL,
	prazo_entrega INTEGER(2) NOT NULL,
	cod_cliente INTEGER(3) NOT NULL,
	cod_vendedor INTEGER(3) NOT NULL,
    ped_status int default 0,
	CONSTRAINT fk_cod_cliente_calc FOREIGN KEY (cod_cliente) REFERENCES cliente(cod_cliente),
	CONSTRAINT fk_cod_vendedor_calc FOREIGN KEY (cod_vendedor) REFERENCES vendedor(cod_vendedor)
	on delete cascade
    on update cascade
);

delimiter $$
create trigger item_cancel after update on pedido for each row
begin
	if(new.ped_status = '0') then
		insert into pedido_cancelado values (old.cod_pedido, old.prazo_entrega, old.cod_cliente, old.cod_vendedor, new.ped_status);
        delete from pedido where old.cod_pedido = cod_pedido;
		delete from item_pedido where old.cod_pedido = cod_pedido;
	end if;
end $$

delimiter $$
create trigger ex4 after update on pedido for each row
begin
	declare cod_prod, cod_item, qtd, qtdp,z int; 
	declare ponto cursor for (select pedido.cod_pedido, qtd, qtd_pedido from produto,item_pedido, pedido where produto.cod_produto = item_pedido.cod_produto
and pedido.cod_pedido = old.cod_pedido);
	declare continue handler for not found set z = 1;
	if(new.ped_status = '1') then
		open ponto;
        repeat 
			fetch ponto into cod_prod, qtd, qtdp;
			update item_pedido set item_status = 1 where qtd < qtd_pedido and old.cod_pedido = cod_prod;
			until (z=1)
		end repeat;
        close ponto;
	end if;
end $$

delimiter $$
create trigger ex7 after update on produto for each row
begin 
	if(new.valor_unitario != old.valor_unitario) then
		insert into historico_prod_preco values (old.cod_produto, old.qtd, new.valor_unitario, old.valor_unitario, current_user(), curdate());
    end if;
    
end $$


delimiter $$
create procedure calcLucro(IN data_inicial date, IN data_final date)
begin    
    select sum(p.custo_de_venda - p.custo_medio) from produto as p, itens_venda as iv 
    where iv.venda_codigo in (select orc_codigo from venda where (orc_data between data_inicial and data_final))
    and iv.prd_codigo = p.prd_codigo;
end$$

delimiter $$
create procedure ex2(in cod int, in qtd_min int)
begin
	declare atual int;
    declare qtd_comprar int;
    declare meses date;
    set atual = (select qtd from produto where cod = cod_produto);
    set meses = date_sub(curdate(), interval 90 day);
	if(qtd_min > qtd) then
		set qtd_comprar = (select sum(item_pedido.qtd_pedido) from item_pedido, produto where produto.ped_date >=meses and 
			item_pedido.cod_produto = produto.cod_produto);
		insert into produto_requisicao values (cod_produto, atual, qtd_comprar);
	end if;
end $$

delimiter %%
create trigger armazenaHist before delete on produtos for each row
begin
	declare estoqueAtual int default 0;
    declare saldoEmEstoque condition for sqlstate '45000';
    declare exit handler for saldoEmEstoque
    begin
		insert into tentativasLog(data, operacao, prd_codigo, usuario)
        values(curdate(), 'delete', old.prd_codigo, current_user());
		set old.prd_status = 0;
    end;
    set estoqueAtual = old.prd_qtd_estoque;
    if(estoqueAtual > 0) then
		signal saldoEmEstoque;
    else
		insert into historico_produtos_excluidos(prd_codigo, prd_qtd_estoque, prd_preco_venda, data_exclusao, hora_exclusao, usuario)
        values(old.prd_codigo, old._prd_qtd_estoque, old.prd_preco_venda, curdate(), curtime(), current_user());
    end if;    
end$$

delimiter $$

create trigger ex4_prova before delete on pedido for each row
begin
	delete from item_pedido where old.cod_pedido = item_pedido.cod_pedido;
end $$
delimiter ;


delete from item_pedido where cod_pedido = 138;

select * from item_pedido, pedido where pedido.ped_date between '2018-03-01' and '2018-06-28' and pedido.cod_pedido = item_pedido.cod_pedido; 
drop trigger ex4;
update item_pedido set item_status = true where cod_pedido = 138;
select * from pedido where cod_pedido = 138;
update pedido set ped_status = 0 where cod_pedido = 138;
select * from item_pedido where cod_pedido = 138;
update item_pedido set item_status = true;
select produto.cod_produto, cod_pedido, qtd, qtd_pedido from produto inner join item_pedido on produto.cod_produto = item_pedido.cod_produto;
select produto.cod_produto, pedido.cod_pedido, qtd, qtd_pedido from produto,item_pedido, pedido where produto.cod_produto = item_pedido.cod_produto
and pedido.cod_pedido = 119;
update pedido set ped_status = 0 where cod_pedido = 111;
drop trigger item_cancel;
call baixaestoque(25, 19);
call verestoque(25, 180);
INSERT INTO pedido VALUES (1, 10, 410, 11,0);
INSERT INTO item_pedido values (1, 25, 150,0);
select qtd from produto where cod_produto = 25;
update produto set produto.qtd = 120 where 25 = produto.cod_produto;
drop trigger excluirprod;
select * from produto;
select * from pedido,item_pedido where item_pedido.cod_pedido = pedido.cod_pedido;
select * from pedido_cancelado;
select * from item_pedido where cod_pedido = 127;
select * from historico_prod;
delete from produto_req;
delete from pedido_cancelado;
SET SQL_SAFE_UPDATES = 0;

select count(valor_unitario) from produto  
