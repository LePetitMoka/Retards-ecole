-- Jointure Arret/Transport (Quel arret appartient à quelle ligne ?)

create or replace view Vue_Arret_Transport(IdSt, IdTp, NomArret, NomTransport, type, transporteur)
as select s.IdSt, t.IdTp, s.nom, t.nom, t.type, t.transporteur 
from Station s, Transport t, Appartenir a
where a.IdSt = s.IdSt
and a.IdTp = t.IdTp;

-- Jointure Matiere/Professeur (Qui enseigne quoi ?)

create or replace view Vue_Prof_Matiere (IdPf,nom,prenom,IdM,intitule)
as select p.IdPf, p.nom, p.prenom, m.Idm, m.intitule
from Professeur p, Matiere m, Enseigner e
where e.IdPf = p.IdPf 
and e.IdM = m.IdM;

-- Qui est en retard actuellement ? (attention: la duree du retard concerne le cours actuel !)

create or replace view Vue_RetardQuiDuree (IdE, IdCl, nomEleve, prenomEleve, nomClasse, heureDebutCours, dureeRetard)
as select distinct e.IdE, cl.IdCl, e.nom, e.prenom, .cl.nom, c.heureDeb, time(curtime()-c.heureDeb)
from Classe cl, Cours c, Etudiant e
where c.Idcl = cl.IdCl
and cl.IdCl = e.IdCl
and c.dateC = curdate()
and curtime() between heureDeb and heureFin;

-- Jointure Quelles lignes sont perturbées ?

create or replace view Vue_Perturbation_Ligne (IdTp,nom,type,transporteur, pictogramme, etat, raison)
as select distinct t.IdTp, t.nom, t.type, t.transporteur, t.pictogramme, t.etat, p.raisonLongue 
from Transport t, Station s, Concerner c, Appartenir a, Perturbation p 
where c.IdSt = s.IdSt 
and a.IdSt = s.IdSt 
and a.IdTp = t.IdTp 
and c.IdPt = p.IdPt 
order by IdTp;

-- Billet par eleve et total des retards

create or replace view Vue_TotalBilletEleve (IdE, nom_prenom, nbBillets, dureeCumulee)
as select e.IdE, group_concat(e.nom," ",e.prenom), count(b.dateB), time(sum(b.dureeRetard))
from Etudiant e, Billet b
where b.IdE = e.IdE
group by e.IdE;

-- Vue Billet/Eleve

create or replace view Vue_BilletEleve (IdE, nom, prenom, classe, date, heure, dureeRetard)
as select e.IdE, e.nom, e.prenom, c.nom, b.dateB, b.heureB , b.dureeRetard
from Etudiant e, Classe c, Billet b
where c.IdCl =  e.IdCl
and b.IdE = e.IdE;

-- Vue Etudiant/Perturbation

create or replace view Vue_EtudiantPerturbation (IdE, nom, prenom, date)
as select distinct e.IdE, e.nom, e.prenom, curdate()
from Etudiant e, Trajet tj, Station s, Concerner c, Perturbation p
where tj.IdE = e.IdE
and tj.IdSt = s.IdSt
and c.IdSt = s.IdSt
and c.IdPt = p.IdPt;

-- Vue Etudiant en retard actuellement mais qui est justifié par une perturbation

create or replace view Vue_EtudiantRetardJustifie (IdE, IdCl, nomEleve, nomClasse, heureDebutCours, dureeRetard)
as select distinct vrqd.IdE , vrqd.IdCl, vrqd.nomEleve, vrqd.nomClasse, vrqd.heureDebutCours, vrqd.dureeRetard
from Vue_RetardQuiDuree vrqd, Perturbation p, Concerner c, Trajet tj, Station s
where vrqd.IdE = tj.IdE
and s.IdSt = tj.IdSt
and c.IdSt = s.IdSt;

-- Vue Etudiants perturbés ET en retard (censés etre en cours actuellement) ET sans billet de la journée

create or replace view Vue_Etudiant_Retard_Perturbation_SansBillet (IdE,date)
as select vep.IdE, vep.date
from Vue_EtudiantPerturbation vep, Vue_RetardQuiDuree vrqd
where vrqd.IdE = vep.IdE
and vrqd.IdE not in (select IdE from billet where dateB = curdate());

