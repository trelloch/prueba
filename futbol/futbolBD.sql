create database futbol;
use futbol;

create table conferencias
(
	ConfId varchar(5) primary key not null,
	ConfNombre varchar(50) not null
)engine=InnoDb charset=utf8 collate=utf8_unicode_ci;

insert into conferencias (ConfId , ConfNombre) values('CONFE', 'Conferencia Este'), ('CONFO' , 'Conferencia Oeste');

select * from conferencias;

create table equipos
(
	EquId varchar(5) primary key not null,
	EquNombre varchar(50) not null,
	EquIdConferencia varchar(5) not null,
	EquLogo varchar(20) not null
);

insert into equipos (EquId, EquNombre, EquIdConferencia, EquLogo) values('CLUBA', 'Club America', 'CONFE', 'america.png'),('CLU', 'Club Atlante', 'CONFE', 'atlante.gif'),
('CRUZ', 'Cruz Azul', 'CONFE', 'cruzAzul.jpeg'),('GUA', 'Guadalajara', 'CONFO', 'chivas.png'),('CMO', 'Club Monarcas', 'CONFO', 'monarcas.jpg'),
('LPMS', 'Los Pumas', 'CONFO', 'pumas.jpg'),('CTO', 'Club Toluca', 'CONFE', 'toluca.jpg'),('CTIJ', 'Club Tijuana', 'CONFO', 'xolos.jpg');



create table posiciones
(
	PosId int auto_increment primary key not null,
	PosNombre varchar(50) not null
);

insert into posiciones(PosNombre) values('Portero'), ('Defensa'), ('Medio');

create table jugadores
(
	JugId int auto_increment primary key not null,
	JugNombre varchar(50) not null,
	JugNumero int not null,
	JugIdEquipo varchar(5) not null,
	JugIdPosicion varchar(5) not null,
	JugGoles int not null
);

insert into jugadores(JugNombre, JugNumero, JugIdEquipo, JugIdPosicion, JugGoles) values
('Jesus Corona', 1, 'CRUZ', 1, 72),
('Fausto Pinto', 2, 'CRUZ', 2, 25),
('Francisco Rodriguez', 3, 'CRUZ', 2, 56),
('Julio Cesar Dominguez', 4, 'CRUZ', 2, 28),
('Hugo Gonzalez', 1, 'CLUBA', 1, 63),
('Paolo Goltz', 2, 'CLUBA', 2, 85),
('Gil Buron', 3, 'CLUBA', 2, 15),
('Erik Pimentel', 4, 'CLUBA', 2, 33);

