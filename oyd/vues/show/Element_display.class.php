<?php
	require_once("./controleur/Connexion.class.php");
  class Display {
    private
    $var,
    $leType,
    $sdClass = '"show-div"',
    $tabClass = '"show-table"',
    $sdtClass = '"show-div-title"',
    $classFull = '"full"',
    $classPartial = '"partial"',
    $stateClass = '"state"',
    $Edit = "edit",
    $Del = "del";

    public function __construct (){
      $this->var = 0;
    }
    
    public function getType(){
      return $this->leType;
    }

    public function setType($leType){
      $this->leType = $leType;
    }

    public function display ($unElement){
      switch ($this->leType) {
        case 'transport':
          echo "<table class=".$this->tabClass.">";
          echo "<tr>";
          echo "<td rowspan='2' class=".$this->classFull."><img src='".$unElement['pictogramme']."' width='100' height='100'></td>";
          echo "<td class=".$this->classPartial.">".$unElement['type']." ".$unElement['nom']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classPartial."> Géré par : ".$unElement['transporteur']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classFull.">".$unElement['type']."</td>";
          echo "<td class=".$this->stateClass.">Etat : fluide</td>";
          echo "</tr>";
          echo "</table>";
          break;
        
        case 'ticket':
          echo "<table class=".$this->tabClass.">";
          echo "<tr>";
          echo "<td rowspan='2' class=".$this->classFull."><img src='".$unElement['dateB']."' width='100' height='100'></td>";
          echo "<td class=".$this->classPartial.">Etudiant num : ".$unElement['IdE'].", admin num : ".$unElement['IdAd']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classPartial."> Signature : ".$unElement['URLSignature']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classFull.">Ecole Iris</td>";
          echo "<td class=".$this->stateClass.">Abscence</td>";
          echo "</tr>";
          echo "</table>";
          break;

        case 'etudiant':
          $unControleur = Connexion::getConnexion();
          $unControleur -> setTable("classe");
          $saClasse = $unControleur -> select_where("IdCl", $unElement['IdCl']);
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['nom']." ".$unElement['prenom']."</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<td>Classe : </td>";
          echo "<td>".$saClasse['nom']."</td>";
          echo "<td rowspan='5'><a href='./index.php?user=admin&page=1&subPage=0&idE=".$unElement['IdE']."&act=".$this->Edit."'><img src='./img/icons_colorees/edit.png' whidth='80' height='80' class='edt-btn'></a></td>";
          echo "<td rowspan='5'><a href='./index.php?user=admin&page=1&subPage=0&idE=".$unElement['IdE']."&act=".$this->Del."'><img src='./img/icons_colorees/delete.png' whidth='80' height='80' class='del-btn'></a></td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Diplome preparé : </td>";
          echo "<td>".$saClasse['diplomePrepare']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Email : </td>";
          echo "<td>".$unElement['email']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Téléphone : </td>";
          echo "<td>".$unElement['telephone']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Adresse : </td>";
          echo "<td>".$unElement['adresse']."</td>";
          echo "</tr>";
          echo "</table>";
          echo "</div>";
          break;
        
        case 'professeur':
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['nom']." ".$unElement['prenom']."</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<td>Diplome récent : </td>";
          echo "<td>Master Informatique</td>";
          echo "<td rowspan='4'><img src='./img/icons_colorees/edit.png' whidth='80' height='80' class='edt-btn'></td>";
          echo "<td rowspan='4'><img src='./img/icons_colorees/delete.png' whidth='80' height='80' class='del-btn'></td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Email : </td>";
          echo "<td>".$unElement['email']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Téléphone : </td>";
          echo "<td>".$unElement['telephone']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Adresse : </td>";
          echo "<td>".$unElement['adresse']."</td>";
          echo "</tr>";
          echo "</table>";
          echo "</div>";
          break;

        case 'classe':
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['nom']." ".$unElement['promotion']."</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<td>Diplome preparé : </td>";
          echo "<td>".$unElement['diplomePrepare']."</td>";
          echo "<td rowspan='3'><img src='./img/icons_colorees/edit.png' whidth='80' height='80' class='edt-btn'></td>";
          echo "<td rowspan='3'><img src='./img/icons_colorees/delete.png' whidth='80' height='80' class='del-btn'></td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Nombre d'étudiants : </td>";
          echo "<td>".$unElement['nbEtudiants']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Email : </td>";
          echo "<td>".$unElement['email']."</td>";
          echo "</tr>";
          echo "</table>";
          echo "</div>";
          break;


        default:
          echo "Données introuvables";
          break;
      }
    }
  }
?>