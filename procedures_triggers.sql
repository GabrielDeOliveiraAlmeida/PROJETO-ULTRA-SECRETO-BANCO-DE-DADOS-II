delimiter $$
drop procedure if exists inserircoord;
create procedure inserircoord(in id int, in coord varchar(100), in x double, in y double)
begin
    insert into coordenadas(id_rota, coord, x_coord, y_coord) values (id, coord, x, y);
end $$

delimiter $$
drop procedure if exists recarregar;
create procedure recarregar(in id int(4))
begin
	select poligono.id, coord, cor from poligono 
	where id_cidade = id;
end$$

delimiter $$
drop procedure if exists recarregar_rota;
create procedure recarregar_rota(in id int(4))
begin
	select coord, x_coord, y_coord from coordenadas
where id_rota = id;
end$$



delimiter $$
drop procedure if exists changecolor;
create procedure changecolor(in id int, in color varchar(10))
begin
	update poligono set cor = color 
	where poligono.id = id;
end$$

delimiter $$
drop procedure if exists motoristas_que_nao_trabalham_no_dia;
create procedure motoristas_que_nao_trabalham_no_dia(in dia_em_questao varchar(15))
begin
	SELECT theEmail, nome, sobrenome FROM (
																		  SELECT cronograma.email AS theEmail
																			FROM cronograma
																			WHERE cronograma.dia != dia_em_questao

																			UNION ALL

																			SELECT motorista.email
																					AS theEmail2
																			FROM motorista
																						 NATURAL LEFT JOIN cronograma
																			WHERE cronograma.email IS NULL
			) AS theEmail, motorista where theEmail = motorista.email;
end$$

delimiter $$
drop procedure if exists caminhao_que_nao_trabalham_no_dia;
create procedure caminhao_que_nao_trabalham_no_dia(in dia_em_questao varchar(15))
begin
	SELECT theplaca, modelo, ano FROM (
																		  SELECT cronograma.placa AS theplaca
																			FROM cronograma
																			WHERE cronograma.dia != dia_em_questao

																			UNION ALL

																			SELECT caminhao.placa
																					AS theplaca2
																			FROM caminhao
																						 NATURAL LEFT JOIN cronograma
																			WHERE cronograma.placa IS NULL
			) AS theplaca, motorista where theplaca = caminhao.placa;
end$$