<h1>Administration de données</h1>
<section class="subnavbar">
  <div class="container">
    <div class="submenu">
      <ul class="submenu-list unstyled-list">
        <li><a href="index.php?user=admin&page=1&subPage=0" class="buton">Etudiants</a></li>
        <li><a href="index.php?user=admin&page=1&subPage=1" class="buton">Professeurs</a></li>
        <li><a href="index.php?user=admin&page=1&subPage=2" class="buton">Classes</a></li>
        <li><a href="index.php?user=admin&page=1&subPage=3" class="buton">Cours</a></li>
        <li><a href="index.php?user=admin&page=1&subPage=4" class="buton">Matière</a></li>
      </ul>
    </div>
  </div>
</section>
<section class="tdb-content">
  <div class="container">
    <?php
      if(isset($_GET['subPage'])){
        $subPage = $_GET['subPage'];
      } else {
        $subPage = 0;
      }
      switch ($subPage) {
        case 0:
          if(isset($_GET['act']) && $_GET['act'] == 'edit'){
            $ID = $_GET['idE'];
        
            $unControleur -> setTable("Etudiant");
            $lEtudiant = $unControleur -> select_where("IdE", $ID);
            if (isset($_POST["Modifier"])){
              $_POST['nom'] = "'".$_POST['nom']."'";
              $_POST['prenom'] = "'".$_POST['prenom']."'";
              $_POST['email'] = "'".$_POST['email']."'";
              $_POST['addr'] = "'".$_POST['addr']."'";
              $_POST['tel'] = "'".$_POST['tel']."'";
              $tableau = array("nom"=>$_POST['nom'], "prenom"=>$_POST['prenom'], "email"=>$_POST['email'], "telephone"=>$_POST['tel'], "adresse"=>$_POST['addr'], "IdCl"=>$_POST['classe']);
              $unControleur -> setTable("Etudiant");
              $unControleur -> update_where($tableau, "IdE", $ID);
              //require_once("./vues/gestion_bdd/gest-bdd-etudiants.php");
              header("location:index.php?user=admin&page=1&subPage=0");
            }else {
              require_once("./vues/update/update_etudiant.php");
            }
          } elseif(isset($_GET['act']) && $_GET['act'] == 'del') {
            $ID = $_GET['idE'];
        
            $unControleur -> setTable("Etudiant");
            $unControleur -> delete_where("IdE", $ID);
            unset($_GET['act']);
            unset($_GET['idE']);
            //require_once("./vues/gestion_bdd/gest-bdd-etudiants.php");
            header("location:index.php?user=admin&page=1&subPage=0");
          }else {
            require_once("./vues/gestion_bdd/gest-bdd-etudiants.php");
          }
          break;   
        case 1:
          if(isset($_GET['act']) && $_GET['act'] == 'edit'){
            $ID = $_GET['idPf'];
        
            $unControleur -> setTable("Professeur");
            $leProfesseur = $unControleur -> select_where("IdPf", $ID);
            if (isset($_POST["Modifier"])){
              $_POST['nom'] = "'".$_POST['nom']."'";
              $_POST['prenom'] = "'".$_POST['prenom']."'";
              $_POST['email'] = "'".$_POST['email']."'";
              $_POST['addr'] = "'".$_POST['addr']."'";
              $_POST['tel'] = "'".$_POST['tel']."'";
              $_POST['diplome'] = "'".$_POST['diplome']."'";
              $tableau = array("nom"=>$_POST['nom'], "prenom"=>$_POST['prenom'], "email"=>$_POST['email'], "telephone"=>$_POST['tel'], "adresse"=>$_POST['addr'], "diplome"=>$_POST['diplome']);
              $unControleur -> setTable("Professeur");
              $unControleur -> update_where($tableau, "IdPf", $ID);
              //require_once("./vues/gestion_bdd/gest-bdd-profs.php");
              header("location:index.php?user=admin&page=1&subPage=1");
            }else {
              require_once("./vues/update/update_professeur.php");
            }
          } elseif(isset($_GET['act']) && $_GET['act'] == 'del') {
            $ID = $_GET['idPf'];
        
            $unControleur -> setTable("Professeur");
            $unControleur -> delete_where("IdPf", $ID);
            unset($_GET['act']);
            unset($_GET['idPf']);
            //require_once("./vues/gestion_bdd/gest-bdd-profs.php");
            header("location:index.php?user=admin&page=1&subPage=1");
          }else {
            require_once("./vues/gestion_bdd/gest-bdd-profs.php");
          }
          break;
        case 2:
          if(isset($_GET['act']) && $_GET['act'] == 'edit'){
            $ID = $_GET['idCl'];
        
            $unControleur -> setTable("Classe");
            $laClasse = $unControleur -> select_where("IdCl", $ID);
            if (isset($_POST["Modifier"])){
              $_POST['nom'] = "'".$_POST['nom']."'";
              $_POST['promotion'] = "'".$_POST['promotion']."'";
              $_POST['dipprepre'] = "'".$_POST['dipprepre']."'";
              $_POST['email'] = "'".$_POST['email']."'";
              $tableau = array("nom"=>$_POST['nom'], "promotion"=>$_POST['promotion'], "diplomePrepare"=>$_POST['dipprepre'], "email"=>$_POST['email']);
              $unControleur -> setTable("Classe");
              $unControleur -> update_where($tableau, "IdCl", $ID);
              //require_once("./vues/gestion_bdd/gest-bdd-classes.php");
              header("location:index.php?user=admin&page=1&subPage=2");
            }else {
              require_once("./vues/update/update_classe.php");
            }
          } elseif(isset($_GET['act']) && $_GET['act'] == 'del') {
            $ID = $_GET['idCl'];
        
            $unControleur -> setTable("Classe");
            $unControleur -> delete_where("IdCl", $ID);
            unset($_GET['act']);
            unset($_GET['idCl']);
            //require_once("./vues/gestion_bdd/gest-bdd-classes.php");
            header("location:index.php?user=admin&page=1&subPage=2");
          }else {
            require_once("./vues/gestion_bdd/gest-bdd-classes.php");
          }
          break;
        case 3:
          if(isset($_GET['act']) && $_GET['act'] == 'edit'){
            // recuperrer les ids dans une hashmap ($IDs) dans l'odre 0=IdPf, 1=IdCl, 2=IdM
            $IDs = explode(":", $_GET['ids']);

            var_dump($IDs);
        
            $unControleur -> setTable("Vue_Cours_Details");
            $tableau = array("IdPf" => $IDs[0], "IdCl" => $IDs[1], "IdM" => $IDs[2]);
            $leCours = $unControleur -> select_where_mult($tableau);
            if (isset($_POST["Modifier"])){
              $_POST['jour'] = "'".$_POST['jour']."'";
              $_POST['salle'] = "'".$_POST['salle']."'";
              $_POST['deb'] = "'".$_POST['deb']."'";
              $_POST['fin'] = "'".$_POST['fin']."'";
              $ordre = "IdCl, IdPf, IdM, dateC, salle, heureDeb, heureFin";
              $valeurs = array("IdCl"=>$_POST['classe'], "IdPf"=>$_POST['prof'], "IdM"=>$_POST['matiere'], "dateC"=>$_POST['jour'], "salle"=>$_POST['salle'], "heureDeb"=>$_POST['deb'], "heureFin"=>$_POST['fin']);
              $unControleur -> setTable("Cours");
              $tableau2 = array("IdPf" => $leCours['IdPf'], "IdCl" => $leCours['IdCl'], "IdM" => $leCours['IdM']);
              $unControleur -> update_where_mult($valeurs, $tableau2);
              //require_once("./vues/gestion_bdd/gest-bdd-cours.php");

              header("location:index.php?user=admin&page=1&subPage=3");
            }else {
              require_once("./vues/update/update_cours.php");
            }
          } elseif(isset($_GET['act']) && $_GET['act'] == 'del') {
            // recuperrer les ids dans une hashmap ($IDs) dans l'odre 0=IdPf, 1=IdCl, 2=IdM
            $IDs = explode(":", $_GET['ids']);

            var_dump($IDs);
        
            $unControleur -> setTable("Cours");
            $tableau = array("IdPf" => $IDs[0], "IdCl" => $IDs[1], "IdM" => $IDs[2]);
            $unControleur -> delete_where_mult($tableau);
            unset($_GET['act']);
            unset($_GET['ids']);
            //require_once("./vues/gestion_bdd/gest-bdd-classes.php");
            header("location:index.php?user=admin&page=1&subPage=3");
          }else {
            require_once("./vues/gestion_bdd/gest-bdd-cours.php");
          }
          break;
        case 4:
          if(isset($_GET['act']) && $_GET['act'] == 'edit'){
            $ID = $_GET['idM'];
        
            $unControleur -> setTable("Matiere");
            $laClasse = $unControleur -> select_where("IdM", $ID);
            if (isset($_POST["Modifier"])){
              $_POST['intitule'] = "'".$_POST['intitule']."'";
              $tableau = array("intitule"=>$_POST['intitule']);
              $unControleur -> setTable("Matiere");
              $unControleur -> update_where($tableau, "idM", $ID);
              //require_once("./vues/gestion_bdd/gest-bdd-classes.php");
              header("location:index.php?user=admin&page=1&subPage=4");
            }else {
              require_once("./vues/update/update_matiere.php");
            }
          } elseif(isset($_GET['act']) && $_GET['act'] == 'del') {
            $ID = $_GET['idM'];
        
            $unControleur -> setTable("Matiere");
            $unControleur -> delete_where("IdM", $ID);
            unset($_GET['act']);
            unset($_GET['idM']);
            //require_once("./vues/gestion_bdd/gest-bdd-classes.php");
            header("location:index.php?user=admin&page=1&subPage=4");
          }else {
            require_once("./vues/gestion_bdd/gest-bdd-matiere.php");
          }
          break;
        
        default:
        require_once("index.php?user=admin&page=1&subPage=0");
          break;
      }
    ?>
  </div>
</section>