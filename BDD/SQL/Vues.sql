-- Jointure Arret/Transport

create or replace view Arret_Transport(NomArret, NomTransport, type, transporteur)
as select s.nom, t.nom, t.type, t.transporteur 
from Station s, Transport t, Appartenir a
where a.IdSt = s.IdSt
and a.IdTp = t.IdTp;

-- Jointure Etudiant/Classe/Cours/Professeur

create or replace view Prof_Matiere (IdPf,nom,prenom,IdM,intitule)
as select p.IdPf, p.nom, p.prenom, m.Idm, m.intitule
from Professeur p, Matiere m, Enseigner e
where e.IdPf = p.IdPf 
and e.IdM = m.IdM;

-- Jointure 

