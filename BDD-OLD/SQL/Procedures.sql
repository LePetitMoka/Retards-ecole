-- Proc pour inserer deux "trajets" en meme temps

drop procedure if exists insertTJ;
delimiter //
create procedure insertTJ (in idetu int(6), in arretDeb varchar(30), in arretFin varchar(30))
begin
    if (arretDeb = arretFin)
        then
            signal sqlstate '45020'
                set message_text = 'Les arrets doivent être différents'; 
    end if;
    if (select IdSt from Trajet where IdSt = arretDeb AND ide = idetu) is null
        then
            insert into Trajet values (arretDeb, idetu);
    end if;
    if (select IdSt from Trajet where IdSt = arretFin AND ide = idetu) is null
        then
            insert into Trajet values (arretFin, idetu);
    end if;
end //
delimiter ;

-- Proc pour lier toutes les stations d'une ligne à une perturbation

drop procedure if exists insertPtByTp;
delimiter //
create procedure insertPtByTp(in IdTransport varchar(30), in IdPerturbation varchar (90))
begin
declare fini int default 0;
declare numSt varchar (30);
declare curStTp cursor for
select IdSt from Vue_Arret_Transport where IdTp = IdTransport;
declare continue handler for not found set fini =1;
open curStTp;
fetch curStTp into numSt;
while fini != 1
do
    if (select numSt from Concerner where IdPt = IdPerturbation and IdSt = numSt) is null
        then
            insert into Concerner values (numSt,IdPerturbation);
    end if;
    fetch curStTp into numSt;
end while;
close curStTp;
end //
delimiter ;