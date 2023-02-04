--  /ADMIN
--      /INSERT

drop trigger if exists insert_admin;
delimiter //
create trigger insert_admin
before insert on Administrateur
for each row
begin
declare e int;
declare p int;
declare u int;

set new.IdAd = (select count(*) from User) + 1;

-- heritage
select count(*) into u
from user
where IdU=new.IdAd;
if u=0
    then    
        select count(*) into p
        from Professeur
        where IdPf = new.IdAd;
        if p > 0
            then
                signal sqlstate '45000'
                set message_text = 'il est deja professeur';
        end if;

        select count(*) into e
        from Etudiant
        where IdE = new.IdAd;
        if e > 0
            then
                    signal sqlstate '45000'
                    set message_text = 'il est deja etudiant';
        end if;
        set new.mdp = sha1(new.mdp);
        insert into User values (new.IdAd,new.nom,new.prenom,new.email,new.telephone,new.adresse,new.mdp);
else
    signal sqlstate '45000'
                set message_text = "l'utilisateur existe deja";
end if;
end //
delimiter ;

--      /UPDATE

drop trigger if exists upd_admin;
delimiter //
create trigger upd_admin
before update on Administrateur
for each row
begin

-- chiffrage mdp
if sha1(new.mdp) != old.mdp && sha1(new.mdp) != sha1(old.mdp)
    then
        set new.mdp = sha1(new.mdp);
end if;

-- heritage
update User
    set nom = new.nom,
        prenom = new.prenom,
        email = new.email,
        telephone = new.telephone,
        adresse = new.adresse,
        mdp = new.mdp
        where IdU = new.IdAd;
end //
delimiter ;

--      /DELETE

drop trigger if exists del_admin;
delimiter //
create trigger delete_administrateur
after delete on Administrateur
for each row
begin
delete from User
where IdU = old.IdAd;
end //
delimiter ;

--  /ETUDIANT
--      /INSERT

drop trigger if exists ins_etudiant;
delimiter //
create trigger insert_etudiant
before insert on Etudiant
for each row
begin
declare a int;
declare p int;
declare u int;
declare somme int;

set new.IdE = (select count(*) from User) + 1;

-- heritage
select count(*) into u
from user
where IdU=new.IdE;
if u=0
    then    
        select count(*) into p
        from Professeur
        where IdPf = new.IdE;
        if p > 0
            then
                signal sqlstate '45000'
                set message_text = 'il est deja professeur';
        end if;

        select count(*) into a
        from Administrateur
        where IdAd = new.IdE;
        if a > 0
            then
                    signal sqlstate '45000'
                    set message_text = 'il est deja administrateur';
        end if;
    set new.mdp = sha1(new.mdp);
    insert into user values (new.IdE,new.nom,new.prenom,new.email,new.telephone,new.adresse,new.mdp);
else
    signal sqlstate '45000'
                set message_text = "l'utilisateur existe deja";
end if;

-- maj nbEtudiant dans classe
select count(*) into somme from Etudiant where IdCl = new.IdCl;
update Classe
    set nbEtudiants = somme
    where IdCl = new.IdCl;
end //
delimiter ;

--    /UPDATE

drop trigger if exists upd_etudiant;
delimiter //
create trigger upd_etudiant
before update on Etudiant
for each row
begin
declare somme int;

-- maj nbEtudiant dans classe
if old.IdCl != new.IdCl
    then
        select count(*) into somme from Etudiant where IdCl = new.IdCl;
        update Classe
            set nbEtudiants = somme
            where IdCl = new.IdCl;
end if;

-- chiffrage mdp
if sha1(new.mdp) != old.mdp && sha1(new.mdp) != sha1(old.mdp)
    then
        update Etudiant set new.mdp = sha1(new.mdp);
end if;

-- heritage
update User
    set nom = new.nom,
        prenom = new.prenom,
        email = new.email,
        telephone = new.telephone,
        adresse = new.adresse,
        mdp = new.mdp
        where IdU = new.IdE;
end //
delimiter ;

