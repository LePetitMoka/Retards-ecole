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
--          /BEFORE
drop trigger if exists beforeupd_admin;
delimiter //
create trigger beforeupd_admin
before update on Administrateur
for each row
begin

-- chiffrage mdp + controle
if sha1(new.mdp) = old.mdp
    then
        signal sqlstate '45000'
        set message_text = 'Le mot de passe doit etre different';
    else if sha1(new.mdp) in (select mdp from HistoUser where IdU = new.IdAd) = 1
        && new.mdp != (select mdp from User where IdU = new.IdAd)
        then
            signal sqlstate '45000'
            set message_text = 'Le mot de passe a déjà été utilisé dans le passé';
        else if sha1(new.mdp) != sha1(old.mdp) 
                && new.mdp != (select mdp from User where IdU = new.IdAd)
                then
                    set new.mdp = sha1(new.mdp);
        end if;
    end if;
end if;
end //
delimiter ;

--          /AFTER

drop trigger if exists afterupd_admin;
delimiter //
create trigger afterupd_admin
after update on Administrateur
for each row
begin
declare mdpU varchar (100);
declare nomU varchar (25);
declare adresseU varchar(50);
declare emailU varchar (50);
declare telephoneU varchar (10);
declare prenomU varchar (25);

-- historisation

if  new.mdp in (select mdp from HistoUser where IdU = new.IdAd) = 0
    && new.mdp != (select mdp from User where IdU = new.IdAd)
    then
        insert into HistoUser values (null,new.IdAd,old.mdp);
end if;

-- heritage mdp
select mdp into mdpU from User where IdU = new.IdAd;
if mdpU != new.mdp
    then
        update User set mdp = new.mdp where IdU = new.IdAd;
end if;
-- heritage (hors-mdp)
select nom,prenom,adresse,telephone,email into nomU,prenomU,adresseU,telephoneU,emailU from User where IdU = new.IdAd;
        if new.nom != nomU OR new.prenom != prenomU OR new.email != emailU OR new.telephone != telephoneU OR new.adresse != adresseU
            then
                update User
                    set nom = new.nom,
                    prenom = new.prenom,
                    email = new.email,
                    telephone = new.telephone,
                    adresse = new.adresse
                    where IdU = new.IdAd;
end if;
end //
delimiter ;

--      /DELETE

drop trigger if exists del_admin;
delimiter //
create trigger del_admin
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
create trigger ins_etudiant
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

--      /UPDATE
--          /BEFORE
drop trigger if exists beforeupd_etudiant;
delimiter //
create trigger beforeupd_etudiant
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

-- chiffrage mdp + controle
if sha1(new.mdp) = old.mdp
    then
        signal sqlstate '45000'
        set message_text = 'Le mot de passe doit etre different';
    else if sha1(new.mdp) in (select mdp from HistoUser where IdU = new.IdE) = 1
        && new.mdp != (select mdp from User where IdU = new.IdE)
        then
            signal sqlstate '45000'
            set message_text = 'Le mot de passe a déjà été utilisé dans le passé';
        else if sha1(new.mdp) != sha1(old.mdp) 
                && new.mdp != (select mdp from User where IdU = new.IdE)
                then
                    set new.mdp = sha1(new.mdp);
        end if;
    end if;
end if;
end //
delimiter ;

--              /AFTER

drop trigger if exists afterupd_etudiant;
delimiter //
create trigger afterupd_etudiant
after update on Etudiant
for each row
begin
declare mdpU varchar (100);
declare nomU varchar (25);
declare adresseU varchar (50);
declare emailU varchar (50);
declare telephoneU varchar (10);
declare prenomU varchar (25);

-- historisation

if  new.mdp in (select mdp from HistoUser where IdU = new.IdE) = 0
    && new.mdp != (select mdp from User where IdU = new.IdE)
    then
        insert into HistoUser values (null,new.IdE,old.mdp);
end if;

-- heritage mdp
select mdp into mdpU from User where IdU = new.IdE;
if mdpU != new.mdp
    then
        update User set mdp = new.mdp where IdU = new.IdE;
