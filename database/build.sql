drop database mymovielist_db;
create database mymovielist_db;
use mymovielist_db;

CREATE TABLE Movie
(
    movieID 	int(5)  AUTO_INCREMENT,
    title 		varchar(255) NOT NULL,
    summary 	varchar(1000),
    releaseDate DATE,
    ratingID 		int(4),
    runtime		int(5),
	score 	decimal(2, 1),
    primary key (movieID),
    foreign key (ratingID) REFERENCES Rating(ratingID)
);

INSERT INTO Movie VALUES (NULL, 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanitys survival.', '2014-10-10', 1, 180, 7.7);
INSERT INTO Movie VALUES (NULL, 'Inception', 'A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.', '2010-10-10', 2, 120, 9.8);
INSERT INTO Movie VALUES (NULL, 'The Dark Knight', 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham, the Dark Knight must accept one of the greatest psychological and physical tests of his ability to fight injustice.', '2009-10-10', 2, 130, 4.2);
INSERT INTO Movie VALUES (NULL, 'Pulp Fiction', 'The lives of two mob hit men, a boxer, a gangsters wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', '1991-01-02', 4, 120, 1.1);
INSERT INTO Movie VALUES (NULL, 'Inglorious Bastards', 'In Nazi-occupied France during World War II, a plan to assassinate Nazi leaders by a group of Jewish U.S. soldiers coincides with a theatre owners vengeful plans for the same.', '2010-05-02', 4, 140, 0.0);
INSERT INTO Movie VALUES (NULL, 'Rock n Rolla', 'In London, a real-estate scam puts millions of pounds up for grabs, attracting some of the citys scrappiest tough guys and its more established underworld types, all of whom are looking to get rich quick.', '2011-05-01', 2, 135, 6.4);
INSERT INTO Movie VALUES (NULL, 'Lock Stock and Two Smoking Barrels', 'A botched card game in London triggers four friends, thugs, weed-growers, hard gangsters, loan sharks and debt collectors to collide with each other in a series of unexpected events, all for the sake of weed, cash and two antique shotguns.', '1994-11-04', 3, 115, 2.2);
INSERT INTO Movie VALUES (NULL, 'Snatch', 'Unscrupulous boxing promoters, violent bookmakers, a Russian gangster, incompetent amateur robbers, and supposedly Jewish jewelers fight to track down a priceless stolen diamond.', '2001-12-21', 1, 165, 5.6);
INSERT INTO Movie VALUES (NULL, 'King Arthur: Legend of the Sword', 'Robbed of his birthright, Arthur comes up the hard way in the back alleys of the city. But once he pulls the sword from the stone, he is forced to acknowledge his true legacy - whether he likes it or not.', '2017-05-27', 1, 156, 7.3);

CREATE TABLE Rating
(
    ratingID int(5) AUTO_INCREMENT,
    description varchar(40),
    primary key (ratingID)
);

INSERT INTO Rating VALUES (NULL, 'G');
INSERT INTO Rating VALUES (NULL, 'PG');
INSERT INTO Rating VALUES (NULL, 'M');
INSERT INTO Rating VALUES (NULL, 'MA');
INSERT INTO Rating VALUES (NULL, 'R');

CREATE TABLE Genre
(
    genreID 	int(5) AUTO_INCREMENT,
    description	varchar(40) NOT NULL,
    primary key (genreID)
);

INSERT INTO Genre VALUES (NULL, 'Action');
INSERT INTO Genre VALUES (NULL, 'Romance');
INSERT INTO Genre VALUES (NULL, 'Comedy');
INSERT INTO Genre VALUES (NULL, 'Scifi');
INSERT INTO Genre VALUES (NULL, 'Horror');
INSERT INTO Genre VALUES (NULL, 'Thriller');
INSERT INTO Genre VALUES (NULL, 'Fantasy');
INSERT INTO Genre VALUES (NULL, 'Adventure');
INSERT INTO Genre VALUES (NULL, 'Western');
INSERT INTO Genre VALUES (NULL, 'Space');
INSERT INTO Genre VALUES (NULL, 'Documentary');
INSERT INTO Genre VALUES (NULL, 'History');


CREATE TABLE MovieGenre
(
    movieID 		int(5) NOT NULL,
    genreID 		int(5) NOT NULL,
    primary key (movieID, genreID),
    foreign key (movieID) references Movie(movieID),
    foreign key (genreID) references Genre(genreID)
);

INSERT INTO MovieGenre VALUES (1, 4);
INSERT INTO MovieGenre VALUES (1, 8);
INSERT INTO MovieGenre VALUES (2, 1);
INSERT INTO MovieGenre VALUES (2, 6);
INSERT INTO MovieGenre VALUES (3, 1);
INSERT INTO MovieGenre VALUES (3, 6);

CREATE TABLE Professional
(
    professionalID		int(5) AUTO_INCREMENT,
    firstName			varchar(40) NOT NULL,
    lastName			varchar(40) NOT NULL,
    description			varchar(40),
    primary key (professionalID)
);

INSERT INTO Professional VALUE (NULL, 'Christopher', 'Nolan', '');
INSERT INTO Professional VALUE (NULL, 'Guy', 'Ritchie', '');
INSERT INTO Professional VALUE (NULL, 'Quentin', 'Tarantino', '');
INSERT INTO Professional VALUE (NULL, 'Matthew', 'McConaughey', '');

CREATE TABLE MovieProfessional
(
    movieID		int(5) NOT NULL,
    professionalID	int(5) NOT NULL,
	roleID int(5) NOT NULL,
    description	varchar(40) NOT NULL,
    primary key (movieID, professionalID, roleID),
    foreign key (movieID) references Movie(movieID),
    foreign key (professionalID) references Professional(professionalID),
	foreign key (roleID) references Role(roleID)
);

INSERT INTO MovieProfessional VALUES (1, 1, 1, '');
INSERT INTO MovieProfessional VALUES (4, 3, 1, '');
INSERT INTO MovieProfessional VALUES (1, 3, 3, 'Actor 1');
INSERT INTO MovieProfessional VALUES (1, 4, 3, 'Actor 2');

CREATE TABLE Role
(
    roleID int(5) AUTO_INCREMENT,
    description varchar(40) NOT NULL,
    primary key (roleID)
);

INSERT INTO Role VALUES (NULL, 'Director');
INSERT INTO Role VALUES (NULL, 'Assistant Director');
INSERT INTO Role VALUES (NULL, 'Actor');
INSERT INTO Role VALUES (NULL, 'Producer');
INSERT INTO Role VALUES (NULL, 'Other');

CREATE TABLE User
(
    userID int(5) AUTO_INCREMENT,
    userName	varchar(20) NOT NULL,
    password varchar(20) NOT NULL,
    email		varchar(40) NOT NULL,
    joinDate	DATE NOT NULL,
    primary key (userID)
);

INSERT INTO User VALUES (NULL, 'user', 'password', 'mail@mail.com', '2017-01-01');

CREATE TABLE MovieUser
(
    movieID int(5) NOT NULL,
    userID int(5) NOT NULL,
    addedDate DATE NOT NULL,
    completedDate DATE,
    score int(1),
    statusID int(5) NOT NULL,
    primary key (movieID, userID),
    foreign key (movieID) references Movie(movieID),
    foreign key (userID) references User(userID),
    foreign key (statusID) references Status(statusID)
);

INSERT INTO MovieUser VALUES (1, 1, '2017-01-02', '2016-12-12', 9, 3);
INSERT INTO MovieUser VALUES (4, 1, '2017-01-03', '2016-12-15', 6, 3);
INSERT INTO MovieUser VALUES (5, 1, '2017-01-04', '2016-12-22', 1, 3);
INSERT INTO MovieUser VALUES (2, 1, '2017-01-04', '2016-12-22', NULL, 1);

CREATE TABLE MovieUserStatus
(
	movieUserStatusID int(5) AUTO_INCREMENT,
	description varchar(40),
	primary key (movieUserStatusID)
);

INSERT INTO MovieUserStatus VALUES (NULL, 'Plan to Watch');
INSERT INTO MovieUserStatus VALUES (NULL, 'Watching');
INSERT INTO MovieUserStatus VALUES (NULL, 'Completed');
INSERT INTO MovieUserStatus VALUES (NULL, 'Blacklist');

CREATE TABLE Admin
(
    adminID int(5) AUTO_INCREMENT,
    userName	varchar(20) NOT NULL,
	password	varchar(20) NOT NULL,
    primary key (adminID)
);

INSERT INTO Admin VALUES (NULL, 'admin', 'admin');

DELIMITER //
CREATE PROCEDURE getDirectors
(IN param1 int(5))
BEGIN
	SELECT p.professionalID, p.firstName, p.lastName FROM 
	movie as m
	INNER JOIN movieProfessional as mp on mp.movieID = m.movieID
	INNER JOIN role as r on mp.roleID = r.roleID
	INNER JOIN professional as p on mp.professionalID = p.professionalID
	WHERE m.movieID = param1 and r.roleID = 1;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE getActors
(IN param1 int(5))
BEGIN
	SELECT p.professionalID, p.firstName, p.lastName, mp.description FROM 
	movie as m
	INNER JOIN movieProfessional as mp on mp.movieID = m.movieID
	INNER JOIN role as r on mp.roleID = r.roleID
	INNER JOIN professional as p on mp.professionalID = p.professionalID
	WHERE m.movieID = param1 and r.roleID = 3;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE getGenres
(IN param1 int(5))
BEGIN
	SELECT g.genreID, g.description FROM 
	genre as g
	INNER JOIN moviegenre as mg on g.genreID = mg.genreID
	INNER JOIN movie as m on mg.movieID = m.movieID
	WHERE m.movieID = param1;
END //
DELIMITER ;

DROP USER 'user_default'@'%';
flush privileges;
CREATE USER 'user_default'@'%' IDENTIFIED BY 'password';
GRANT SELECT, INSERT ON mymovielist_db.User TO 'user_default'@'%';