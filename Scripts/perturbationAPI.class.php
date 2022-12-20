<?php

class PerturbationAPI {
    private $unPDO;
    private $IDMessage = "";
    private $dateDebutM = "";
    private $dateFinM = "";
    private $raisonCourte = "";
    private $raisonLongue = "";
    private $arrets = array();
    private $requetePt = "";
    private $requeteCr = "";

    public function __construct($server,$bdd,$user,$password){
        $this->unPDO = null;
        try {
            $this->unPDO = new PDO("mysql:host=".$server.";dbname=".$bdd, $user, $password);
        }
    
        catch (PDOExeption $exp){
            echo "Impossible de se connecter au serveur<br/>";
            echo $exp -> getMessage();
        }
    }    

    public function constructPerturbation(){
        $chaineCol = "";
        $chaineVal = "";
        $this->requetePt = "insert into perturbation "; // insert perturbation
        
        $chaineCol .= "(IdPt,";
        if ($this->raisonCourte != ""){ 
            $chaineCol .= "raisonCourte,";
        }
        $chaineCol .= "raisonLongue,dateDebMessage,dateFinMessage) ";

        $chaineVal .= '("'.$this->IDMessage.'",';
        if ($this->raisonCourte != ""){
            $chaineVal .= '"'.$this->raisonCourte.'",';
        }
        $chaineVal .= '"'.$this->raisonLongue.'","'.$this->dateDebutM.'","'.$this->dateFinM.'")';

        $this->requetePt .= $chaineCol."values ".$chaineVal.";";
        var_dump($this->requetePt);
    }    
    public function constructConcerner(){
        $this->requeteCr = "insert into concerner values "; // insert perturber
        for($i = 0; $i+1 <= sizeof($this->arrets); $i++){
            $chaineVal = "";
            $chaineVal = '("'.$this->arrets[$i].'","'.$this->IDMessage.'")';
            $this->requeteCr .= $chaineVal;
            if ($i+1 != sizeof($this->arrets)){
                $this->requeteCr .= ",";
            } else {
                $this->requeteCr .= ";";
            }
        }

        var_dump($this->requeteCr);
    }
    public function insertAll(){
        $insert = $this->unPDO->prepare($this->requetePt);
        echo "<br>REQUETE PT:".$this->requetePt."<br>";
        $insert->execute();
        echo "INSERE Perturbation";
        $insert = $this->unPDO->prepare($this->requeteCr);
        echo "REQUETE CR:".$this->requeteCr."<br>";
        $insert->execute();
        echo "INSERE Concerner";
    }
    
    public function setDates($dd,$df){
        $this->dateDebutM = $dd;
        $this->dateFinM = $df;
    }
    public function setMessages($tab){
        foreach($tab as $key => $value){
            if ($key == 'TEXT_ONLY'){
                $this->raisonLongue = $value;
            } elseif ($key == 'SHORT_MESSAGE'){
                $this->raisonCourte = $value;
            }
        }
    }
    public function setTransporteur($T){
        $this->transporteur = $T;
    }
    public function setIDMessage($idm){
        $this->IDMessage = $idm;
    }
    public function setArrets($tab,$tp){
        if ($this->transporteur == "RATP" && $this->unPDO != null){ // SI RATP ALORS ARRETS = tous les arrets de la/les ligne(s)
            $unPDO = new PDO("mysql:host=".$this->server.";dbname=".$this->bdd, $this->user, $this->password);
            foreach($tab as $ligne){ //pour chaque ligne de la table en parametre
                $requete = "select IdSt from appartenir where IdTp = ".$ligne.";"; //renvoyer toutes les stations de la ligne
                $extract = $unPDO->prepare($requete);
                $extract->execute();
                $lesStations = $select -> fetchAll();
                $this->arrets = array_merge($this->arrets,$lesStations); // 
            }
        }else $this->arrets = $tab;
    }
}

?>