end if;

-- heritage (hors-mdp)
select nom,prenom,adresse,telephone,email into nomU,prenomU,adresseU,telephoneU,emailU from User where IdU = new.IdE;
        if new.nom != nomU OR new.prenom != prenomU OR new.email != emailU OR new.telephone != telephoneU OR new.adresse != adresseU
            then
                update User
                    set nom = new.nom,
                    prenom = new.prenom,
                    email = new.email,
                    telephone = new.telephone,
                    adresse = new.adresse
                    where IdU = new.IdE;
end if;
end //
delimiter ;

--    /DELETE

drop trigger if exists del_etudiant;
delimiter //
create trigger del_etudiant
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
create trigger ins_prof
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

drop trigger if exists beforeupd_prof;
delimiter //
create trigger beforeupd_prof
before update on Professeur
for each row
begin

-- chiffrage mdp + controle
if sha1(new.mdp) = old.mdp
    then
        signal sqlstate '45000'
        set message_text = 'Le mot de passe doit etre different';
    else if sha1(new.mdp) in (select mdp from HistoUser where IdU = new.IdPf) = 1
        && new.mdp != (select mdp from User where IdU = new.IdPf)
        then
            signal sqlstate '45000'
            set message_text = 'Le mot de passe a déjà été utilisé dans le passé';
        else if sha1(new.mdp) != sha1(old.mdp) 
                && new.mdp != (select mdp from User where IdU = new.IdPf)
                then
                    set new.mdp = sha1(new.mdp);
        end if;
    end if;
end if;
end //
delimiter ;

--              /AFTER

drop trigger if exists afterupd_prof;
delimiter //
create trigger afterupd_prof
after update on Professeur
for each row
begin
declare mdpU varchar (100);
declare nomU varchar (25);
declare adresseU varchar (50);
declare emailU varchar (50);
declare telephoneU varchar (10);
declare prenomU varchar (25);

-- historisation

if  new.mdp in (select mdp from HistoUser where IdU = new.IdPf) = 0
    && new.mdp != (select mdp from User where IdU = new.IdPf)
    then
        insert into HistoUser values (null,new.IdPf,old.mdp);
end if;

-- heritage mdp
select mdp into mdpU from User where IdU = new.IdPf;
if mdpU != new.mdp
    then
        update User set mdp = new.mdp where IdU = new.IdPf;
end if;
-- heritage (hors-mdp)
select nom,prenom,adresse,telephone,email into nomU,prenomU,adresseU,telephoneU,emailU from User where IdU = new.IdPf;
        if new.nom != nomU OR new.prenom != prenomU OR new.email != emailU OR new.telephone != telephoneU OR new.adresse != adresseU
            then
                update User
                    set nom = new.nom,
                    prenom = new.prenom,
                    email = new.email,
                    telephone = new.telephone,
                    adresse = new.adresse
                    where IdU = new.IdPf;
end if;
end //
delimiter ;

--    /DELETE

drop trigger if exists del_prof;
delimiter //
create trigger del_prof
after delete on Professeur
for each row
begin
delete from User
where IdU = old.IdPf;
end //
delimiter ;

--  /USER
--      /UPDATE
--          /BEFORE

drop trigger if exists beforeupd_user;
delimiter //
create trigger beforeupd_user
before update on User
for each row
begin

-- chiffrage mdp + controle
if sha1(new.mdp) = old.mdp
    then
        signal sqlstate '45000'
        set message_text = 'Le mot de passe doit etre different';
    else if sha1(new.mdp) in (select mdp from HistoUser h where h.IdU = new.IdU) = 1
            && (new.mdp != (select mdp from Administrateur where IdAd = new.IdU)
                OR new.mdp != (select mdp from Professeur where IdPf = new.IdU)
                OR new.mdp != (select mdp from Etudiant where IdE = new.IdU))
        then
            signal sqlstate '45000'
            set message_text = 'Le mot de passe a déjà été utilisé dans le passé';
        else if sha1(new.mdp) != sha1(old.mdp)
                && (new.mdp != (select mdp from Administrateur where IdAd = new.IdU)
                OR new.mdp != (select mdp from Professeur where IdPf = new.IdU)
                OR new.mdp != (select mdp from Etudiant where IdE = new.IdU))
                then
                    set new.mdp = sha1(new.mdp);
        end if;
    end if;
