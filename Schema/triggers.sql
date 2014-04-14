#RUN THIS IN YOUR SQL TAB
DELIMITER $$

CREATE TRIGGER numSongs
BEFORE INSERT
ON album
FOR EACH ROW
BEGIN
  IF NEW.numSongs <= 0 THEN
    SIGNAL SQLSTATE '02000' SET MESSAGE_TEXT = 'ROL must be less then QOH';
  END IF;
END$$

DELIMITER ;

#Run this also 
DELIMITER $$

CREATE TRIGGER purchaseType
BEFORE INSERT
ON purchases
FOR EACH ROW
BEGIN
  IF NOT NEW.purchaseType = 'album' THEN
    IF NOT NEW.purchaseType = 'song' THEN  
		SIGNAL SQLSTATE '02000' SET MESSAGE_TEXT = 'purchaseType must be album or song';
	END IF;
END IF;
END$$

DELIMITER ;
