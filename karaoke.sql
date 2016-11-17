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
	FOREIGN KEY (userID) REFERENCES User(userID),
	FOREIGN KEY (fileID) REFERENCES File(fileID));
CREATE TABLE PaidAdd (
	paidAddID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT,
	fileID INT,
	time TIME,
	FOREIGN KEY (userID) REFERENCES User(userID),
	FOREIGN KEY (fileID) REFERENCES File(fileID));
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
	("Vamilla Ice"),
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
/* Typed by Edward */
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
/* 
Type this in SQL to display the Title and Artist
SELECT text, name FROM File F, Artist A, Title T where F.artistID = A.artistID AND F.titleID = T.titleID;
If anyone else can check the data to make sure that it is correct, it'd be appreciated.  
*/
INSERT INTO Contributes(fileID,contribID,type) VALUES
	(1,1,"Writer"),
	(1,2,"Producter"),
	(2,3,"Writer"),
	(2,4,"Producter"),
	(3,5,"Writer"),
	(3,6,"Producter"),
	(4,7,"Writer"),
	(4,8,"Producter"),
	(5,9,"Writer"),
	(5,10,"Producter"),
	(6,11,"Writer"),
	(6,12,"Writer"),
	(6,13,"Producter"),
	(7,11,"Writer"),
	(7,12,"Writer"),
	(8,14,"Writer"),
	(8,15,"Writer"),
	(8,16,"Producter"),
	(9,17,"Writer"),
	(9,18,"Producter"),
	(10,2,"Producter"),
	(10,19,"Producter"),
	(11,20,"Writer"),
	(11,21,"Producter"),
	(12,22,"Writer"),
	(12,23,"Producter"),
	(13,24,"Writer"),
	(13,25,"Producter"),
	(14,26,"Writer"),
	(14,27,"Writer"),
	(14,28,"Producter"),
	(15,29,"Writer"),
	(15,30,"Producter"),
	(16,31,"Production"),
	(16,32,"Direction"),
	(16,33,"Direction"),
	(17,31,"Production"),
	(17,32,"Direction"),
	(17,34,"Mixing"),
	(18,35,"Vocals"),
	(19,36,"Vocals"),
	(19,37,"Brass"),
	(20,38,"Vocals");
/*
SELECT F.fileID, name, type from Contributes C, File F, Contributor CC where C.contribID = CC.contribID AND C.fileID = F.fileID;
Shows the title, artist, contributor, and type (title/artist repeat but this is for show so yeah)
SELECT text, A.name, CC.name, type FROM Artist A, Contributes C, Title T, File F, Contributor CC where F.artistID = A.artistID AND F.titleID = T.titleID AND C.fileID = F.fileID AND C.contribID = CC.contribID;
*/
