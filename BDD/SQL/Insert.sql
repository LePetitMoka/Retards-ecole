update Classe set promotion = "2022/2023";

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
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Cours.txt' into table Cours (IdCl,IdPf,matiere,dateC,heureDeb,heureFin,duree,salle);

LOAD DATA LOCAL INFILE 
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Trajet.txt' into table Trajet (IdSt,IdE);

insert into Administrateur values
(null, 'Admin', 'Admin', 'abc@gmail.com', '0612345678', '11 Rue de la Paix', 'test');

update Transport set pictogramme = ".\img\icons_colorees\bus.png" where type like 'bus';

update Transport set pictogramme = ".\img\icons_colorees\rer.png" where type like 'rail';

update Transport set pictogramme = ".\img\icons_colorees\metro.png" where type in ('metro', 'tram', 'funicular');


LOAD DATA LOCAL INFILE
 '/Applications/MAMP/htdocs/Retards-ecole/BDD/Sources/Billet.txt' into table Billet (dateB, heureB, dureeRetard, URLSignature, dateheure, IdAd, IdE);

-- IMPORTANT : changer chemin sur windows et mettre des doubles slash

-- executer traitement.php pour actualiser la liste des perturbations