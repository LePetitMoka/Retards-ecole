-- Jointure Arret/Transport

create or replace view Arret_Transport(NomArret, NomTransport, type, transporteur)
as select s.nom, t.nom, t.type, t.transporteur 
from Station s, Transport t, Appartenir a
where a.IdSt = s.IdSt
and a.IdTp = t.IdTp;

--