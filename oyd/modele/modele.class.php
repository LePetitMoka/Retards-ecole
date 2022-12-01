<?php
  class Modele {
    private $unPDO, $table;

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

    public function getTable (){
      return $this->table;
    }

    public function setTable ($uneTable){
      $this->table = $uneTable;
    }

    public function autentification ($id, $mdp){
      if($this->unPDO != null){
        $requete = "select * from ".$this->table.";";
        $select -> $this->unPDO -> prepare($requete);
        $select -> execute();
        $user = $select -> fetch();
        return $user;
      } else {
        return null;
      }
    }

    public function select_all (){
			if($this->unPDO != null){
				$requete = "select * from ".$this->table.";";
				$select = $this->unPDO -> prepare($requete);
				$select -> execute();
				$lesDonnees = $select -> fetchAll();
				return $lesDonnees;
			}else{
				return null;
			}
    }
  }
?>