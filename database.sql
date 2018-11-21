create database horadolixo;

use horadolixo;

create table adm(
	usuario varchar(30) primary key,
    senha varchar(30) not null
);

insert into adm value('root@root.com', 'root');

create table cidades(
	id int(4) primary key,
    estado int(2) not null,
    uf varchar(4) not null,
    nome varchar(50) not null
);

create table motorista(
	email varchar(60) unique primary key,
    nome varchar(30) not null,
    sobrenome varchar(50),
    telefone varchar(30),
    senha varchar(255) not null
);

create table caminhao(
	modelo varchar(60) not null,
    ano varchar(10) not null,
    serie varchar(20) not null,
    placa varchar(6) unique primary key
);


create table cronograma(
	id int NOT null auto_increment,
    dia varchar(15) not null,
    hora varchar(10) not null,
    email varchar(60),
    placa varchar(6),
    primary key(id),
    constraint fk_email foreign key(email) references motorista(email),
    constraint fk_placa foreign key(placa) references caminhao(placa)
    on delete cascade
    on update cascade
);

create table rota_real(
	id int NOT null auto_increment primary key,
	x_endereco double not null,
    y_endereco double not null
);

drop table if exists coordenadas;
drop table if exists poligono;

create table poligono(
	id int NOT null auto_increment primary key,
    coord varchar(100) not null,
    id_cidade int(4) not null,
    cor varchar(10) not null,
--     id_rota MEDIUMINT,
--     id_rotareal MEDIUMINT,
--     id_conograma MEDIUMINT,
 	constraint fk_id_cidade foreign key(id_cidade) references cidades(id)
-- 	constraint fk_id_rota foreign key(id_rota) references waypoints(id)
--     constraint fk_id_rota_real foreign key(id_rotareal) references rota_real(id)
--     constraint fk_id_conograma foreign key(id_conograma) references conograma(dia,hora)
     on delete cascade
     on update cascade
);

create table coordenadas(
	id int NOT null auto_increment primary key,
    id_rota int not null,
    coord varchar(100) not null,
	x_coord double not null,
    y_coord double not null,
	constraint fk_id_rota foreign key(id_rota) references poligono(id)
	on delete cascade
	on update cascade
);



delete from poligono;
delete from coordenadas;
SET SQL_SAFE_UPDATES = 0;

select * from rota order by id desc;
use horadolixo;
select * from cidades where LOCATE('Presidente Prudente', nome);
select * from poligono;
select * from coordenadas;
select * from rota;
select * from motorista;
select * from caminhao order by modelo;
INSERT INTO motorista(email, nome, sobrenome, telefone, senha) VALUES ('ga.felis@outlook.com', 'Gabriel','$sobrenome','$telefone', '$senha');
insert into rota(origem, destino) value ('teste','teste');
SELECT * FROM horadolixo.cidade WHERE LOCATE('Pr',nome) ORDER BY nome ASC, estado ASC limit 10;
SELECT * FROM cidades WHERE LOCATE('Jardim',nome);
select id from cidades where LOCATE('Presidente Prudente', nome) and uf = 'SP';

update adm set senha = "root";
select * from adm;	
insert into rota values(28, "Ruas2","Rua1");
select * from coordenadas where 14 = coordenadas.id_poligono;
insert into poligono(coord, id_cidade) values ("abc", 1);
call inserircoord(1,0,9);
select id_inicio from rota where 14 = rota.id_poligono is null;
replace into rota(id_poligono,id_inicio, id_fim) values(20,90,93);
select * from coordenadas,rota where 23 = coordenadas.id_poligono and rota.id_inicio = 23;
update coordenadas set 
    x_coord = 123.3,
    y_coord = -51.405464809692376 where 10=coordenadas.id_rota and coordenadas.id = 83;
update rota set
    x_origem = 123.3,
    y_destino = -51.405464809692376 where 10=rota.id;
    
    
select * from coordenadas where 12 = coordenadas.id_rota;

select poligono.id, coord, cor from poligono 
where id_cidade = 9286;

select x_coord, y_coord from coordenadas
where id_rota = 3;

call recarregar_rota(7);
call inserircoord(1, "Ruá Bâla", 1.233232, 12.2112);

call caminhao_que_nao_trabalham_no_dia('segunda');