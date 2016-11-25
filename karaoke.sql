/* DEBUG STATEMENT*/
/* SELECT CC.name AS Contributor, text AS Title, A.name AS Artist, type AS Type FROM Artist A, Contributes C, Title T, File F, Contributor CC where F.artistID = A.artistID AND F.titleID = T.titleID AND C.fileID = F.fileID AND C.contribID = CC.contribID;*/

/* Drop tables if they already exist*/
DROP TABLE IF EXISTS Contributes;
DROP TABLE IF EXISTS FreeAdd;
DROP TABLE IF EXISTS PaidAdd;
DROP TABLE IF EXISTS File;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Contributor;
DROP TABLE IF EXISTS Artist;
DROP TABLE IF EXISTS Title;

/* Create Tables*/
CREATE TABLE User (
	userID INT AUTO_INCREMENT PRIMARY KEY,
	name varchar(100),
	ccNum int);
CREATE TABLE Contributor (
	contribID INT AUTO_INCREMENT PRIMARY KEY,
	name varchar(100));
CREATE TABLE Artist (
	artistID INT AUTO_INCREMENT PRIMARY KEY,
	name varchar(100));
CREATE TABLE Title (
	titleID INT AUTO_INCREMENT PRIMARY KEY,
	text varchar(100));
CREATE TABLE File (
	fileID INT AUTO_INCREMENT PRIMARY KEY,
	path varchar(100),
	artistID INT,
	titleID INT,
	FOREIGN KEY (artistID) REFERENCES Artist(artistID),
	FOREIGN KEY (titleID) REFERENCES Title(titleID));
CREATE TABLE Contributes (
	fileID INT,
	contribID INT,
	type varchar(100),
	PRIMARY KEY(fileID, contribID),
	FOREIGN KEY (fileID) REFERENCES File(fileID),
	FOREIGN KEY (contribID) REFERENCES Contributor(contribID));
CREATE TABLE FreeAdd (
	freeAddID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT,
	fileID INT,
	time TIME,
	played BOOLEAN,
	FOREIGN KEY (userID) REFERENCES User(userID),
	FOREIGN KEY (fileID) REFERENCES File(fileID));
CREATE TABLE PaidAdd (
	paidAddID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT,
	fileID INT,
	time TIME,
	amount DECIMAL(8,2),
	played BOOLEAN,
	FOREIGN KEY (userID) REFERENCES User(userID),
	FOREIGN KEY (fileID) REFERENCES File(fileID));

/* Insert data into tables*/
INSERT INTO Contributor(name) VALUES
	("Anthony Ray"),
	("Rick Rubin"),
	("Earthquake"),
	("Vanilla Ice"),
	("Jimmy Buffet"),
	("Norbert Putnam"),
	("Richie Sambora"),
	("Bruce Fairbairn"),
	("Robert Hazard"),
	("Rick Chertoff"),
	("John Lenon"),
	("Paul McCartney"),
	("George Martin"),
	("Jack Black"),
	("Kyle Gass"),
	("The Dust Brothers"),
	("Freddie Mercury"),
	("Roy Thomas Baker"),
	("Mike Shinoda"),
	("Jim Adkins"),
	("Just Meldal-Johnsen"),
	("Chancelor Bennett"),
	("Brasstracks"),
	("Abel Tesfaye"),
	("Martin McKinney"),
	("Ben Gibbard"),
	("Jimmy Tamborello"),
	("The Postal Service"),
	("Usher Raymond IV"),
	("Carlos St. John"),
	("John Boylan"),
	("Paul Ahern"),
	("Charles McKenzie"),
	("Steve Hodge"),
	("Gwyneth Paltrow"),
	("Beyonce"),
	("Regiment Horns"),
	("Tove Lo");
INSERT INTO Artist(name) VALUES
	("Sir Mix-A-Lot"),
	("Vanilla Ice"),
	("Jimmy Buffet"),
	("Bon Jovi"),
	("Cyndi Lauper"),
	("The Beatles"),
	("Aerosmith"),
	("Tenacious D"),
	("Queen"),
	("Linkin Park"),
	("Jimmy Eat World"),
	("Chance the Rapper, Lil Wayne, 2 Chainz"),
	("The Weeknd"),
	("Postal Service"),
	("Usher"),
	("Boston"),
	("Coldplay");
INSERT INTO Title(text) VALUES
	("Baby Got Back"),
	("Ice Ice Baby"),
	("Margaritaville"),
	("Wanted Dead Or Alive"),
	("Girls Just Wanna Have Fun"),
	("Come Together"),
	("Tribute"),
	("Bohemian Rhapsody"),
	("What I've Done"),
	("Sure and Certain"),
	("No Problem"),
	("False Alarm"),
	("Such Great Heights"),
	("Crash"),
	("More Than A Feeling"),
	("Peace of Mind"),
	("Everglow"),
	("Hymn for the Weekend"),
	("Fun");
INSERT INTO File(artistID,titleID) VALUES
	(1,1),
	(2,2),
	(3,3),
	(4,4),
	(5,5),
	(6,6),
	(7,6),
	(8,7),
	(9,8),
	(10,9),
	(11,10),
	(12,11),
	(13,12),
	(14,13),
	(15,14),
	(16,15),
	(16,16),
	(17,17),
	(17,18),
	(17,19);
INSERT INTO Contributes(fileID,contribID,type) VALUES
	(1,1,"Writer"),
	(1,2,"Producer"),
	(2,3,"Writer"),
	(2,4,"Producer"),
	(3,5,"Writer"),
	(3,6,"Producer"),
	(4,7,"Writer"),
	(4,8,"Producer"),
	(5,9,"Writer"),
	(5,10,"Producer"),
	(6,11,"Writer"),
	(6,12,"Writer"),
	(6,13,"Producer"),
	(7,11,"Writer"),
	(7,12,"Writer"),
	(8,14,"Writer"),
	(8,15,"Writer"),
	(8,16,"Producer"),
	(9,17,"Writer"),
	(9,18,"Producer"),
	(10,2,"Producer"),
	(10,19,"Producer"),
	(11,20,"Writer"),
	(11,21,"Producer"),
	(12,22,"Writer"),
	(12,23,"Producer"),
	(13,24,"Writer"),
	(13,25,"Producer"),
	(14,26,"Writer"),
	(14,27,"Writer"),
	(14,28,"Producer"),
	(15,29,"Writer"),
	(15,30,"Producer"),
	(16,31,"Producer"),
	(16,32,"Director"),
	(16,33,"Director"),
	(17,31,"Producer"),
	(17,32,"Director"),
	(17,34,"Mixing"),
	(18,35,"Vocals"),
	(19,36,"Vocals"),
	(19,37,"Brass"),
	(20,38,"Vocals");
