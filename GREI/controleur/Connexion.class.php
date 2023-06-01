<?php
class Connexion {
  private static $unControleur ; 
  private static $server = "localhost:3307";
  private static $user = "root";
  private static $password = "";
  private static $bdd = "GestRetards";
  public static function  getConnexion(){
    if (Connexion::$unControleur == null){
      Connexion::$unControleur = new Controleur(Connexion::$server, Connexion::$user, Connexion::$password, Connexion::$bdd);
    }
    return Connexion :: $unControleur; 
  }
}

?>