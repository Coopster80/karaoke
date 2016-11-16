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
