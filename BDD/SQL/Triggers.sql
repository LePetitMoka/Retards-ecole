-- UPDT HISTO & MDPSHA1 --

drop trigger if exists HistoAdmin_MDP;
delimiter $
create trigger Histo_MDP_after_Update
after update on Administrateur
for each row
begin
if new.mdp != old.mdp
    then
    insert into HistoAdmin values (null, old.iduser, old.mdp); 
    update Administrateur set new.mdp = sha1(new.mdp);
end if
end $

drop trigger if exists HistoEtudiant_MDP;
delimiter $
create trigger Histo_MDP_after_Update
after update on Etudiant
for each row
begin
if new.mdp != old.mdp
    then
    insert into HistoEtudiant values (null, old.iduser, old.mdp); 
    update Etudiant set new.mdp = sha1(new.mdp);
end if
end $

drop trigger if exists Histo_MDP;
delimiter $
create trigger Histo_MDP_after_Update
after update on Professeur
for each row
begin
if new.mdp != old.mdp
    then
    insert into HistoProf values (null, old.iduser, old.mdp); 
    update Professeur set new.mdp = sha1(new.mdp);
end if
end $

-- INS MDPSHA1 --

drop trigger if exists insert_MDPSHA1;
delimiter $
create trigger insert_MDPSHA1
after insert on User
for each row
begin
    update user set mdp = sha1(mdp);
end $

-- UPDT/INS ETUDIANT --

