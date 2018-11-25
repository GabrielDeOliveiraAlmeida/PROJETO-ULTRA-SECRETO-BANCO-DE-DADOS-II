create database IF NOT EXISTS horadolixo;

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


create table cronograma(
    id int not null not null,
    dia varchar(15) not null,
    hora varchar(10) not null,
    email varchar(60),
    placa varchar(6),
    primary key(id, dia),
    constraint fk_email foreign key(email) references motorista(email),
    constraint fk_id_pol foreign key(id) references poligono(id),
    constraint fk_placa foreign key(placa) references caminhao(placa)
    on delete cascade
    on update cascade
);
