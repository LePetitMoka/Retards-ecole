<h1>Administration de données</h1>
<section class="subnavbar">
  <div class="container">
    <div class="submenu">
      <ul class="submenu-list unstyled-list">
        <li><a href="index.php?user=admin&page=1&subPage=0" class="buton">Etudiants</a></li>
        <li><a href="index.php?user=admin&page=1&subPage=1" class="buton">Professeurs</a></li>
        <li><a href="index.php?user=admin&page=1&subPage=2" class="buton">Classes</a></li>
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
        
            $unControleur -> setTable("etudiant");
            $lEtudiant = $unControleur -> select_where("IdE", $ID);
            if (isset($_POST["Modifier"])){
              $_POST['nom'] = "'".$_POST['nom']."'";
              $_POST['prenom'] = "'".$_POST['prenom']."'";
              $_POST['email'] = "'".$_POST['email']."'";
              $_POST['addr'] = "'".$_POST['addr']."'";
              $_POST['tel'] = "'".$_POST['tel']."'";
              $tableau = array("nom"=>$_POST['nom'], "prenom"=>$_POST['prenom'], "email"=>$_POST['email'], "telephone"=>$_POST['tel'], "adresse"=>$_POST['addr'], "IdCl"=>$_POST['classe']);
              $unControleur -> setTable("etudiant");
              $unControleur -> update_where($tableau, "IdE", $ID);
              require_once("./vues/gestion_bdd/gest-bdd-etudiants.php");
            }else {
              require_once("./vues/update/update_etudiant.php");
            }
          } elseif(isset($_GET['act']) && $_GET['act'] == 'del') {
            $ID = $_GET['idE'];
        
            $unControleur -> setTable("etudiant");
            $unControleur -> delete_where("IdE", $ID);
            unset($_GET['act']);
            unset($_GET['idE']);
            require_once("./vues/gestion_bdd/gest-bdd-etudiants.php");
          }else {
            require_once("./vues/gestion_bdd/gest-bdd-etudiants.php");
          }
          break;   
        case 1:
          if(isset($_GET['act']) && $_GET['act'] == 'edit'){
            $ID = $_GET['idPf'];
        
            $unControleur -> setTable("professeur");
            $leProfesseur = $unControleur -> select_where("IdPf", $ID);
            if (isset($_POST["Modifier"])){
              $_POST['nom'] = "'".$_POST['nom']."'";
              $_POST['prenom'] = "'".$_POST['prenom']."'";
              $_POST['email'] = "'".$_POST['email']."'";
              $_POST['addr'] = "'".$_POST['addr']."'";
              $_POST['tel'] = "'".$_POST['tel']."'";
              $_POST['diplome'] = "'".$_POST['diplome']."'";
              $tableau = array("nom"=>$_POST['nom'], "prenom"=>$_POST['prenom'], "email"=>$_POST['email'], "telephone"=>$_POST['tel'], "adresse"=>$_POST['addr'], "diplome"=>$_POST['diplome']);
              $unControleur -> setTable("professeur");
              $unControleur -> update_where($tableau, "IdPf", $ID);
              require_once("./vues/gestion_bdd/gest-bdd-profs.php");
            }else {
              require_once("./vues/update/update_professeur.php");
            }
          } elseif(isset($_GET['act']) && $_GET['act'] == 'del') {
            $ID = $_GET['idPf'];
        
            $unControleur -> setTable("professeur");
            $unControleur -> delete_where("IdPf", $ID);
            unset($_GET['act']);
            unset($_GET['idPf']);
            require_once("./vues/gestion_bdd/gest-bdd-profs.php");
          }else {
            require_once("./vues/gestion_bdd/gest-bdd-profs.php");
          }
          break;
        case 2:
          if(isset($_GET['act']) && $_GET['act'] == 'edit'){
            $ID = $_GET['idCl'];
        
            $unControleur -> setTable("classe");
            $laClasse = $unControleur -> select_where("IdCl", $ID);
            if (isset($_POST["Modifier"])){
              $_POST['nom'] = "'".$_POST['nom']."'";
              $_POST['promotion'] = "'".$_POST['promotion']."'";
              $_POST['dipprepre'] = "'".$_POST['dipprepre']."'";
              $_POST['email'] = "'".$_POST['email']."'";
              $tableau = array("nom"=>$_POST['nom'], "promotion"=>$_POST['promotion'], "diplomePrepare"=>$_POST['dipprepre'], "email"=>$_POST['email']);
              $unControleur -> setTable("classe");
              $unControleur -> update_where($tableau, "IdCl", $ID);
              require_once("./vues/gestion_bdd/gest-bdd-classes.php");
            }else {
              require_once("./vues/update/update_classe.php");
            }
          } elseif(isset($_GET['act']) && $_GET['act'] == 'del') {
            $ID = $_GET['idCl'];
        
            $unControleur -> setTable("classe");
            $unControleur -> delete_where("IdCl", $ID);
            unset($_GET['act']);
            unset($_GET['idCl']);
            require_once("./vues/gestion_bdd/gest-bdd-classes.php");
          }else {
            require_once("./vues/gestion_bdd/gest-bdd-classes.php");
          }
          break;
        
        default:
        require_once("index.php?user=admin&page=1&subPage=0");
          break;
      }
    ?>
  </div>
</section>