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
          // echo "<tr>";
          // echo "<td class=".$this->classPartial."> Raison : ".$unElement['raisonLongue']."</td>";
          // echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classFull.">".$unElement['type']."</td>";
          echo "<td class=".$this->stateClass.">Etat : ".$unElement['etat']."</td>";
          echo "</tr>";
          echo "</table>";
          break;
        
        case 'ticket':
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
          echo "<td class=".$this->classPartial.">Raison : </td>";
          echo "<td class=".$this->stateClass.">".$unElement['raison']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td class=".$this->classPartial."> Signature : </td>";
          echo "<td class=".$this->stateClass.">".$unElement['URLSignature']."</td>";
          echo "</tr>";
          echo "</table>";
          break;

        case 'etudiant':
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
          echo "<td>Classe : </td>";
          echo "<td>".$saClasse['nom']."</td>";
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

        case 'etudiant-perturbation':
          $unControleur = Connexion::getConnexion();
          $unControleur -> setTable("Etudiant");
          $lEtudiant = $unControleur -> select_where("IdE", $unElement['IdE']);
          $unControleur -> setTable("Classe");
          $saClasse = $unControleur -> select_where("IdCl", $lEtudiant['IdCl']);
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$lEtudiant['nom']." ".$lEtudiant['prenom']."</h3>";
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
        
        case 'professeur':
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

        case 'classe':
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
        
        case 'cours':
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['Matiere']." > ".$unElement['nomCl']." avec M/Mm ".$unElement['nomPf']."</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<td>Ajouter le : </td>";
          echo "<td>".$unElement['dateTS']."</td>";
          echo "<td rowspan='8'><a href='./index.php?user=admin&page=1&subPage=3&ids=".$unElement['IdPf'].":".$unElement['IdCl'].":".$unElement['IdM']."&act=".$this->Edit."'><img src='./img/icons_colorees/edit.png' whidth='80' height='80' class='edt-btn'></a></td>";
          echo "<td rowspan='8'><a href='./index.php?user=admin&page=1&subPage=3&ids=".$unElement['IdPf'].":".$unElement['IdCl'].":".$unElement['IdM']."&act=".$this->Del."'><img src='./img/icons_colorees/delete.png' whidth='80' height='80' class='del-btn'></a></td>";
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
          echo "<td>A lieu le : </td>";
          echo "<td>".$unElement['dateC']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>De ".$unElement['heureDeb']."</td>";
          echo "<td>À ".$unElement['heureFin']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Durée : </td>";
          echo "<td>".$unElement['duree']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Salle : </td>";
          echo "<td>".$unElement['salle']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Classe : </td>";
          echo "<td>".$unElement['nomCl']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Matière : </td>";
          echo "<td>".$unElement['Matiere']."</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>Professeur : </td>";
          echo "<td>".$unElement['nomPf']."</td>";
          echo "</tr>";
          echo "</table>";
          echo "</div>";
          break;
        
        case 'matiere':
          echo "<div class=".$this->sdClass.">";
          echo "<h3 class=".$this->sdtClass.">".$unElement['intitule']."</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<td><a href='./index.php?user=admin&page=1&subPage=4&idM=".$unElement['IdM']."&act=".$this->Edit."'><img src='./img/icons_colorees/edit.png' whidth='80' height='80' class='edt-btn'></a></td>";
          echo "<td><a href='./index.php?user=admin&page=1&subPage=4&idM=".$unElement['IdM']."&act=".$this->Del."'><img src='./img/icons_colorees/delete.png' whidth='80' height='80' class='del-btn'></a></td>";
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