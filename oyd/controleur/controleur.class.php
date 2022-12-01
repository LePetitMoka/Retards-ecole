<?php
  require_once("modele/modele.class.php");
  class Controleur {
    private $unModele;
    
    public function __construct ($server, $user, $password, $bdd){
      $this->unModele = new Modele ($server, $user, $password, $bdd);
    }
  }
?>