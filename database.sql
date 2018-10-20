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


create table rota(
	id MEDIUMINT NOT null auto_increment primary key,
	origem varchar(100) not null,
    destino varchar(100) not null,
    id_rota int not null,
	constraint fk_id_rota foreign key(id_rota) references waypoints(id)
    on delete cascade
    on update cascade
);

create table waypoints(
	id MEDIUMINT NOT null auto_increment primary key,
    endereco varchar(100)    
);

create table rota_real(
	id MEDIUMINT NOT null auto_increment primary key,
	latitude varchar(15) not null, 
	longitude varchar(15) not null
);

create table poligono(
	id MEDIUMINT NOT null auto_increment primary key,
    id_cidade int(4) not null,
    id_rota MEDIUMINT,
    id_rota_real MEDIUMINT,
    id_coord MEDIUMINT,
	constraint fk_id_cidade foreign key(id_cidade) references cidades(id),
	constraint fk_id_rota foreign key(id_rota) references waypoints(id),
    constraint fk_id_rota_real foreign key(id_rota_real) references rota_real(id),
    constraint fk_id_coord foreign key(id_coord) references coordenadas(id)
    on delete cascade
    on update cascade
);

create table coordenadas(
	id MEDIUMINT NOT null auto_increment primary key,
	latitude varchar(15) not null, 
	longitude varchar(15) not null
);

create table semana(
	dia varchar(15) primary key,
    email varchar(60),
    placa varchar(6),
    constraint fk_email foreign key(id_email) references motorista(email),
    constraint fk_placa foreign key(id_placa) references caminhao(placa)
    on delete cascade
    on update cascade
);


select * from motorista;
select * from caminhao order by modelo;
INSERT INTO motorista(email, nome, sobrenome, telefone, senha) VALUES ('ga.felis@outlook.com', 'Gabriel','$sobrenome','$telefone', '$senha');
SELECT * FROM horadolixo.cidade WHERE LOCATE('Pr',nome) ORDER BY nome ASC, estado ASC limit 10