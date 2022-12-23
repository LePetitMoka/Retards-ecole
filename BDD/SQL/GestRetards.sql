drop database if exists GestRetards;
create database GestRetards;
use GestRetards;

create table Professeur (
    IdPf int (6) not null auto_increment,
    nom varchar (25) not null,
    prenom varchar (25) not null,
    diplome varchar (50) not null,
    email varchar (25) not null unique,
    telephone varchar (10) not null unique,
    adresse varchar (50) not null,
    mdp varchar (100) not null,
    constraint pk_Professeur primary key (IdPf)
);

create table Administrateur (
    IdAd int (6) not null auto_increment,
    nom varchar (25) not null,
    prenom varchar (25) not null,
    email varchar (25) not null unique,
    telephone varchar (10) not null unique,
    adresse varchar (50) not null,
    mdp varchar (100) not null,
    constraint pk_Administrateur primary key (IdAd)
);

create table Transport (
    IdTp varchar (30) not null,
    nom varchar (30) not null,
    type varchar (15) not null,
    transporteur varchar (25) not null,
    pictogramme varchar (50),
    etat set ("Fluide","Perturbée") default "Fluide",
    constraint pk_Transport primary key (IdTp)
);

create table Classe (
    IdCl int(6) not null auto_increment,
    nom varchar (25) not null,
    nbEtudiants int (2) default 0,
    email varchar (25) not null,
    diplomePrepare varchar (30) not null,
    promotion varchar (9),
    constraint pk_Classe primary key (IdCl)
);

create table Matiere(
    IdM int (6) not null,
    intitule varchar (25) not null,
    constraint pk_Matiere primary key (IdM)
);

create table Station(
    IdSt varchar (30) not null,
    nom varchar (30) not null,
    ville varchar (30) not null,
    constraint pk_Station primary key (IdSt)
);

create table Etudiant (
    IdE int (6) not null auto_increment,
    nom varchar (25) not null,
    prenom varchar (25) not null,
    email varchar (25) not null unique,
    telephone varchar (10) not null unique,
    mdp varchar (100) not null,
    adresse varchar (50) not null,
    IdCl int (6) not null,
    constraint pk_Etudiant primary key (IdE,IdCl),
    constraint fk_Classe foreign key (IdCl) references Classe(IdCl)
);

create table HistoEtudiant(
    IdHE int (6) not null,
    IdE int (6) not null,
    mdp varchar(50),
    constraint pk_histoetudiant primary key(IdHE),
    constraint fk_Etudiant foreign key(IdE) references Etudiant(IdE) on delete cascade
);

create table HistoProf(
    IdHPf int (6) not null,
    IdPf int (6) not null,
    mdp varchar(50),
    constraint pk_histoprof primary key(IdHPf),
    constraint fk_Professeur foreign key(IdPf) references Professeur(IdPf) on delete cascade
);

create table HistoAdmin(
    IdHAd int (6) not null,
    IdAd int (6) not null,
    mdp varchar(50),
    constraint pk_histoadmin primary key(IdHAd),
    constraint fk_Administrateur foreign key(IdAd) references Administrateur(IdAd) on delete cascade
);

create table Perturbation(
    IdPt varchar (90) not null,
    raisonCourte varchar (250),
    raisonLongue varchar (250),
    dateDebMessage datetime,
    dateFinMessage datetime,
    constraint pk_Perturbation primary key (IdPt)
);

create table Cours(
    IdCl int (6) not null,
    IdPf int (6) not null,
    matiere varchar (25) not null,
    dateC date not null,
    heureDeb time not null,
    heureFin time not null,
    duree time,
    salle varchar (20),
    constraint pk_Cours primary key (IdCl, IdPf),
    constraint fk_Classe2 foreign key (IdCl) references Classe(IdCl) on delete cascade on update cascade,
    constraint fk_Professeur2 foreign key (IdPf) references Professeur(IdPf) on delete cascade on update cascade
);

create table Trajet(
    IdSt varchar (30) not null,
    IdE int (6) not null,
    constraint pk_Trajet primary key(IdSt,IdE),
    constraint fk_Station foreign key (IdSt) references Station(IdSt) on delete cascade on update cascade,
    constraint fk_Etudiant4 foreign key (IdE) references Etudiant(IdE) on delete cascade on update cascade
);

create table Enseigner(
    IdM int (6) not null,
    IdPf int (6) not null,
    constraint pk_Enseigner primary key (IdM,IdPf),
    constraint fk_Professeur3 foreign key (IdPf) references Professeur(IdPf) on delete cascade on update cascade,
    constraint fk_Matiere foreign key (IdM) references Matiere(IdM) on delete cascade on update cascade
);

create table Appartenir(
    IdSt varchar(30) not null,
    IdTp varchar (30) not null,
    constraint pk_Appartenir primary key (IdSt,IdTp),
    constraint fk_Station2 foreign key (IdSt) references Station(IdSt) on delete cascade on update cascade,
    constraint fk_Transport foreign key (IdTp) references Transport(IdTp) on delete cascade on update cascade
);

create table Billet(
    dateB date not null,
    heureB time not null,
    dureeRetard time not null,
    URLSignature varchar (50) not null,
    dateheure datetime not null,
    IdAd int (6) not null,
    IdE int (6) not null,
    constraint pk_Billet primary key (IdE,IdAd,dateheure),
    constraint fk_Etudiant3 foreign key (IdE) references Etudiant(IdE) on delete cascade on update cascade,
    constraint fk_Administrateur2 foreign key (IdAd) references Administrateur(IdAd) on delete cascade on update cascade
);

create table Concerner(
    IdSt varchar (30) not null,
    IdPt varchar (90) not null,
    constraint pk_Concerner primary key (IdSt,IdPt),
    constraint fk_Perturbation foreign key (IdPt) references Perturbation(IdPt) on delete cascade on update cascade,
    constraint fk_Station3 foreign key (IdSt) references Station(IdSt) on delete cascade on update cascade
);
