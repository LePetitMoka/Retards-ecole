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
    mdp varchar (25) not null,
    constraint pk_Professeur primary key (IdPf)
);

create table Administrateur (
    IdAd int (6) not null auto_increment,
    nom varchar (25) not null,
    prenom varchar (25) not null,
    email varchar (25) not null unique,
    telephone varchar (10) not null unique,
    adresse varchar (50) not null,
    mdp varchar (25) not null,
    constraint pk_Administrateur primary key (IdAd)
);

create table Transport (
    IdTp varchar (30) not null,
    nom varchar (30) not null,
    type varchar (15) not null,
    transporteur varchar (25) not null,
    pictogramme varchar (50),
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
    mdp varchar (25) not null,
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
    IdPt varchar (90) not null,
    raisonCourte varchar (250),
    raisonLongue varchar (250),
    dateDebMessage datetime,
    dateFinMessage datetime,
    constraint pk_Perturbation primary key (IdPt)
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
    IdSt varchar (30) not null,
    IdTj varchar (30) not null,
    constraint pk_Avoir primary key(IdSt,IdTj),
    constraint fk_Troncon foreign key (IdTc) references Troncon(IdTc),
    constraint fk_Trajet foreign key (IdTj) references Trajet(IdTj)
);

create table Enseigner(
    IdM int (6) not null,
    IdPf int (6) not null,
    constraint pk_Enseigner primary key (IdM,IdPf),
    constraint fk_Professeur3 foreign key (IdPf) references Professeur(IdPf),
    constraint fk_Matiere foreign key (IdM) references Matiere(IdM)
);

create table Appartenir(
    IdSt varchar(30) not null,
    IdTp varchar (30) not null,
    constraint pk_Appartenir primary key (IdSt,IdTp),
    constraint fk_ZoneStation foreign key (IdSt) references Station(IdSt),
    constraint fk_Station foreign key (IdTp) references Transport(IdTp)
);

create table Billet(
    IdB int (9) not null auto_increment,
    dateB date not null,
    heureB time not null,
    dureeRetard time not null,
    URLSignature varchar (50) not null,
    IdAd int (6) not null,
    IdE int (6) not null,
    constraint pk_Billet primary key (IdB),
    constraint fk_Etudiant3 foreign key (IdE) references Etudiant(IdE),
    constraint fk_Administrateur2 foreign key (IdAd) references Administrateur(IdAd) 
);

create table Concerner(
    IdSt varchar (30) not null,
    IdPt varchar (90) not null,
    constraint pk_Concerner primary key (IdSt,IdPt),
    constraint fk_Perturbation foreign key (IdPt) references Perturbation(IdPt),
    constraint fk_Station2 foreign key (IdSt) references Station(IdSt)
);

 -- DONNEES TEST

update Classe set promotion = "2022/2023";

update Classe set nbEtudiants = 30;

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Matiere.txt' into table Matiere (IdM,intitule);

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Professeurs.txt' into table Professeur (IdPf,nom,prenom,diplome,email,telephone,mdp,adresse);

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Classes.txt' into table Classe (IdCl,nom,email,diplomePrepare);

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Transports.txt' into table Transport (IdTp,nom,type,transporteur,pictogramme);

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Stations.txt' into table Station (IdSt,nom,ville);

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Etudiants.txt' into table Etudiant (IdE,nom,prenom,email,telephone,mdp,adresse,IdCl);

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Appartenir.txt' into table Appartenir (IdSt,IdTp);

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Enseigner.txt' into table Enseigner (IdM,IdPf);

LOAD DATA LOCAL INFILE
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Billet.txt' into table Billet (dateB, heureB, dureeRetard, URLSignature, IdAd, IdE);

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Cours.txt' into table Cours (IdCl,IdPf,matiere,dateC,heureDeb,heureFin,duree,salle);


 -- changer chemin sur windows et mettre des double slash --

insert into Administrateur values
(null, 'Admin', 'Admin', 'abc@gmail.com', '0612345678', '11 Rue de la Paix', 'test');

update transport set pictogramme = ".\img\icons_colorees\bus.png" where type like 'bus';

update transport set pictogramme = ".\img\icons_colorees\rer.png" where type like 'rail';

update transport set pictogramme = ".\img\icons_colorees\metro.png" where type in ('metro', 'tram', 'funicular');

-- executer le fichier updateRelStation.php --

-- sourcer le fichier InsertDesservir.sql --