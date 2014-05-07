DROP DATABASE IF EXISTS Formular;

CREATE DATABASE Formular;

USE Formular;

CREATE TABLE formular
       ( id INT AUTO_INCREMENT PRIMARY KEY
      , title VARCHAR(50)
      , name VARCHAR(50)
      , userName VARCHAR(50)
      , password VARCHAR(50) 
      , email VARCHAR(50));


CREATE TABLE formularWerte
       ( formularId INT 
      , name VARCHAR(50)
      , feldArt INT
      , duty INT
      , werte VARCHAR(50) );


INSERT INTO formular 
       (title, name, userName, password) 
       VALUES ('Test', 'test', 'nicolas', 'asdf');