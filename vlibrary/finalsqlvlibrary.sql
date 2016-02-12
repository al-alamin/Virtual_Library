-- Adminer 4.2.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DELIMITER ;;

DROP PROCEDURE IF EXISTS `TopLocName`;;
CREATE PROCEDURE `TopLocName`(OUT `retstr` VARCHAR(10000))
BEGIN
DECLARE mv integer;
DECLARE finished integer default 0;
DECLARE name varchar(100);
DECLARE v_num integer;

DECLARE locname CURSOR for
	select locationName, Num
		from (select o.LocationId, count(o.LocationId) as Num 
          	from ownedbooklocations o 
          	group by o.LocationId ) q, locations L
		where L.locationId = q.LocationId ;

DECLARE CONTINUE HANDLER 
	FOR NOT FOUND SET finished = 1;

SELECT max(q.Num) into mv
 	from( select o.LocationId, count(o.LocationId) as Num 
          from ownedbooklocations o 
          group by o.LocationId ) q;
SET retstr = "";
OPEN locname;
get_names: LOOP
	FETCH locname INTO name, v_num;

	IF finished = 1 THEN
		LEAVE get_names;
	END IF;	
	
	IF v_num = mv THEN
		SET retstr = CONCAT(name,',',retstr);
	END IF;

 END LOOP get_names;

CLOSE locname;
END;;

DROP PROCEDURE IF EXISTS `TopUser`;;
CREATE PROCEDURE `TopUser`(OUT `retstr` VARCHAR(1000))
BEGIN 
	DECLARE mxPoint integer;
	DECLARE finished integer default 0;
	DECLARE eml varchar(100);
	DECLARE vPoint integer;

	DECLARE usercursor CURSOR for
		SELECT email, Pt
			FROM ( SELECT recipientId, avg(Point) as Pt
				 from reputation 
				 group by recipientId 
				) q, user u
			where u.Id = q.recipientId; 
	DECLARE CONTINUE HANDLER 
	FOR NOT FOUND SET finished = 1;

	SELECT max(q.Pt) INTO mxPoint
		FROM (SELECT recipientId, avg(Point) as Pt
				 from reputation 
				 group by recipientId ) q;

	SET retstr = "";

	OPEN usercursor;
	get_emails: LOOP
		FETCH usercursor INTO eml,vPoint;

		IF finished = 1 THEN 
			LEAVE get_emails;
		END IF;

		IF vPoint = mxPoint THEN
			SET retstr = CONCAT(eml,',',retstr);
		END IF;
	END LOOP get_emails;

	CLOSE usercursor;

END;;

DROP PROCEDURE IF EXISTS `UserRep`;;
CREATE PROCEDURE `UserRep`(OUT retstr varchar(1000))
BEGIN 
	DECLARE mxPoint integer;
	DECLARE finished integer default 0;
	DECLARE eml varchar(100);
	DECLARE vPoint integer;

	DECLARE usercursor CURSOR for
		SELECT UserFullName, Pt
			FROM ( SELECT recipientId, avg(Point) as Pt
				 from reputation 
				 group by recipientId 
				) q, user u
			where u.Id = q.recipientId
			order by Pt desc; 
	DECLARE CONTINUE HANDLER 
	FOR NOT FOUND SET finished = 1;

	SET retstr = "";

	OPEN usercursor;
	get_name_rep: LOOP
		FETCH usercursor INTO eml,vPoint;

		IF finished = 1 THEN 
			LEAVE get_name_rep;
		END IF;

		SET retstr = CONCAT(eml,':',CAST(vPoint as char(3)),',',retstr);
	END LOOP get_name_rep;

	CLOSE usercursor;

END;;

DELIMITER ;

DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `AuthorId` int(11) NOT NULL AUTO_INCREMENT,
  `AuthorName` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  PRIMARY KEY (`AuthorId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `authors` (`AuthorId`, `AuthorName`, `Country`) VALUES
(34,	'a1',	''),
(35,	'a2',	''),
(36,	'herbert schild',	''),
(37,	'au10',	''),
(38,	'au11',	''),
(39,	'imdadul haque milon',	''),
(40,	'herbert schield',	'');

DROP TABLE IF EXISTS `bookinfo`;
CREATE TABLE `bookinfo` (
  `BookId` int(10) NOT NULL AUTO_INCREMENT,
  `BookName` varchar(255) NOT NULL,
  `Publishers` varchar(255) DEFAULT NULL,
  `PublishingYear` varchar(20) DEFAULT NULL,
  `PageNumbers` int(10) DEFAULT NULL,
  `Price` int(10) DEFAULT NULL,
  `Language` varchar(255) DEFAULT NULL,
  `Edition` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`BookId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `bookinfo` (`BookId`, `BookName`, `Publishers`, `PublishingYear`, `PageNumbers`, `Price`, `Language`, `Edition`) VALUES
(3,	'book1',	'abc publication',	'2000',	0,	250,	'English',	'5th'),
(4,	'learn c++',	'gnu publishing',	'2000',	450,	0,	'English',	'3rd'),
(5,	'ba',	'',	'',	0,	0,	'',	''),
(6,	'vdd',	'',	'',	0,	0,	'',	''),
(7,	'das',	'',	'',	0,	0,	'',	''),
(8,	'ds',	'',	'',	0,	0,	'',	''),
(9,	'asd',	'',	'',	0,	0,	'',	''),
(10,	'boohooo',	'',	'',	0,	0,	'',	''),
(11,	'dafds',	'',	'',	0,	0,	'',	''),
(12,	'dafds',	'',	'',	0,	0,	'',	''),
(13,	'dafds',	'',	'',	0,	0,	'',	''),
(14,	'asdf',	'',	'',	0,	0,	'',	''),
(15,	'learn c++ more',	'',	'',	0,	0,	'',	''),
(16,	'learn c++ more',	'',	'',	0,	0,	'',	''),
(17,	'learn history',	'abc publication',	'2010',	100,	0,	'English',	'3rd'),
(18,	'learn history',	'abc publication',	'2010',	100,	0,	'English',	'3rd'),
(19,	'learn history',	'abc publication',	'2010',	100,	0,	'English',	'3rd'),
(20,	'satkahon',	'self',	'1991',	500,	400,	'bangla',	'1st'),
(21,	'learn java',	'Java Publishers',	'2000',	200,	500,	'English',	'4th');

DROP TABLE IF EXISTS `bookinfoauthors`;
CREATE TABLE `bookinfoauthors` (
  `BookId` int(10) NOT NULL,
  `AuthorId` int(11) NOT NULL,
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`),
  KEY `FKBookInfoAu663737` (`BookId`),
  KEY `AuthorId` (`AuthorId`),
  CONSTRAINT `bookinfoauthors_ibfk_2` FOREIGN KEY (`AuthorId`) REFERENCES `authors` (`AuthorId`),
  CONSTRAINT `bookinfoauthors_ibfk_3` FOREIGN KEY (`BookId`) REFERENCES `bookinfo` (`BookId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `bookinfoauthors` (`BookId`, `AuthorId`, `Id`) VALUES
(3,	34,	62),
(3,	35,	63),
(4,	36,	64),
(19,	37,	65),
(19,	38,	66),
(20,	39,	67),
(21,	40,	68);

DROP TABLE IF EXISTS `bookinfocategory`;
CREATE TABLE `bookinfocategory` (
  `BookId` int(10) NOT NULL,
  `CategoryId` int(10) NOT NULL,
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`),
  KEY `FKBookInfoCa271528` (`BookId`),
  KEY `FKBookInfoCa20612` (`CategoryId`),
  CONSTRAINT `FKBookInfoCa20612` FOREIGN KEY (`CategoryId`) REFERENCES `category` (`CategoryId`),
  CONSTRAINT `FKBookInfoCa271528` FOREIGN KEY (`BookId`) REFERENCES `bookinfo` (`BookId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `bookinfocategory` (`BookId`, `CategoryId`, `Id`) VALUES
(3,	1,	14),
(10,	1,	15),
(10,	2,	16),
(10,	3,	17),
(10,	8,	18),
(14,	1,	19),
(14,	4,	20),
(19,	2,	21),
(19,	6,	22),
(19,	7,	23),
(20,	1,	24),
(21,	4,	25);

DROP TABLE IF EXISTS `borrowhistory`;
CREATE TABLE `borrowhistory` (
  `OwnedBookListId` int(10) NOT NULL,
  `BorrowerID` int(10) NOT NULL,
  `BorrowDate` datetime DEFAULT NULL,
  `ActualRetrunDate` datetime DEFAULT NULL,
  `ReturnDate` datetime DEFAULT NULL,
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`),
  KEY `FKBorrowHist802637` (`OwnedBookListId`),
  KEY `FKBorrowHist134528` (`BorrowerID`),
  CONSTRAINT `FKBorrowHist134528` FOREIGN KEY (`BorrowerID`) REFERENCES `user` (`id`),
  CONSTRAINT `FKBorrowHist802637` FOREIGN KEY (`OwnedBookListId`) REFERENCES `ownedbooklist` (`OwnedBookListId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `borrowhistory` (`OwnedBookListId`, `BorrowerID`, `BorrowDate`, `ActualRetrunDate`, `ReturnDate`, `Id`) VALUES
(2,	16,	NULL,	NULL,	NULL,	1),
(1,	10,	NULL,	'0000-00-00 00:00:00',	NULL,	12),
(1,	13,	NULL,	NULL,	NULL,	14),
(9,	16,	'0000-00-00 00:00:00',	NULL,	NULL,	19),
(9,	16,	NULL,	NULL,	NULL,	20),
(9,	16,	NULL,	NULL,	NULL,	21),
(9,	16,	'2015-12-19 00:00:00',	NULL,	NULL,	22),
(9,	16,	'2015-12-19 00:00:00',	NULL,	'2015-12-19 00:00:00',	23),
(27,	20,	NULL,	NULL,	NULL,	24),
(31,	20,	NULL,	NULL,	NULL,	25),
(31,	23,	'2015-12-21 10:30:10',	'2015-12-21 10:32:05',	'2016-01-10 00:00:00',	36),
(43,	23,	'2015-12-21 11:15:31',	'2015-12-23 09:00:01',	'2016-01-10 00:00:00',	37),
(45,	31,	'2015-12-21 14:18:16',	'2015-12-21 14:20:03',	'2016-01-10 00:00:00',	38),
(45,	32,	'2015-12-22 16:02:25',	NULL,	'2016-01-05 00:00:00',	39),
(39,	30,	'2015-12-22 23:31:19',	NULL,	'2015-12-22 23:31:19',	40),
(42,	23,	'2015-12-23 03:55:37',	'2015-12-23 09:15:07',	'2016-01-12 00:00:00',	41),
(42,	23,	'2015-12-23 05:15:47',	'2015-12-23 09:15:07',	'2016-01-12 00:00:00',	42),
(31,	23,	'2015-12-23 05:30:26',	NULL,	'2016-01-06 00:00:00',	43),
(43,	23,	'2015-12-23 08:58:56',	'2015-12-23 09:00:01',	'2016-01-12 00:00:00',	45),
(42,	23,	'2015-12-23 09:14:25',	'2015-12-23 09:15:07',	'2016-01-12 00:00:00',	46);

DELIMITER ;;

CREATE TRIGGER `RestrictShare` BEFORE INSERT ON `borrowhistory` FOR EACH ROW
BEGIN
DECLARE avail bit;
SELECT IsAvailable INTO avail FROM ownedbooklist 
	WHERE ownedbooklist.OwnedBookListId = NEW.OwnedBookListId;
	IF  avail = 0 THEN 
	 SIGNAL SQLSTATE '45000'
	 SET MESSAGE_TEXT = 'This book is not available for sharing.';
	END IF; 
END;;

CREATE TRIGGER `UpdateAvailability` AFTER INSERT ON `borrowhistory` FOR EACH ROW
begin
UPDATE OwnedBookList SET IsAvailable = 0 where OwnedBookListId = NEW.OwnedBookListId;
end;;

CREATE TRIGGER `UpdateAvailabilityOnReturn` AFTER UPDATE ON `borrowhistory` FOR EACH ROW
BEGIN
	If OLD.ActualRetrunDate is null THEN
		UPDATE OwnedBookList 
			SET IsAvailable = 1 
			where OwnedBookListId = NEW.OwnedBookListId; 
	END IF; 
END;;

DELIMITER ;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `CategoryId` int(10) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`CategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `category` (`CategoryId`, `CategoryName`) VALUES
(1,	'Novel'),
(2,	'Education'),
(3,	'Geology '),
(4,	'Computer Science'),
(5,	'Math'),
(6,	'Philosophy'),
(7,	'Socialogy'),
(8,	'Religious'),
(9,	'Science Fiction'),
(10,	'Medical'),
(11,	'Electronics'),
(12,	'Electronics'),
(13,	'History'),
(14,	'Bio Chemistry'),
(15,	'Molicular Biology'),
(16,	'fss');

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `LocationId` int(10) NOT NULL AUTO_INCREMENT,
  `LocationName` varchar(255) NOT NULL,
  PRIMARY KEY (`LocationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `locations` (`LocationId`, `LocationName`) VALUES
(1,	'Azimpur'),
(2,	'Mirpur'),
(3,	'Rampura'),
(4,	'Gagipur'),
(5,	'Dhanmondi'),
(6,	'Shahbag'),
(7,	'Uttara'),
(8,	'Motijheel'),
(9,	'Sirajgonj sadar'),
(10,	'Malibag'),
(11,	'Mirpur10'),
(12,	'Mirpur12'),
(13,	'Mirpur13');

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `OwnedBookListId` int(10) NOT NULL,
  `BorrowerId` int(10) NOT NULL,
  `RequestTime` datetime DEFAULT NULL,
  `ResponseTime` date DEFAULT NULL,
  `ResponseStatus` bit(1) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `FKMessage317760` (`OwnedBookListId`),
  KEY `FKMessage65817` (`BorrowerId`),
  CONSTRAINT `FKMessage317760` FOREIGN KEY (`OwnedBookListId`) REFERENCES `ownedbooklist` (`OwnedBookListId`),
  CONSTRAINT `FKMessage65817` FOREIGN KEY (`BorrowerId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `message` (`OwnedBookListId`, `BorrowerId`, `RequestTime`, `ResponseTime`, `ResponseStatus`, `id`) VALUES
(31,	20,	NULL,	NULL,	NULL,	8),
(31,	20,	'2015-12-20 00:00:00',	NULL,	NULL,	9),
(31,	20,	'2015-12-20 00:00:00',	NULL,	NULL,	10),
(31,	20,	'2015-12-20 07:27:31',	NULL,	NULL,	11),
(31,	23,	'2015-12-21 10:13:22',	NULL,	NULL,	12),
(43,	23,	'2015-12-21 11:15:17',	NULL,	NULL,	13),
(45,	31,	'2015-12-21 14:16:30',	NULL,	NULL,	14),
(45,	32,	'2015-12-22 16:02:02',	NULL,	NULL,	15),
(42,	23,	'2015-12-23 03:55:10',	NULL,	NULL,	16),
(31,	23,	'2015-12-23 05:30:08',	NULL,	NULL,	17),
(45,	19,	'2015-12-23 08:47:31',	NULL,	NULL,	18),
(45,	19,	'2015-12-23 08:48:14',	NULL,	NULL,	19),
(43,	23,	'2015-12-23 08:58:21',	NULL,	NULL,	20),
(42,	23,	'2015-12-23 09:13:55',	NULL,	NULL,	21);

DROP TABLE IF EXISTS `ownedbooklist`;
CREATE TABLE `ownedbooklist` (
  `OwnedBookListId` int(10) NOT NULL AUTO_INCREMENT,
  `BookId` int(10) NOT NULL,
  `UserID` int(10) NOT NULL,
  `Sharetype` varchar(255) DEFAULT NULL,
  `IsAvailable` bit(1) DEFAULT NULL,
  PRIMARY KEY (`OwnedBookListId`),
  KEY `FKOwnedBookL305412` (`UserID`),
  KEY `FKOwnedBookL909047` (`BookId`),
  CONSTRAINT `FKOwnedBookL305412` FOREIGN KEY (`UserID`) REFERENCES `user` (`id`),
  CONSTRAINT `FKOwnedBookL909047` FOREIGN KEY (`BookId`) REFERENCES `bookinfo` (`BookId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ownedbooklist` (`OwnedBookListId`, `BookId`, `UserID`, `Sharetype`, `IsAvailable`) VALUES
(30,	3,	19,	NULL,	CONV('1', 2, 10) + 0),
(31,	4,	19,	NULL,	CONV('0', 2, 10) + 0),
(32,	5,	19,	NULL,	CONV('0', 2, 10) + 0),
(33,	6,	19,	NULL,	CONV('1', 2, 10) + 0),
(34,	7,	19,	NULL,	CONV('1', 2, 10) + 0),
(35,	8,	19,	NULL,	CONV('1', 2, 10) + 0),
(36,	9,	19,	NULL,	CONV('1', 2, 10) + 0),
(37,	10,	19,	NULL,	CONV('1', 2, 10) + 0),
(38,	11,	19,	NULL,	CONV('1', 2, 10) + 0),
(39,	12,	19,	NULL,	CONV('0', 2, 10) + 0),
(40,	13,	19,	NULL,	CONV('1', 2, 10) + 0),
(41,	14,	19,	NULL,	CONV('1', 2, 10) + 0),
(42,	15,	19,	NULL,	CONV('1', 2, 10) + 0),
(43,	16,	19,	NULL,	CONV('1', 2, 10) + 0),
(44,	19,	20,	NULL,	CONV('1', 2, 10) + 0),
(45,	20,	19,	NULL,	CONV('1', 2, 10) + 0),
(46,	21,	19,	NULL,	CONV('1', 2, 10) + 0);

DROP TABLE IF EXISTS `ownedbooklocations`;
CREATE TABLE `ownedbooklocations` (
  `OwnedBookListId` int(10) NOT NULL,
  `LocationId` int(10) NOT NULL,
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`),
  KEY `FKOwnedBookL51439` (`OwnedBookListId`),
  KEY `FKOwnedBookL761190` (`LocationId`),
  CONSTRAINT `FKOwnedBookL51439` FOREIGN KEY (`OwnedBookListId`) REFERENCES `ownedbooklist` (`OwnedBookListId`),
  CONSTRAINT `FKOwnedBookL761190` FOREIGN KEY (`LocationId`) REFERENCES `locations` (`LocationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ownedbooklocations` (`OwnedBookListId`, `LocationId`, `Id`) VALUES
(30,	2,	12),
(40,	1,	14),
(40,	4,	15),
(40,	5,	16),
(41,	1,	17),
(41,	2,	18),
(41,	5,	19),
(41,	10,	20),
(42,	4,	21),
(42,	11,	22),
(43,	2,	23),
(43,	11,	24),
(44,	3,	25),
(44,	8,	26),
(44,	9,	27),
(44,	10,	28),
(45,	1,	29),
(45,	13,	30),
(46,	1,	31),
(46,	6,	32),
(46,	13,	33),
(47,	1,	34),
(47,	2,	35),
(47,	6,	36),
(47,	13,	37),
(48,	1,	38),
(48,	2,	39),
(48,	6,	40),
(48,	13,	41);

DROP TABLE IF EXISTS `reputation`;
CREATE TABLE `reputation` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `RecipientId` int(10) DEFAULT NULL,
  `Point` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FKReputation875429` (`UserID`),
  CONSTRAINT `FKReputation875429` FOREIGN KEY (`UserID`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `reputation` (`Id`, `UserID`, `RecipientId`, `Point`) VALUES
(1,	13,	16,	4),
(2,	13,	10,	1),
(3,	13,	14,	5),
(4,	13,	13,	5),
(5,	19,	20,	4),
(6,	19,	31,	3);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `UserFullName` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL,
  `MobileNo` varchar(20) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `UserFullName`, `password`, `email`, `PhoneNo`, `MobileNo`, `remember_token`) VALUES
(1,	'',	'',	'',	'',	'',	NULL),
(2,	'UserFullName not set',	'Password  not set',	'Email not set',	'123',	'123',	NULL),
(3,	'ala',	'Password  not set',	'alamin2@gmail.com',	'1',	'2',	NULL),
(6,	'ala',	'Password  not set',	'alamin3@gmail.com',	'1',	'2',	NULL),
(7,	'ala',	'Password  not set',	'alamin4@gmail.com',	'1',	'2',	NULL),
(8,	'ala',	'$2y$10$geDNaQ38473yOquFkF9XFe9YqpltFfoghmZ9fYDsYgWr4Q0mKwsO2',	'alamin5@gmail.com',	'1',	'2',	NULL),
(9,	'ala',	'a',	'alamin6@gmail.com',	'1',	'2',	NULL),
(10,	'ala',	'eyJpdiI6IjhTeVJ0Y3dPdzdYb1M3TldVeEdpN2c9PSIsInZhbHVlIjoiOGlM',	'alamin7@gmail.com',	'1',	'2',	NULL),
(11,	'ala',	'eyJpdiI6IjQrVTh1ejBVQ2wwU2dTb3pRWm5WaGc9PSIsInZhbHVlIjoibWE0',	'alamin8@gmail.com',	'1',	'2',	NULL),
(12,	'ala12',	'$2y$10$AeMfE3xJv3JWNs4Lcl0fNOKRpVvzuE6N78xDZgMmfierRrFUY9lBW',	'alamin9@gmail.com',	'1',	'123',	NULL),
(13,	'ala13',	'$2y$10$5JeNgKsZqrFsETAD8xc9fOjzVmDCUyz9mF9q4G4ZEkcAV5lB2AMiC',	'a10@gmail.com',	'012214555885',	'015855224458',	'T3qItSDFqENXITnNKvX22FuKHFsPHpQR3nMiioUDzXihWV5BipQGApx9TR03'),
(15,	'shafi ',	'$2y$10$0TeFafMgA400hntSetn/u.Ufvrulm8YeCh9.eGsChiCEiPCUwfOFa',	'shafi@gmail.com',	'123413',	'1324132413',	'H78qa2wEeOWcQoD1LYULYZHDwIydi10LTjgfqZpW6yuvdHTYZIsKKE2IpQh7'),
(16,	'tarik toha',	'$2y$10$rY5Ui.Li0oE/YW8Lnw2CtuOCAV/jmpZfdiF5H9eZxzbxbo0acnJsa',	'toha@gmail.com',	'435345',	'3453245',	NULL),
(18,	'alamin',	'$2y$10$dQldGfHntda0JrWdnhv8suqsBkv.ugzOky6OdEKdQBQCpd/Ckt3fK',	'a18@gmail.com',	'32423',	'324123',	NULL),
(19,	'alamin20',	'$2y$10$QzJQv.9sw3PBeWSIjo782unM16tX8n3OHB.tSQfvRHgpY3or7hDIa',	'a20@gmail.com',	'123413',	'1234132',	'321MgIxZ8r7OmNR7zSYHleV2iY4EgjDhDHrxkDAXaQa9KOso5zGrgyX6Yvhd'),
(20,	'alamin21',	'$2y$10$qr7..RXw6NW7SKg.2Xz1yec8P0FocnpC6Uy3FEiJXWsgitS8grKwu',	'a21@gmail.com',	'23143',	'13432',	NULL),
(22,	'alamin22',	'$2y$10$4DsfKtAOAog4.GU0o3ADl.j2HkWsHwI2hojxids2ModkgzjV9u4Le',	'a22@gmail.com',	'23143',	'13432',	NULL),
(23,	'alamin25',	'$2y$10$hYEqV3rmGDhmGknLG2xU2ury1DNjbRKaCDO9foSjJnRA/bd2hriOK',	'a25@gmail.com',	'234131',	'1341324',	'9fTyh80pRdGsRqgfdtAmAEpIjI8czuSVdH1gqC4fupZt2XSD9LmGvzMf5D46'),
(26,	'shafi ',	'$2y$10$adWf/5cDmZc8B0VVCt0s/uSLfhXKm7FbsDO.8Jgg7MS6gq7r6V.Hi',	'shafi1@gmail.com',	'015',	'0202',	NULL),
(29,	'shafi ',	'$2y$10$mAZzyqLF.NgmC6fvwhzXMujEPErT.D5ghsRcWpeQmPeW4ByT55vJG',	'shafi2@gmail.co',	'015',	'0202',	NULL),
(30,	'shafi3',	'$2y$10$N27/ufRpVsyVeLzA/G.XRO9svHeRbNCT/NK0LiOqLNTdAQBXz.nEW',	'shafi3@gmail.co',	'015',	'0202',	NULL),
(31,	'shafi5',	'$2y$10$4Y7ufONQAK7vGImcI6SxNuivb76UNhgfrfhyobG6rjcoK2dO4DBNy',	'shafi5@gmail.com',	'234',	'2314',	NULL),
(32,	'a15',	'$2y$10$muJxzeUW4uFUzMg.Nn4JXuT.7Z3hDO7kr6Gh1WPwLp7SZK8iIr/0u',	'alamin26@gmail.com',	'4343523',	'243534',	NULL);

DROP TABLE IF EXISTS `user2`;
CREATE TABLE `user2` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user2` (`userId`, `UserName`) VALUES
(1,	'alamin'),
(2,	NULL),
(3,	NULL),
(4,	'alamin');

DROP TABLE IF EXISTS `userlocations`;
CREATE TABLE `userlocations` (
  `UserID` int(10) NOT NULL,
  `LocationId` int(10) NOT NULL,
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`),
  KEY `FKLocations_180564` (`LocationId`),
  KEY `FKLocations_659430` (`UserID`),
  CONSTRAINT `FKLocations_180564` FOREIGN KEY (`LocationId`) REFERENCES `locations` (`LocationId`),
  CONSTRAINT `FKLocations_659430` FOREIGN KEY (`UserID`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `userlocations` (`UserID`, `LocationId`, `Id`) VALUES
(20,	3,	42),
(20,	8,	43),
(20,	9,	44),
(20,	10,	45),
(23,	1,	46),
(23,	3,	47),
(23,	6,	48),
(19,	1,	80),
(19,	2,	81),
(19,	11,	82),
(19,	13,	83);

-- 2016-02-12 10:45:44
