<?php
class Connexion {
  private static $unControleur ; 
  private static $server = "localhost";
  private static $user = "Seb";
  private static $password = "Seb";
  private static $bdd = "GestRetards";
  public static function  getConnexion(){
    if (Connexion::$unControleur == null){
      Connexion::$unControleur = new Controleur(Connexion::$server, Connexion::$user, Connexion::$password, Connexion::$bdd);
    }
    return Connexion :: $unControleur; 
  }
}

?>