CREATE TABLE album (
		albumTitle 	VARCHAR(100),
		albumYear 	DATE,
		numSongs 	INT,
		albumGenre 	VARCHAR(64),
		albumPrice 	DOUBLE,
		albumImg 	VARCHAR(96),
		albumDescrip VARCHAR(1064),
		PRIMARY KEY(albumTitle, albumYear));	

CREATE TABLE song (
		sAlbumTitle VARCHAR(100),
		sAlbumYear 	DATE,
		songTitle 	VARCHAR(100),
		songYear 	DATE,
		songPrice 	DOUBLE,
		songImg 	VARCHAR(96),
		songGenre	VARCHAR(64),
		songLength  DOUBLE,
		FOREIGN KEY (sAlbumTitle, sAlbumYear) REFERENCES album (albumTitle, albumYear) ON UPDATE CASCADE ON DELETE CASCADE,
		PRIMARY KEY (sAlbumTitle, sAlbumYear, songTitle, songYear));

CREATE TABLE singer (
		singerFirstName VARCHAR(64),
		singerLastName 	VARCHAR(64),
		stageName 		VARCHAR(64),
		singerBirthday 	DATE,
		singerDescrip 	VARCHAR(564),
		singerImg		VARCHAR(96),
		PRIMARY KEY (singerFirstName, singerLastName, stageName));

CREATE TABLE singersingssong (
		sssAlbumTitle 		VARCHAR(100),
		sssAlbumYear 		DATE,
		sssSongTitle 		VARCHAR(100),
		sssSongYear 		DATE,
		sssSingerFirstName 	VARCHAR(64),
		sssSingerLastName 	VARCHAR(64),
		sssSingerStageName	VARCHAR(64),
		FOREIGN KEY (sssAlbumTitle, sssAlbumYear, sssSongTitle, sssSongYear) REFERENCES song (sAlbumTitle, sAlbumYear, songTitle, songYear) ON UPDATE CASCADE ON DELETE CASCADE,
		FOREIGN KEY (sssSingerFirstName, sssSingerLastName, sssSingerStageName) REFERENCES singer (singerFirstName, singerLastName, stageName) ON UPDATE CASCADE ON DELETE CASCADE,
		PRIMARY KEY (sssAlbumTitle, sssAlbumYear, sssSongTitle, sssSongYear, sssSingerFirstName, sssSingerLastName, sssSingerStageName));	

CREATE TABLE composer (
		composerFirstName 	VARCHAR(64),
		composerLastName 	VARCHAR(64),
		composerBirthday 	DATE,
		composerDescrip 	VARCHAR(564),
		PRIMARY KEY (composerFirstName, composerLastName, composerBirthday));
	
CREATE TABLE composercomposessong (
		ccsAlbumTitle 			VARCHAR(100),
		ccsAlbumYear 			DATE,
		ccsSongTitle 			VARCHAR(100),
		ccsSongYear 			DATE,
		ccsComposerFirstName 	VARCHAR(64),
		ccsComposerLastName 	VARCHAR(64),
		ccsComposerBirthday		DATE,
		FOREIGN KEY (ccsAlbumTitle, ccsAlbumYear, ccsSongTitle, ccsSongYear) REFERENCES song (sAlbumTitle, sAlbumYear, songTitle, songYear) ON UPDATE CASCADE ON DELETE CASCADE,
		FOREIGN KEY (ccsComposerFirstName, ccsComposerLastName, ccsComposerBirthday) REFERENCES composer (composerFirstName, composerLastName, composerBirthday) ON UPDATE CASCADE ON DELETE CASCADE,
		PRIMARY KEY (ccsAlbumTitle, ccsAlbumYear, ccsSongTitle, ccsSongYear, ccsComposerFirstName, ccsComposerLastName, ccsComposerBirthday));

CREATE TABLE user (
		userName 		VARCHAR(64) NOT NULL,
		email 			VARCHAR(64) PRIMARY KEY,
		userFirstName 	VARCHAR(64) NOT NULL,
		userLastName 	VARCHAR(64) NOT NULL,
		userBirthday 	DATE,
		paypalEmail 	VARCHAR(64),
		role			VARCHAR(12) CHECK (role = "admin" or role = "user"));

CREATE TABLE purchases (
		pAlbumTitle 	VARCHAR(100),
		pAlbumYear 		DATE,
		pSongTitle 		VARCHAR(100),
		pSongYear 		DATE,
		pEmail 			VARCHAR(64),
		transactionId	INT NOT NULL AUTO_INCREMENT,
		transactionDate	DATE,
		amountPaid		DOUBLE,
		purchaseType	VARCHAR(16),
		FOREIGN KEY (pAlbumTitle, pAlbumYear, pSongTitle, pSongYear) REFERENCES song (sAlbumTitle, sAlbumYear, songTitle, songYear) ON UPDATE CASCADE ON DELETE CASCADE,
		FOREIGN KEY (pEmail) REFERENCES user (email) ON UPDATE CASCADE ON DELETE CASCADE,
		PRIMARY KEY (pAlbumTitle, pAlbumYear, pSongTitle, pSongYear, pEmail),
		KEY (transactionId));


#RUN THIS IN YOUR SQL TAB
DELIMITER $$

CREATE TRIGGER numSongs
BEFORE INSERT
ON album
FOR EACH ROW
BEGIN
  IF NEW.numSongs < 0 THEN
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

CREATE VIEW PurchasesViewAlbum1 AS
SELECT p.transactionId, p.pAlbumTitle, p.pAlbumYear, p.pEmail, u.userName, p.transactionDate, p.amountPaid, p.purchaseType FROM purchases p, user u WHERE p.pEmail = u.email AND p.purchaseType='album' GROUP BY p.pAlbumTitle;

CREATE VIEW PurchasesViewSong1 AS
SELECT p.transactionId, p.pAlbumTitle, p.pAlbumYear, p.pSongTitle, p.pSongYear, p.pEmail, u.userName, p.transactionDate, p.amountPaid, p.purchaseType FROM purchases p, user u WHERE p.pEmail = u.email AND purchaseType='song';
