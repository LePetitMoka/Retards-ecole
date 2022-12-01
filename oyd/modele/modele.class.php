<?php
  class Modele {
    private $unPDO;

    public function __construct ($server, $user, $password, $bdd){
      $this->unPDO = null;

      try {
        $this->unPDO = new PDO("mysql:host=".$server.";dbname=".$bdd, $user, $password);
      }

      catch (PDOExeption $exp){
				echo "Impossible de se connecter au serveur<br/>";
				echo $exp -> getMessage();
      }
    }
  }
?>