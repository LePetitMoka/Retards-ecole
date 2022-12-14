<?php
/*
NOTICE : Utiliser la fonction après avoir fait les insert dans 
            les tables Station et ZoneStation !  
*/

//Construction de la requete

$Stations = array();
$ZStations = array();

$temp = file_get_contents("StationChild.txt");

$Stations = explode("\n",$temp);

$temp = file_get_contents("ZoneStationFather.txt");

$ZStations = explode("\n",$temp);

$requete = "";
$i = 0;
foreach ($Stations as $Station){
    $requete .= "update Station set IdZSt = ".$ZStations[$i]." where IdSt = ".$Station.";";
    $i++;
}

echo "Boucles = ".$i"<br>";

//echo $requete;

$test = array();
$test = explode(";",$requete);
echo "Nb de requetes = ".sizeof($test);

// Connexion BDD

$server = "localhost";
$user = "root";
$password = "root";
$bdd = "GestRetards";

$unPDO = new PDO("mysql:host=".$server.";dbname=".$bdd, $user, $password);
$insert = $unPDO->prepare($requete);
$insert->execute();

?>