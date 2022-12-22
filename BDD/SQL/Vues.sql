-- Jointure Arret/Transport (Quel arret appartient à quelle ligne ?)

create or replace view Arret_Transport(NomArret, NomTransport, type, transporteur)
as select s.nom, t.nom, t.type, t.transporteur 
from Station s, Transport t, Appartenir a
where a.IdSt = s.IdSt
and a.IdTp = t.IdTp;

-- Jointure Matiere/Professeur (Qui enseigne quoi ?)

create or replace view Prof_Matiere (IdPf,nom,prenom,IdM,intitule)
as select p.IdPf, p.nom, p.prenom, m.Idm, m.intitule
from Professeur p, Matiere m, Enseigner e
where e.IdPf = p.IdPf 
and e.IdM = m.IdM;

-- Qui est en retard actuellement ? (attention: la duree du retard concerne le cours actuel !)

create or replace view RetardQuiDuree (IdE, IdCl, nomEleve, nomClasse, heureDebutCours, dureeRetard)
as select e.IdE, cl.IdCl, e.nom, cl.nom, c.heureDeb, time(curtime()-c.heureDeb)
from Classe cl, Cours c, Etudiant e
where c.Idcl = cl.IdCl
and cl.IdCl = e.IdCl
and c.dateC = curdate()
and curtime() between heureDeb and heureFin;

-- Jointure Quelles lignes sont perturbées ?

create or replace view Perturbation_Ligne (IdTp,nom)
as select distinct t.IdTp, t.nom
from Transport t, Station s, Concerner c, Appartenir a
where c.IdSt = s.IdSt
and a.IdSt = s.IdSt
and a.IdTp = t.IdTp;

-- Billet par eleve et total des retards

create or replace view TotalBilletEleve (IdE, nom_prenom, nbBillets, dureeCumulee)
as select e.IdE, group_concat(e.nom," ",e.prenom), count(b.IdB), time(sum(b.dureeRetard))
from Etudiant e, Billet b
where b.IdE = e.IdE
group by e.IdE;

-- Vue Billet/Eleve

create or replace view VueBillet (IdE, nom, prenom, classe)
as select e.IdE, e.nom, e.prenom, c.nom, b.dateB, b.heureB , b.dureeRetard,