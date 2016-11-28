create database islamquiz;
use islamquiz;
create table tblPyetja
(
PID int not null auto_increment,
txtPyetjes varchar(500) not null,
alternativat varchar(560),
pSakte varchar(140) not null,
fotoLocation varchar(150),
primary key(PID)
);
create table tblAdmin
(
AID int not null auto_increment,
Salt double,
Fjalekalimi varchar(25),
Privilegji int NOT NULL DEFAULT '2'
primary key(AID)
);