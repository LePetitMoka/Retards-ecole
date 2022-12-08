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
end if;
end //
delimiter ;

--placer apres l'insert : update Administrateur set new.mdp = sha1(new.mdp);--

drop trigger if exists HistoEtudiant_MDP;
delimiter //
create trigger HistoEtudiant_MDP
after update on Etudiant
for each row
begin
if new.mdp != old.mdp
    then
    insert into HistoEtudiant values (null, old.IdE, old.mdp); 
    
end if;
end //
delimiter ;

--placer apres l'insert : update Etudiant set new.mdp = sha1(new.mdp);--

drop trigger if exists HistoProfesseur_MDP;
delimiter //
create trigger HistoProfesseur_MDP
after update on Professeur
for each row
begin
if new.mdp != old.mdp
    then
    insert into HistoProf values (null, old.IdPf, old.mdp); 
end if;
end //
delimiter ;

--placer apres l'insert : update Professeur set new.mdp = sha1(new.mdp);--

-- INS MDPSHA1 --

--drop trigger if exists insert_MDPSHA1;
--delimiter $
--create trigger insert_MDPSHA1
--after insert on User
--for each row
--begin
--    update user set mdp = sha1(mdp);
--end $
--delimiter ;
-- UPDT/INS ETUDIANT --

-- CLASSE --

drop trigger if exists insMAJnbEtudiants;
delimiter //
create trigger insMAJnbEtudiants
after insert on Etudiant
for each row
begin
update Classe
    set nbEtudiant = (select count(IdE) from Etudiant e, Classe c where IdCl.c = IdCl.e and IdCl.c = IdCl)
    where IdCl = new.IdCl;
end //
delimiter ;


drop trigger if exists updMAJnbEtudiants;
delimiter //
create trigger udpMAJnbEtudiants
after update on Etudiant
for each row
begin
if new.IdCl != old.IdCl
    then
        update Classe set nbEtudiants = nbEtudiant + 1 where IdCl = new.IdCl;
        update Classe set nbEtudiants = nbEtudiant - 1 where IdCl = old.IdCl;
end if;
end //
delimiter ; -- COPIE

drop trigger if exists updMAJnbEtudiants;
delimiter //
create trigger udpMAJnbEtudiants
after update on Etudiant
for each row
begin
if new.IdCl != old.IdCl
    then
        update Classe set nbEtudiant = (select count(IdE) from Etudiant e, Classe c where IdCl.c = IdCl.e and IdCl.c = IdCl)
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
    update Classe set nbEtudiant = (select count(IdE) from Etudiant e, Classe c where IdCl.c = IdCl.e and IdCl.c = IdCl)
    where IdCl = old.IdCl;
end //
delimiter ;