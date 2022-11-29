drop database if exists GestRetards;
create database GestRetards;
use GestRetards;


create table Administrateur (
    IdAd int not null,
    nom varchar(25) not null,
    prenom varchar (25) not null,
    email varchar (40) not null,
    diplome varchar (25) not null,
    signatureAd varchar (25) not null,
    idCon varchar (25) not null,
    mdp varchar (25) not null,
    constraint pk_Administrateur primary key (IdAd)
);

create table Professeur(
    IdPf int not null,
    nom varchar (25) not null,
    prenom varchar (25) not null,
    email varchar (25) not null,
    telephone varchar (10) not null,
    diplome varchar (25) not null,
    idCon varchar (25) not null,
    mdp varchar (25) not null,
    constraint pk_Professeur primary key (IdPf)
);

create table Transport (
    IdTp int not null auto_increment,
    code varchar (6) not null ,
    nom varchar (25) not null,
    type varchar (20) not null,
    constraint pk_Transport primary key (IdTp)
);

create table Classe (
    IdCl int not null,
    nom varchar (25) not null,
    nbEtudiants int (2) not null,
    email varchar (25) not null,
    constraint pk_Classe primary key (IdCl)
);

create table Etudiant (
    IdE int not null auto_increment,
    nom varchar (25) not null,
    prenom varchar (25) not null,
    email varchar (25) not null,
    telephone varchar (10) not null,
    adresse varchar (40) not null,
    IdCon varchar (25),
    mdp varchar (25) not null,
    IdCl int not null,
    constraint pk_Etudiant primary key (IdE,IdCl),
    constraint fk_Classe foreign key (IdCl) references Classe(IdCl)
);

create table Station(
    IdSt int not null,
    nom varchar (25) not null,
    IdTp int not null,
    constraint pk_Station primary key (IdSt),
    constraint fk_Transport foreign key (IdTp) references Transport(IdTp)
);

create table Perturbation(
    IdPt int not null auto_increment,
    raison varchar (50),
    dateDeb date,
    dateFin date,
    jourDeb enum('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'),
    jourFin enum('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'),
    heureDeb time,
    IdTp int not null,
    constraint pk_Perturbation primary key (IdPt, IdTp),
    constraint fk_Transport2 foreign key (IdTp) references Transport(IdTp)
);

create table Trajet(
    IdTj int not null auto_increment,
    IdE int not null,
    dureeTotale time,
    constraint pk_Trajet primary key (IdTj, IdE),
    constraint fk_Etudiant2 foreign key (IdE) references Etudiant(IdE)
);

create table Cours(
    IdCl int not null,
    IdPf int not null,
    matiere varchar (25) not null,
    dateC date not null,
    heureDeb time not null,
    heureFin time not null,
    duree time,
    salle varchar (20),
    constraint pk_Cours primary key (IdCl, IdPf),
    constraint fk_Classe2 foreign key (IdCl) references Classe(IdCl),
    constraint fk_Professeur2 foreign key (IdPf) references Professeur(IdPf)
);

create table Avoir(
    IdTp int not null,
    IdTj int not null,
    constraint pk_Avoir primary key(IdTp,IdTj),
    constraint fk_Transport3 foreign key (IdTp) references Transport(IdTp),
    constraint fk_Trajet foreign key (IdTj) references Trajet(IdTj)
);

create table Billet(
    dateB datetime not null,
    dureeRetard time not null,
    URLSignature varchar (50) not null,
    IdAd int not null,
    IdE int not null,
    constraint pk_Billet primary key (IdE, IdAd),
    constraint fk_Etudiant3 foreign key (IdE) references Etudiant(IdE),
    constraint fk_Administrateur foreign key (IdAd) references Administrateur(IdAd) 
);

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/Transports.txt' into table Transport (IdTp,code,nom,type);