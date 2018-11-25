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
			) AS theplaca, caminhao where theplaca = caminhao.placa;
end$$


delimiter $$
drop procedure if exists cronograma_salvar;
create procedure cronograma_salvar(in id int, in email varchar(60), in placa varchar(6), in hora varchar(10), in dia varchar(15))
begin
	replace into cronograma(id, dia, hora, email, placa) values (id, dia, hora, email, placa);
end $$


delimiter $$
drop procedure if exists cronograma_carregar;
create procedure cronograma_carregar(in id int, in dia varchar(15))
begin
	select hora, nome, sobrenome, modelo, cronograma.email, cronograma.placa from cronograma, motorista, caminhao where cronograma.id = id and cronograma.dia = dia 
		and motorista.email = cronograma.email and caminhao.placa = cronograma.placa;
end $$


delimiter $$
drop procedure if exists cronograma_remover;
create procedure cronograma_remover(in id int, in dia varchar(15))
begin
	delete from cronograma where cronograma.id = id and cronograma.dia = dia;
end $$




 -- // -----------------------------------------------------------------------------------------------------------------------------//
 -- // Procedures For Motorista
 -- // -----------------------------------------------------------------------------------------------------------------------------//
delimiter $$

drop procedure if exists criar_motorista;
create procedure criar_motorista(
   in the_email varchar(60),
   in the_nome varchar(30),
   in the_sobrenome varchar(50),
   in the_telefone varchar(30),
   in the_senha varchar(255)
)
begin
  INSERT INTO motorista(email, nome, sobrenome, telefone, senha)
        VALUES (the_email,the_nome,the_sobrenome,the_telefone,the_senha);
end $$

drop procedure if exists deletar_motorista;
create procedure deletar_motorista(in the_email varchar(60))
begin
  DELETE FROM motorista WHERE email = the_email;
end $$

drop procedure if exists listar_motoristas_por_ordem_alfabetica;
create procedure listar_motoristas_por_ordem_alfabetica()
begin
  SELECT * FROM motorista ORDER BY nome;
end $$


 -- // -----------------------------------------------------------------------------------------------------------------------------//
 -- // Procedures For Caminhão
 -- // -----------------------------------------------------------------------------------------------------------------------------//
delimiter $$

drop procedure if exists criar_caminhao;
create procedure criar_caminhao(
   in the_modelo varchar(60),
   in the_ano varchar(10),
   in the_serie varchar(20),
   in the_placa varchar(6)
)
begin
  INSERT INTO caminhao(modelo, ano, serie, placa)
                VALUES  (the_modelo, the_ano, the_serie, the_placa);
end $$

drop procedure if exists deletar_caminhao;
create procedure deletar_caminhao(in the_placa varchar(6))
begin
  DELETE FROM caminhao WHERE placa = the_placa;
end $$


drop procedure if exists listar_caminhoes_por_ordem_alfabetica;
create procedure listar_caminhoes_por_ordem_alfabetica()
begin
  SELECT * FROM caminhao ORDER BY modelo;
end $$
