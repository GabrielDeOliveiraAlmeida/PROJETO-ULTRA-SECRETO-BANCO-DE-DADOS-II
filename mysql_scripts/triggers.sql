DELIMITER $$

 -- // -----------------------------------------------------------------------------------------------------------------------------//
 -- // Triggers For Admin
 -- // -----------------------------------------------------------------------------------------------------------------------------//
DROP TRIGGER IF EXISTS trigger_adm_insert;
CREATE TRIGGER trigger_adm_insert AFTER INSERT ON adm
	FOR EACH ROW
	BEGIN
	  INSERT INTO adm_logger (action,timestamp,sqluser,usuario,senha)
	  VALUES('insert',NOW(), CURRENT_USER(),NEW.usuario,NEW.senha);
	END$$

DROP TRIGGER IF EXISTS trigger_adm_delete;
CREATE TRIGGER trigger_adm_delete AFTER DELETE ON adm
	FOR EACH ROW
	BEGIN
	  INSERT INTO adm_logger (action,timestamp,sqluser,usuario,senha)
	  VALUES('delete',NOW(), CURRENT_USER(),OLD.usuario,OLD.senha);
	END$$


 -- // -----------------------------------------------------------------------------------------------------------------------------//
 -- // Triggers For Caminhao
 -- // -----------------------------------------------------------------------------------------------------------------------------//
DROP TRIGGER IF EXISTS trigger_caminhao_insert;
CREATE TRIGGER trigger_caminhao_insert AFTER INSERT ON caminhao
	FOR EACH ROW
	BEGIN
	  INSERT INTO caminhao_logger (action,timestamp,sqluser,modelo,ano,serie,placa)
	  VALUES('insert',NOW(), CURRENT_USER(),NEW.modelo,NEW.ano,NEW.serie,NEW.placa);
	END$$

DROP TRIGGER IF EXISTS trigger_caminhao_delete;
CREATE TRIGGER trigger_caminhao_delete AFTER DELETE ON caminhao
	FOR EACH ROW
	BEGIN
	  INSERT INTO caminhao_logger (action,timestamp,sqluser,modelo,ano,serie,placa)
	  VALUES('delete',NOW(), CURRENT_USER(),OLD.modelo,OLD.ano,OLD.serie,OLD.placa);
	END$$

 -- // -----------------------------------------------------------------------------------------------------------------------------//
 -- // Triggers For Motorista
 -- // -----------------------------------------------------------------------------------------------------------------------------//
DROP TRIGGER IF EXISTS trigger_motorista_insert;
CREATE TRIGGER trigger_motorista_insert AFTER INSERT ON motorista
	FOR EACH ROW
	BEGIN
	  INSERT INTO motorista_logger (action,timestamp,sqluser,email,nome,sobrenome,telefone,senha)
	  VALUES('insert',NOW(), CURRENT_USER(),NEW.email,NEW.nome,NEW.sobrenome,NEW.telefone,NEW.senha);
	END$$

DROP TRIGGER IF EXISTS trigger_motorista_delete;
CREATE TRIGGER trigger_motorista_delete AFTER DELETE ON motorista
	FOR EACH ROW
	BEGIN
	  INSERT INTO motorista_logger (action,timestamp,sqluser,email,nome,sobrenome,telefone,senha)
	  VALUES('delete',NOW(), CURRENT_USER(),OLD.email,OLD.nome,OLD.sobrenome,OLD.telefone,OLD.senha);
	END$$