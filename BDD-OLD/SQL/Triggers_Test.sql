 1er TRAJET OBLIGATOIREMENT ACTIF

drop trigger if exists forceTrajet;
delimiter //
create trigger forceTrajet
    after insert on Trajet
    for each row
begin
    declare compte int;
    select count(*) into compte from Trajet where IdE = new.IdE;
    if compte < 1
        then
            update Trajet
                set active = 1
                where IdTj = new.IdTj;
    end if;
end //
delimiter ;

 Trajet ONE ACTIVE ONLY 

drop trigger if exists InsActiveTrajet;
delimiter //
create trigger InsActiveTrajet
    before insert on Trajet
    for each row
begin
    declare ide int(6);
    select IdE  into ide from Etudiant e where e.IdE = new.IdE;
    if new.active = 1
        then
            update Trajet
                set active = 0
                where IdE = ide
                and active = 1;
end if;
end //
delimiter ;

drop trigger if exists activeTrajet;
delimiter //
create trigger UpdActiveTrajet
    before update on Trajet
    for each row
begin
    declare ide int(6);
    if new.active != old.active
        then
            select IdE into ide from Etudiant e where e.IdE = new.IdE;
                update Trajet
                    set active = 0
                    where IdE = ide
                    and active = 1;
end if;
end //
delimiter ;

drop trigger if exists DelActiveTrajet;
delimiter //
create trigger DelActiveTrajet
    before delete on Trajet
    for each row
begin
    if old.active = 1
        then
            signal sqlstate '45000'
                set message_text = "Impossible de supprimer un trajet actif, definissez-en un d'abord avant de supprimer celui-ci";
end if;
end //
delimiter ;