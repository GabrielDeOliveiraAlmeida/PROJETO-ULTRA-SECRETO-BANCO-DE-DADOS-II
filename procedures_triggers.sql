delimiter $$
create procedure insertroute(in id int, in x_origem double , in y_origem double , in x_destino double, in y_destino double)
begin
	declare aux int;
    set aux = (select id_poligono from rota where id_poligono = id);
    if(aux != null) then
		update rota set 
			rota.x_origem = x_origem,
			rota.y_origem = y_origem,
			rota.x_destino = x_destino,
			rota.y_destino = y_destino where id_poligono = id;
	else insert into rota values (id, x_origem, y_origem, x_destino, y_destino);
    end if;

end $$


delimiter $$
create procedure insertwaypoints(in id int, in x_endereco double , in y_endereco double)
begin
	declare aux int;
    delete from waypoints where id_rota = id;
    insert into waypoints(id_rota, x_endereco, y_endereco) values (id, x_endereco, y_endereco);
end $$

delimiter $$
create procedure insertwaypointsstring(in id int, in endereco varchar(100))
begin
	declare aux int;
    delete from waypoints where id_rota = id;
    insert into waypoints(id_rota, endereco) values (id, endereco);
end $$

delimiter $$
create procedure insertcoord(in id int, in x_coord double , in y_coord double )
begin
    declare x double;
    select x_origem into x from poligono where id = poligono.id;
    if(x = 0) then
		update poligono set 
			x_origem = x_coord,
            y_origem = y_coord where id=poligono.id;
	else 
        update poligono set 
			x_destino = x_coord,
            y_destino = y_coord where id = poligono.id;
    end if;
    insert into coordenadas(id_poligono, x_coord, y_coord)  values (id, x_coord, y_coord);
end $$

select x_origem from poligono where 13 = poligono.id;
update poligono set 
			x_origem = 123,
            y_origem = 123 where 13=poligono.id;



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



