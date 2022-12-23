-- UPDT HISTO & MDPSHA1 --

drop trigger if exists HistoAdmin_MDP;
delimiter //
create trigger HistoAdmin_MDP
after update on Administrateur
for each row
begin
if new.mdp != old.mdp
    then
    insert into HistoAdmin values (null, old.IdAd, old.mdp);
    update Administrateur set new.mdp = sha1(new.mdp);
end if;
end //
delimiter ;

drop trigger if exists HistoEtudiant_MDP;
delimiter //
create trigger HistoEtudiant_MDP
after update on Etudiant
for each row
begin
if new.mdp != old.mdp
    then
    insert into HistoEtudiant values (null, old.IdE, old.mdp); 
    update Etudiant set new.mdp = sha1(new.mdp);
end if;
end //
delimiter ;

drop trigger if exists HistoProfesseur_MDP;
delimiter //
create trigger HistoProfesseur_MDP
after update on Professeur
for each row
begin
if new.mdp != old.mdp
    then
    insert into HistoProf values (null, old.IdPf, old.mdp);
    update Professeur set new.mdp = sha1(new.mdp);
end if;
end //
delimiter ;


-- INS MDPSHA1 --

drop trigger if exists insert_MDPSHA1_admin;
delimiter $
create trigger insert_MDPSHA1_admin
after insert on Administrateur
for each row
begin
    update Administrateur set mdp = sha1(mdp);
end $
delimiter ;

drop trigger if exists insert_MDPSHA1_prof;
delimiter $
create trigger insert_MDPSHA1_prof
after insert on Professeur
for each row
begin
    update Professeur set mdp = sha1(mdp);
end $
delimiter ;

drop trigger if exists insert_MDPSHA1_etudiant;
delimiter $
create trigger insert_MDPSHA1_etudiant
after insert on Etudiant
for each row
begin
    update Etudiant set mdp = sha1(mdp);
end $
delimiter ;

-- UPDT/INS ETUDIANT (rien, deja fait dans les triggers histo)--

-- CLASSE --

drop trigger if exists insMAJnbEtudiants;
delimiter //
create trigger insMAJnbEtudiants
    after insert on Etudiant
    for each row
begin
declare somme int;
select count(*) into somme from Etudiant where IdCl = new.IdCl;
update Classe
    set nbEtudiants = somme
    where IdCl = new.IdCl;
end //
delimiter ;


drop trigger if exists updMAJnbEtudiants;
delimiter //
create trigger updMAJnbEtudiants
    after update on Etudiant
    for each row
begin
declare somme int;
if old.IdCl != new.IdCl
    then
        select count(*) into somme from Etudiant where IdCl = new.IdCl;
        update Classe
            set nbEtudiants = somme
            where IdCl = new.IdCl;
end if;
end //
delimiter ;

drop trigger if exists delMAJnbEtudiants;
delimiter //
create trigger delMAJnbEtudiants
    after delete on Etudiant
    for each row
begin
declare somme int;
select count(*) into somme from Etudiant where IdCl = old.IdCl;
update Classe
    set nbEtudiants = somme
    where IdCl = old.IdCl;
end //
delimiter ;

-- Fluidite Transport (ATTENTION: CHARGER LA VUE Vue_Perturbation_Ligne pour que le trigger fonctionne) --

drop trigger if exists InsFluidite;
delimiter //
create trigger InsFluidite
    after insert on Concerner
    for each row
begin
    update Transport
        set etat = "Perturbée"
            where IdTp in (select IdTp from Vue_Perturbation_Ligne);
end //
delimiter ;

drop trigger if exists DelFluidite;
delimiter //
create trigger DelFluidite
    after delete on Concerner
    for each row
begin
    update Transport
        set etat = "Fluide"
            where etat = "Perturbée";
end //
delimiter ;