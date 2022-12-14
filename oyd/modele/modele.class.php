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

    public function resetPage(){
      $_SESSION['pg'] = 1;
    }

    public function autentification ($id, $mdp){
      if($this->unPDO != null){
        $requete = "select * from ".$this->table." where email=:id and mdp=:mdp;";
        $donnees = array(":id" => $id, ":mdp" => $mdp);
        $select = $this->unPDO -> prepare($requete);
        $select -> execute($donnees);
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

    public function select_filter($filtre, $lesAttributs){
      if($this->unPDO != null){
				$tabLike = array();
				foreach ($lesAttributs as $unAttribut){
					$tabLike[] = $unAttribut." like :filtre";
				}
				$chaineLike = implode(" or ", $tabLike);
				$requete = "select * from ".$this->table." where ".$chaineLike.";";
				$donnees = array(":filtre" => '%'.$filtre.'%');
        $select = $this->unPDO -> prepare($requete);
        $select -> execute($donnees);
        $lesDonnees = $select -> fetchAll();
        return $lesDonnees;
      } else {
        return null;
      }
    }

    public function select_where($Attribut, $valeur){
      if($this->unPDO != null){
        $requete = "select * from ".$this->table." where ".$Attribut." = ".$valeur.";";
        $select = $this->unPDO -> prepare($requete);
        $select -> execute();
        $laTable = $select -> fetch();
        return $laTable;
      } else {
        return null;
      }
    }

    public function insert($ordre, $valeurs){
      if($this->unPDO != null){
        $valeurs = implode(', ', $valeurs);
        $requete = "insert into ".$this->table."(".$ordre.") values(".$valeurs.");";
        $insert = $this->unPDO -> prepare($requete);
        $insert -> execute();
      } else {
        return null;
      }
    }

    public function update_where($tableau, $Attribut, $valeur){
      $tabSet = array();
      foreach($tableau as $cle => $valCle){
        $tabSet[] = $cle." = ".$valCle;
      } 
      $tabSet = implode(', ', $tabSet);
      if($this->unPDO != null){
        $requete = "update ".$this->table." set ".$tabSet." where ".$Attribut." = ".$valeur.";";
        $update = $this->unPDO -> prepare($requete);
        $update -> execute();
      } else {
        return null;
      }
    }

    public function delete_where($Attribut, $valeur){
      if($this->unPDO != null){
        $requete = "delete from ".$this->table." where ".$Attribut." = ".$valeur.";";
        $delete = $this->unPDO -> prepare($requete);
        $delete -> execute();
      } else {
        return null;
      }
    }
  }
?>