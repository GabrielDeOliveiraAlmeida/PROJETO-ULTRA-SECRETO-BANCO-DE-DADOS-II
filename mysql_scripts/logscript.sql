use horadolixo;

delimiter $$
create procedure getlogmotorista()
begin
	select * from motorista_logger;
end $$

delimiter $$
create procedure getlogcaminhao()
begin
	select * from caminhao_logger;
end $$


delimiter $$
create procedure getlogadm()
begin
	select * from adm_logger;
end $$