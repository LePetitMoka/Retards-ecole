-- Jointure Arret/Transport (Quel arret appartient à quelle ligne ?)

create or replace view Vue_Arret_Transport(IdSt, IdTp, NomArret, NomTransport, type, transporteur)
as select s.IdSt, t.IdTp, s.nom, t.nom, t.type, t.transporteur 
from Station s, Transport t, Appartenir a
where a.IdSt = s.IdSt
and a.IdTp = t.IdTp;

-- Jointure Matiere/Professeur (Qui enseigne quoi ?)

create or replace view Vue_Prof_Matiere (IdPf,nom,prenom,IdM,intitule)
as select distinct pf.IdPf, pf.nom, pf.prenom, m.IdM, m.intitule
from Professeur pf, Matiere m, Cours c
where pf.IdPf = c.IdPf 
and c.IdM = m.IdM
order by pf.IdPf;

-- Qui est en retard actuellement ? (attention: la duree du retard concerne le Cours actuel !)

create or replace view Vue_RetardQuiDuree (IdE, IdCl, nomEleve, prenomEleve, nomClasse, heureDebutCours, heureFinCours, dureeRetard)
as select distinct e.IdE, cl.IdCl, e.nom, e.prenom, .cl.nom, c.heureDeb, c.heureFin, timediff(curtime(),c.heureDeb)
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
group by e.IdE
order by IdE;

-- Vue Billet/Eleve

create or replace view Vue_BilletEleve (IdE, nom, prenom, Classe, date, heure, dureeRetard)
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

-- Vue Etudiants perturbés ET en retard (censés etre en Cours actuellement) ET sans Billet pour le Cours actuel

create or replace view Vue_Etudiant_Retard_Perturbation_SansBillet (IdE, nom, prenom, date)
as select vep.IdE, vep.nom, vep.prenom, vep.date
from Vue_EtudiantPerturbation vep, Vue_RetardQuiDuree vrqd
where vrqd.IdE = vep.IdE
and vrqd.IdE not in (select IdE from Billet where dateB = curdate() and (heureB between vrqd.heureDebutCours and vrqd.heureFinCours));

-- Vue Etudiant en retard (censé etre en Cours actuellement) ET sans Billet

create or replace view Vue_Etudiant_Retard__SansBillet (IdE)
as select vrqd.IdE
from Vue_RetardQuiDuree vrqd
where vrqd.IdE not in (select IdE from Billet where dateB = curdate() and (heureB between vrqd.heureDebutCours and vrqd.heureFinCours));

-- Vue Cours detaillés

create or replace view Vue_Cours_Details(Matiere,nomCl,nomPf,dateTS,dateC,heureDeb,heureFin,duree,salle,IdCl,IdPf,IdM)
as select m.intitule, cl.nom, pf.nom , c.dateTS, c.dateC ,c.heureDeb, c.heurefin, c.duree, c.salle, cl.idcl, pf.idpf, c.idm
from Cours c, Classe cl, Professeur pf, Matiere m
where cl.idcl = c.idcl
and pf.idpf = c.idpf
and m.idm = c.idm
order by IdCl;

-- Vue Arret / Transport simplifiée

create or replace view Vue_Arret_Transport_Concat(IdSt, NomArret, transports)
as select IdSt, NomArret, group_concat(NomTransport) transports
from Vue_Arret_Transport
group by idst;

-- Composition des Trajets des etudiants details

create or replace view Vue_Trajet_Details(nom,prenom,arret, transports, ide,idst)
as select e.nom, e.prenom, vatc.NomArret, vatc.transports, e.Ide, st.IdSt
from Trajet t, Etudiant e, Station st, Vue_Arret_Transport_Concat vatc
where t.Ide = e.Ide
and t.IdSt = vatc.idst
and st.Idst = t.idst
order by ide;