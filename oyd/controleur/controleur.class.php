<?php
  require_once("modele/modele.class.php");
  class Controleur {
    private $unModele;
    
    public function __construct ($server, $user, $password, $bdd){
      $this->unModele = new Modele ($server, $user, $password, $bdd);
    }

    public function setTable ($uneTable){
      $this->unModele -> setTable($uneTable);
    }

    public function select_all (){
      $lesDonnees = $this->unModele -> select_all();
      return $lesDonnees;
    }
  }
?>