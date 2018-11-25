

DELIMITER $$
CREATE TRIGGER ai_data AFTER INSERT ON data
	FOR EACH ROW
	BEGIN
	  INSERT INTO data_log (action,id,timestamp,data1,data2)
	  VALUES('insert',NEW.id,NOW(),NEW.data1,NEW.data2);
	END$$