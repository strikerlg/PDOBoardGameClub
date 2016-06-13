CREATE DATABASE boardgames;

USE boardgames;

CREATE TABLE players
(
  playerID INT NOT NULL AUTO_INCREMENT,
  firstName VARCHAR(100) NOT NULL,
  lastName VARCHAR(100) NOT NULL,
  emailAddress VARCHAR(250) NOT NULL,
  phoneNumber VARCHAR(50) NOT NULL,
  PRIMARY KEY (playerID) 
);

CREATE TABLE gamesassigned
(
  boardGameID INT NOT NULL AUTO_INCREMENT,
  boardGame VARCHAR(100) NOT NULL,
  playerID INT NOT NULL,
  PRIMARY KEY (boardGameID),
  FOREIGN KEY (playerID) REFERENCES players(playerID)
);

CREATE TABLE gamesavailable
(
  boardGameID INT NOT NULL AUTO_INCREMENT,
  boardGameAvailable VARCHAR(100) NOT NULL,
  playerID INT NOT NULL,
  PRIMARY KEY (boardGameID),
  FOREIGN KEY (playerID) REFERENCES players(playerID)
);

CREATE TABLE highscores
(
  scoreID INT NOT NULL AUTO_INCREMENT,
  wins INT NOT NULL,
  losses INT NOT NULL,
  playerID INT NOT NULL,
  PRIMARY KEY (scoreID),
  FOREIGN KEY (playerID) REFERENCES players(playerID)
);

CREATE TABLE schedule
(
  scheduleID INT NOT NULL AUTO_INCREMENT,
  location VARCHAR(100) NOT NULL,
  /* Using VARCHAR for dayPlaying rather than DATETIME
  because of issues with php form validation (Don't want to use 
  US time format in MySQL) */
  dayPlaying VARCHAR(50) NOT NULL,
  PRIMARY KEY (scheduleID)
);