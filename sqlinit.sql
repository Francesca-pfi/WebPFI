drop table if exists users;
drop table if exists albums;
drop table if exists images;
drop table if exists commentsAlbums;
drop table if exists commentsImages;

CREATE TABLE IF NOT EXISTS users 
(id INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(25) UNIQUE NOT NULL,
username VARCHAR(25) NOT NULL,
password VARCHAR(250) NOT NULL,
profilePic varchar(100) not null);

CREATE TABLE IF NOT EXISTS albums
(id INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(25) NOT NULL,
desc varchar(250) not null,
userID interger(10) NOT NULL,
date date NOT NULL);

CREATE TABLE IF NOT EXISTS images
(id INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
albumID INTEGER(10) NOT NULL,
url varchar(100) NOT NULL,
date date NOT NULL);

CREATE TABLE IF NOT EXISTS commentsAlbums
(idComment INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
idAlbum INTEGER(10) NOT NULL,
content varchar(250) NOT NULL,
date date NOT NULL);

CREATE TABLE IF NOT EXISTS commentsImages
(idComment INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
idImage INTEGER(10) NOT NULL,
content varchar(250) NOT NULL,
date date NOT NULL);