--    /DELETE

drop trigger if exists del_etudiant;
delimiter //
create trigger delete_etudiant
after delete on Etudiant
for each row
begin
declare somme int;

-- heritage
delete from User
where IdU = old.IdE;

-- maj nbEtudiant dans classe
select count(*) into somme from Etudiant where IdCl = old.IdCl;
update Classe
    set nbEtudiants = somme
    where IdCl = old.IdCl;
end //
delimiter ;

--  /PROFESSEUR
--      /INSERT

drop trigger if exists ins_prof;
delimiter //
create trigger insert_professeur
before insert on Professeur
for each row
begin
declare e int;
declare a int;
declare u int;
declare temp int(6);

set new.IdPf = (select count(*) from User) + 1;

-- heritage
select count(*) into u
from user
where IdU=new.IdPf;
if u=0
    then    
        select count(*) into a
        from Administrateur
        where IdAd = new.IdPf;
        if a > 0
            then
                signal sqlstate '45000'
                set message_text = 'il est deja administrateur';
        end if;

        select count(*) into e
        from Etudiant
        where IdE = new.IdPf;
        if e > 0
            then
                    signal sqlstate '45000'
                    set message_text = 'il est deja etudiant';
        end if;
    set new.mdp = sha1(new.mdp);
    insert into user values (new.IdPf,new.nom,new.prenom,new.email,new.telephone,new.adresse,new.mdp);
else
    signal sqlstate '45000'
                set message_text = "l'utilisateur existe deja";
end if;
end //
delimiter ;

--    /UPDATE

drop trigger if exists upd_prof;
delimiter //
create trigger upd_professeur
before update on Professeur
for each row
begin

-- chiffrage mdp
if sha1(new.mdp) != old.mdp && sha1(new.mdp) != sha1(old.mdp)
    then
    update Professeur set new.mdp = sha1(new.mdp);
end if;

-- heritage
update User
    set nom = new.nom,
        prenom = new.prenom,
        email = new.email,
        telephone = new.telephone,
        adresse = new.adresse,
        mdp = new.mdp
        where IdU = new.IdPf;
end //
delimiter ;

--    /DELETE

drop trigger if exists del_prof;
delimiter //
create trigger delete_professeur
after delete on Professeur
for each row
begin
delete from User
where IdU = old.IdPf;
end //
delimiter ;

--  /USER
--      /UPDATE

drop trigger if exists histomdp_user;
delimiter //
create trigger histomdp_user
before update on User
for each row
begin
if sha1(new.mdp) != old.mdp && sha1(new.mdp) != sha1(old.mdp)
    then
    insert into HistoUser values (null, old.IdU, old.mdp);
end if;
end //
delimiter ;


--  /CONCERNER
--      /INSERT

drop trigger if exists InsFluidite;
delimiter //
create trigger InsFluidite
after insert on Concerner
for each row
begin
-- Fluidite Transport (ATTENTION: CHARGER LA VUE Vue_Perturbation_Ligne pour que le trigger fonctionne) --
update Transport
    set etat = "Perturbée"
        where IdTp in (select IdTp from Vue_Perturbation_Ligne);
end //
delimiter ;

--      /DELETE

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

-- /BILLET
--      /INSERT

drop trigger if exists InsBilletTempsJustif;
delimiter //
create trigger InsBilletTempsJustif
    before insert on Billet
    for each row
begin
declare dureeR time;

-- Billet autotime --
select dureeRetard into dureeR from Vue_RetardQuiDuree where IdE = new.IdE;
if new.IdE in (select IdE from Vue_EtudiantRetardJustifie)
    then
        set new.raison = "Transports ";
        set new.dureeRetard = dureeR;
        set new.dateheure = now();
        set new.dateB = curdate();
        set new.heureB = curtime();
end if;
end //
delimiter ;

-- /COURS
--      /INSERT

drop trigger if exists InsCours;
delimiter //
create trigger InsCours
before insert on Cours
for each row
begin
-- Cours autotime 
set new.dateTS = now();
end //
delimiter ;