end if;
end //
delimiter ;

--          /AFTER

drop trigger if exists afterupd_user;
delimiter //
create trigger afterupd_user
after update on User
for each row
begin
declare mdp2 varchar (100);
declare nom2 varchar (25);
declare adresse2 varchar(50);
declare email2 varchar (50);
declare telephone2 varchar (10);
declare prenom2 varchar (25);

-- historisation mdp
if  new.mdp in (select mdp from HistoUser h where h.IdU = new.IdU) = 0
    && (new.mdp != (select mdp from Administrateur where IdAd = new.IdU)
                OR new.mdp != (select mdp from Professeur where IdPf = new.IdU)
                OR new.mdp != (select mdp from Etudiant where IdE = new.IdU))
    then
        insert into HistoUser values (null,new.IdU,old.mdp);
end if;

-- heritages
if new.IdU IN (select IdPf from Professeur) = 1
    then
--      mdp
        select mdp into mdp2 from Professeur where IdPf = new.IdU;
        if mdp2 != new.mdp
            then
                update Professeur set mdp = new.mdp where IdPf = new.IdU;
        end if;
--      autres
        select nom,prenom,adresse,telephone,email into nom2,prenom2,adresse2,telephone2,email2 from Professeur where IdPf = new.IdU;
        if new.nom != nom2 OR new.prenom != prenom2 OR new.email != email2 OR new.telephone != telephone2 OR new.adresse != adresse2
            then
                update Professeur
                    set nom = new.nom,
                    prenom = new.prenom,
                    email = new.email,
                    telephone = new.telephone,
                    adresse = new.adresse
                    where IdPf = new.IdU;
        end if;
else if new.IdU IN (select IdE from Etudiant) = 1
        then
--      mdp
            select mdp into mdp2 from Etudiant where IdE = new.IdU;
            if mdp2 != new.mdp
                then
                    update Etudiant set mdp = new.mdp where IdE = new.IdU;
            end if;
--      autres
            select nom,prenom,adresse,telephone,email into nom2,prenom2,adresse2,telephone2,email2 from Etudiant where IdE = new.IdU;
            if new.nom != nom2 OR new.prenom != prenom2 OR new.email != email2 OR new.telephone != telephone2 OR new.adresse != adresse2
                then
                    update Etudiant
                        set nom = new.nom,
                        prenom = new.prenom,
                        email = new.email,
                        telephone = new.telephone,
                        adresse = new.adresse
                        where IdE = new.IdU;
            end if;
        else if new.IdU IN (select IdAd from Administrateur) = 1
                then
--      mdp
                    select mdp into mdp2 from Administrateur where IdAd = new.IdU;
                    if mdp2 != new.mdp
                        then
                            update Administrateur set mdp = new.mdp where IdAd = new.IdU;
                    end if;
--      autres
                    select nom,prenom,adresse,telephone,email into nom2,prenom2,adresse2,telephone2,email2 from Administrateur where IdAd = new.IdU;
                    if new.nom != nom2 OR new.prenom != prenom2 OR new.email != email2 OR new.telephone != telephone2 OR new.adresse != adresse2
                        then
                            update Administrateur
                                set nom = new.nom,
                                prenom = new.prenom,
                                email = new.email,
                                telephone = new.telephone,
                                adresse = new.adresse
                                where IdAd = new.IdU;
            end if;     
        end if;
    end if;
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
-- auto sign
        set new.URLSignature = (select URLSignature from Administrateur where IdAd = new.IdAd);
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

-- Duree auto
set new.duree = new.heureFin - new.heureDeb;

end //
delimiter ;

--      /UPDATE

drop trigger if exists UpdCours;
delimiter //
create trigger UpdCours
before insert on Cours
for each row
begin

-- Duree auto

set new.duree = new.heureFin - new.heureDeb;

end //
delimiter ;