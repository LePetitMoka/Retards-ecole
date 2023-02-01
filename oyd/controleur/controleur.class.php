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

    public function resetPage(){
      $this->unModele -> resetPage();
    }

    public function autentification($id, $mdp){
      $user = $this->unModele -> autentification($id, $mdp);
      return $user;
    }

    public function nouveau_compte($ordre, $valeurs){
      $this->unModele -> nouveau_compte($ordre, $valeurs);
    }

    public function select_all (){
      $lesDonnees = $this->unModele -> select_all();
      return $lesDonnees;
    }

    public function select_filter($filtre, $lesAttributs){
      $lesDonnees = $this->unModele -> select_filter($filtre, $lesAttributs);
      return $lesDonnees;
    }

    public function select_where($Attribut, $valeur){
      $laTable = $this->unModele -> select_where($Attribut, $valeur);
      return $laTable;
    }

    public function select_where_all($Attribut, $valeur){
      $laTable = $this->unModele -> select_where_all($Attribut, $valeur);
      return $laTable;
    }

    public function insert($ordre, $valeurs){
      $this->unModele -> insert($ordre, $valeurs);
    }

    public function update_where($tableau, $Attribut, $valeur){
      $this->unModele -> update_where($tableau, $Attribut, $valeur);
    }

    public function delete_where($Attribut, $valeur){
      $this->unModele -> delete_where($Attribut, $valeur);
    }
  }
?>