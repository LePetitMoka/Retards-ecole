
LOAD DATA LOCAL INFILE 
 '/var/www/GREI/BDD/Sources/Matiere.txt' into table Matiere (IdM,intitule);

LOAD DATA LOCAL INFILE 
 '/var/www/GREI/BDD/Sources/Professeurs.txt' into table Professeur (IdPf,nom,prenom,diplome,email,telephone,mdp,adresse);

LOAD DATA LOCAL INFILE 
 '/var/www/GREI/BDD/Sources/Classes.txt' into table Classe (IdCl,nom,email,diplomePrepare);

LOAD DATA LOCAL INFILE 
 '/var/www/GREI/BDD/Sources/Transports.txt' into table Transport (IdTp,nom,type,transporteur,pictogramme);

LOAD DATA LOCAL INFILE 
 '/var/www/GREI/BDD/Sources/Stations.txt' into table Station (IdSt,nom,ville);

LOAD DATA LOCAL INFILE 
 '/var/www/GREI/BDD/Sources/Etudiants.txt' into table Etudiant (IdE,nom,prenom,email,telephone,mdp,adresse,IdCl);

LOAD DATA LOCAL INFILE 
 '/var/www/GREI/BDD/Sources/Appartenir.txt' into table Appartenir (IdSt,IdTp);

LOAD DATA LOCAL INFILE 
 '/var/www/GREI/BDD/Sources/Cours.txt' into table Cours (IdCl,IdPf,IdM,dateC,heureDeb,heureFin,duree,salle);

LOAD DATA LOCAL INFILE 
 '/var/www/GREI/BDD/Sources/Trajet.txt' into table Trajet (IdSt,IdE);


insert into Administrateur values
(null, 'Admin', '1', 'abc@gmail.com', '0612345678', '11 Rue de la Paix', 'test', 'signatures/Admin1sign.png');

update Classe set promotion = "2022/2023";

update Transport set pictogramme = "../img/icons_colorees/bus.png" where type like 'bus';

update Transport set pictogramme = "../img/icons_colorees/rer.png" where type like 'rail';

update Transport set pictogramme = "../img/icons_colorees/metro.png" where type in ('metro', 'tram', 'funicular');


LOAD DATA LOCAL INFILE
 '/var/www/GREI/BDD/Sources/Billet.txt' into table Billet (dateB, heureB, dureeRetard, URLSignature, dateheure, IdAd, IdE);

-- IMPORTANT : changer chemin sur windows et mettre des doubles slash

-- executer traitement.php pour actualiser la liste des perturbations