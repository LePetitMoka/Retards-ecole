drop database if exists GestRetards;
create database GestRetards;
use GestRetards;

create table Professeur (
    IdPf int (6) not null auto_increment,
    nom varchar (25) not null,
    prenom varchar (25) not null,
    role char (15) default 'Professeur',
    email varchar (25) not null unique,
    telephone varchar (10) not null unique,
    adresse varchar (50) not null,
    mdp varchar (25) not null,
    constraint pk_Professeur primary key (IdPf)
);

create table Administrateur (
    IdAd int (6) not null auto_increment,
    nom varchar (25) not null,
    prenom varchar (25) not null,
    role char (15) default 'Administrateur',
    email varchar (25) not null unique,
    telephone varchar (10) not null unique,
    adresse varchar (50) not null,
    mdp varchar (25) not null,
    constraint pk_Administrateur primary key (IdAd)
);

create table Transport (
    IdTp varchar (6) not null,
    nom varchar (25) not null,
    type varchar (15) not null,
    transporteur varchar (25) not null,
    pictogramme varchar (50),
    constraint pk_Transport primary key (IdTp)
);

create table Classe (
    IdCl int (6) not null,
    nom varchar (25) not null,
    nbEtudiants int (2) not null,
    email varchar (25) not null,
    constraint pk_Classe primary key (IdCl)
);

create table Matiere(
    IdM int (6) not null,
    intitule varchar (25) not null,
    constraint pk_Matiere primary key (IdM)
);

create table Station(
    IdSt int (6) not null,
    nom varchar (25) not null,
    IdTp varchar (6) not null,
    constraint pk_Station primary key (IdSt),
    constraint fk_Transport foreign key (IdTp) references Transport(IdTp)
);

create table Etudiant (
    IdE int (6) not null auto_increment,
    nom varchar (25) not null,
    prenom varchar (25) not null,
    role char (15) default 'Etudiant',
    email varchar (25) not null unique,
    telephone varchar (10) not null unique,
    adresse varchar (50) not null,
    mdp varchar (25) not null,
    IdCl int (6) not null,
    constraint pk_Etudiant primary key (IdE),
    constraint fk_Classe foreign key (IdCl) references Classe(IdCl)
);

create table HistoEtudiant(
    IdHE int (6) not null,
    IdE int (6) not null,
    mdp varchar(50),
    constraint pk_histoetudiant primary key(IdHE),
    constraint fk_Etudiant foreign key(IdE) references Etudiant(IdE)
);

create table HistoProf(
    IdHPf int (6) not null,
    IdPf int (6) not null,
    mdp varchar(50),
    constraint pk_histoprof primary key(IdHPf),
    constraint fk_Professeur foreign key(IdPf) references Professeur(IdPf)
);

create table HistoAdmin(
    IdHAd int (6) not null,
    IdAd int (6) not null,
    mdp varchar(50),
    constraint pk_histoadmin primary key(IdHAd),
    constraint fk_Administrateur foreign key(IdAd) references Administrateur(IdAd)
);

create table Perturbation(
    IdPt varchar (6) not null,
    raison varchar (50),
    dateDeb date,
    dateFin date,
    jourDeb enum('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'),
    jourFin enum('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'),
    heureDeb time,
    IdTp varchar (6) not null,
    constraint pk_Perturbation primary key (IdPt),
    constraint fk_Transport2 foreign key (IdTp) references Transport(IdTp)
);

create table Trajet(
    IdTj varchar (6) not null,
    IdE int (2) not null,
    dureeTotale time,
    constraint pk_Trajet primary key (IdTj),
    constraint fk_Etudiant2 foreign key (IdE) references Etudiant(IdE)
);

create table Cours(
    IdCl int (6) not null,
    IdPf int (6) not null,
    matiere int (25) not null,
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
    IdTp varchar (6) not null,
    IdTj varchar (6) not null,
    constraint pk_Avoir primary key(IdTp,IdTj),
    constraint fk_Transport3 foreign key (IdTp) references Transport(IdTp),
    constraint fk_Trajet foreign key (IdTj) references Trajet(IdTj)
);

create table Enseigner(
    IdM int (6) not null,
    IdPf int (6) not null,
    constraint pk_Enseigner primary key (IdM,IdPf),
    constraint fk_Professeur3 foreign key (IdPf) references Professeur(IdPf),
    constraint fk_Matiere foreign key (IdM) references Matiere(IdM)
);

create table Billet(
    dateB datetime not null,
    dureeRetard time not null,
    URLSignature varchar (50) not null,
    IdAd int (6) not null,
    IdE int (6) not null,
    constraint pk_Billet primary key (IdE, IdAd),
    constraint fk_Etudiant3 foreign key (IdE) references Etudiant(IdE),
    constraint fk_Administrateur2 foreign key (IdAd) references Administrateur(IdAd) 
);

LOAD DATA LOCAL INFILE 
 "C:\\wamp64\\www\\Retards-ecole\\oyd\\BDD\\Sources\\Transports.txt" into table Transport (IdTp,nom,type,transporteur,pictogramme);


 -- changer chemin sur windows --