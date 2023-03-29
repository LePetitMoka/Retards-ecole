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
        case 'Transport':
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
          echo "<td class=".$this->stateClass.">Etat : ".$unElement['etat']."</td>";
          echo "</tr>";
          echo "</table>";
          break;
        
        case 'Ticket':
          $unControleur = Connexion::getConnexion();
          $unControleur -> setTable("Etudiant");
          $lEtudiant = $unControleur -> select_where("IdE", $unElement['IdE']);
          $unControleur -> setTable("Classe");
          $saClasse = $unControleur -> select_where("IdCl", $lEtudiant['IdCl']);
          $unControleur -> setTable("Administrateur");
          $lAdmin = $unControleur -> select_where("IdAd", $unElement['IdAd']);
          echo "<table class=".$this->tabClass.">";
          echo "<tr>";
          echo "<td class=".$this->classPartial.">Etudiant concerné : </td>";
          echo "<td class=".$this->stateClass.">".$lEtudiant['nom']." ".$lEtudiant['prenom']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classPartial.">Classe de l'étudiant : </td>";
          echo "<td class=".$this->stateClass.">".$saClasse['nom']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classPartial.">Administrateur Traitant : </td>";
          echo "<td class=".$this->stateClass.">".$lAdmin['nom']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classPartial.">Date : </td>";
          echo "<td class=".$this->stateClass.">".$unElement['dateB']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classPartial.">Durée de retard : </td>";
          echo "<td class=".$this->stateClass.">".$unElement['dureeRetard']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classPartial."> Signature : </td>";
          echo "<td class=".$this->stateClass.">".$unElement['URLSignature']."</td>";
          echo "</tr>";
          echo "</table>";
          break;

        case 'Etudiant':
          $unControleur = Connexion::getConnexion();
          $unControleur -> setTable("Classe");
          $saClasse = $unControleur -> select_where("IdCl", $unElement['IdCl']);
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['nom']." ".$unElement['prenom']."</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<td>Classe : </td>";
          echo "<td>".$saClasse['nom']."</td>";
          echo "<td rowspan='5'><a href='./index.php?user=admin&page=1&subPage=0&idE=".$unElement['IdE']."&act=".$this->Edit."'><img src='./img/icons_colorees/edit.png' whidth='80' height='80' class='edt-btn'></a></td>";
          echo "<td rowspan='5'><a href='./index.php?user=admin&page=1&subPage=0&idE=".$unElement['IdE']."&act=".$this->Del."'><img src='./img/icons_colorees/delete.png' whidth='80' height='80' class='del-btn'></a></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
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

        case 'etudiant-lite':
          $unControleur = Connexion::getConnexion();
          $unControleur -> setTable("Classe");
          $saClasse = $unControleur -> select_where("IdCl", $unElement['IdCl']);
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['nom']." ".$unElement['prenom']."</h3>";
          echo "<table>";
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

        case 'etudiant-perturbation':
          $unControleur = Connexion::getConnexion();
          $unControleur -> setTable("Etudiant");
          $lEtudiant = $unControleur -> select_where("IdE", $unElement['IdE']);
          $unControleur -> setTable("Classe");
          $saClasse = $unControleur -> select_where("IdCl", $lEtudiant['IdCl']);
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['nom']." ".$unElement['prenom']."</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<td>Date de la perturbation : </td>";
          echo "<td>".$unElement['date']."</td>";
          echo "<td rowspan='5'><a href='./index.php?user=admin&page=0&subPage=0&perturbe=2&idE=".$unElement['IdE']."&date=".$unElement['date']."'><img src='./img/icons_colorees/le-recu.png' whidth='80' height='80' class='ticket-btn'></a></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Diplome preparé : </td>";
          echo "<td>".$saClasse['diplomePrepare']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Email : </td>";
          echo "<td>".$lEtudiant['email']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Téléphone : </td>";
          echo "<td>".$lEtudiant['telephone']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Adresse : </td>";
          echo "<td>".$lEtudiant['adresse']."</td>";
          echo "</tr>";
          echo "</table>";
          echo "</div>";
          break;
        
        case 'Professeur':
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['nom']." ".$unElement['prenom']."</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<td>Diplome récent : </td>";
          echo "<td>".$unElement['diplome']."</td>";
          echo "<td rowspan='4'><a href='./index.php?user=admin&page=1&subPage=1&idPf=".$unElement['IdPf']."&act=".$this->Edit."'><img src='./img/icons_colorees/edit.png' whidth='80' height='80' class='edt-btn'></a></td>";
          echo "<td rowspan='4'><a href='./index.php?user=admin&page=1&subPage=1&idPf=".$unElement['IdPf']."&act=".$this->Del."'><img src='./img/icons_colorees/delete.png' whidth='80' height='80' class='del-btn'></a></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
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

        case 'professeur-lite':
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['nom']." ".$unElement['prenom']."</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<td>Diplome récent : </td>";
          echo "<td>".$unElement['diplome']."</td>";
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

        case 'Classe':
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['nom']." ".$unElement['promotion']."</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<td>Diplome preparé : </td>";
          echo "<td>".$unElement['diplomePrepare']."</td>";
          echo "<td rowspan='3'><a href='./index.php?user=admin&page=1&subPage=2&idCl=".$unElement['IdCl']."&act=".$this->Edit."'><img src='./img/icons_colorees/edit.png' whidth='80' height='80' class='edt-btn'></a></td>";
          echo "<td rowspan='3'><a href='./index.php?user=admin&page=1&subPage=2&idCl=".$unElement['IdCl']."&act=".$this->Del."'><img src='./img/icons_colorees/delete.png' whidth='80' height='80' class='del-btn'></a></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
          echo "<td><br/></td>";
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