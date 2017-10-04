DROP TABLE IF EXISTS `Account`;
CREATE TABLE `Account`(
 `AccountID` int(11) NOT NULL AUTO_INCREMENT,
 `UserName` varchar(255) NOT NULL,
 `FirstName` varchar(255) NOT NULL,
 `LastName` varchar(255) NOT NULL,
 `Educator` int NOT NULL DEFAULT 0,
 check(`Educator` = 0 OR `Educator` = 1),
 `Password` varchar(255) NOT NULL,
 /* Passwords can be 6-18 char long*/
 check(LEN(`Password`) >= 6 AND LEN(`Password`) <= 18),
 PRIMARY KEY (`AccountID`),
 UNIQUE KEY (`UserName`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `Community`;
CREATE TABLE `Community` (
  `CommunityID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `State` varchar(255),
  `Country` varchar (255) NOT NULL,
  `SkillNeeded` varchar(255) NOT NULL,
  `UserComments` varchar(255),
  PRIMARY KEY (`CommunityID`),      /*changed from professID to COmmunityID*/
  UNIQUE KEY (`CommunityID`, `SkillNeeded`)
) ENGINE=InnoDB;


INSERT INTO `Community` (`Name`, `State`, `Country`, `SkillNeeded`, `UserComments`) VALUES
("Blackwater", "Arizona", "United States", "Automotive Mechanic", null),
("Athens", "Ohio", "United States", "Locomotive Mechanic", null),
("Cite Soleil", NULL, "Haiti", "Aircraft Mechanic", null),
("Cidade de Deus", NULL, "Brazil", "Welding", null), 
("Phoenix", "Arizona", "United States", "Roofer", "Bring your own tools");
 
 
DROP TABLE IF EXISTS `Account_Community`;
CREATE TABLE `Account_Community` (
  `AccountID` int(11) NOT NULL,
  `CommunityID` int(11) NOT NULL,
  `SkillID` varchar(255) NOT NULL,
  `StartDate` DATE NOT NULL,
  `EndDate` DATE NOT NULL,
  PRIMARY KEY (`AccountID`, `CommunityID`),
  FOREIGN KEY (`AccountID`) REFERENCES `Account` (`AccountID`),
  FOREIGN KEY (`CommunityID`, `SkillID`) REFERENCES `Community` (`CommunityID`,`SkillNeeded`),
  FOREIGN KEY (`SkillID`) REFERENCES `Community` (`SkillNeeded`)
) ENGINE=InnoDB;
