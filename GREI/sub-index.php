<header>
  <div class="container">
    <div class="burger-bar">
      <button class="burger" id="burger"><span class="bar"></span></button>
    </div>
    <div class="buttons">
      <div class="user_icon">
        <a href="index.php?<?php 
          if($_SESSION['role'] == "Administrateur"){
            echo "page=3";
          }else if($_SESSION['role'] == "Professeur"){
            echo "user=prof&page=2";
          }else if($_SESSION['role'] == "Etudiant"){
            echo "user=etudiant&page=2";
          }
        ?>">
          <img src="./img/icons_colorees/parametres.png" width="60" height="60">
        </a>
      </div>
      <div class="Deconnection">
        <a href="index.php?page=4">
          <img src="./img/icons_colorees/deconnexion.png" width="60" height="60">
        </a>
      </div>
    </div>
      <?php
        if(isset($_GET['user'])){
          $role = $_GET['user'];
          $page = $_GET['page'];
        }
        if(isset($_GET['page'])){
          switch ($_GET['page']){
            case 3:
              $_GET['user'] = "admin";
              break;
            case 4:
              session_destroy();
              unset($_SESSION['role']);
              require_once("./index.php");
              header("location:index.php");
              break;
          }
        }
      ?>
  </div>
</header>
<section class="vertical-navbar">
  <div class="container">
    <ul class="menu unstyled-list">
      <?php
        switch ($_SESSION['role']) {
          case 'Administrateur':
            require_once("./vues/navbar/nav-admin.php");
            break;
          case 'Professeur':
            require_once("./vues/navbar/nav-prof.php");
            break;
          case 'Etudiant':
            require_once("./vues/navbar/nav-etudiant.php");
            break;
        }
      ?>
    </ul>
  </div>
</section>
<section class="content">
<?php
  if(isset($_GET['user'])){
    $role = $_GET['user'];
    $page = $_GET['page'];
    
    switch ($_SESSION['role']) {
      case 'Administrateur':
        switch ($page) {
          case 0:
            require_once("./vues/tableau_de_bord/admin/tdb-admin.php");
            break;
          case 1:
            require_once("./vues/gestion_bdd/gest-bdd.php");
            break;
          case 2:
            require_once("./vues/message/msg-admin.php");
            break;
          case 3:
            require_once("./vues/compte/compte-admin.php");
            break;
          case 4:
            session_destroy();
            unset($_SESSION['role']);
            // require_once("./index.php");
            header("location:index.php");
            break;
            
          default:
            header("location:index.php");
            break;
        }				
        break;
      case 'Professeur':
        switch ($page) {
          case 0:
            require_once("./vues/tableau_de_bord/professeur/tdb-professeur.php");
            break;
          case 1:
            require_once("./vues/message/msg-professeur.php");
            break;
          case 2:
            require_once("./vues/compte/compte-admin.php");
            break;
          case 3:
            session_destroy();
            unset($_SESSION['role']);
            // require_once("./index.php");
            header("location:index.php");
            break;
            
          default:
            header("location:index.php");
            break;
        }
      	break;
      case 'Etudiant':
        switch ($page) {
          case 0:
            require_once("./vues/tableau_de_bord/etudiant/tdb-etudiant.php");
            break;
          case 1:
            require_once("./vues/message/msg-etudiant.php");
            break;
          case 2:
            require_once("./vues/compte/compte-admin.php");
            break;
          case 3:
            session_destroy();
            unset($_SESSION['role']);
            // require_once("./index.php");
            header("location:index.php");
            break;
            
          default:
            header("location:index.php");
            break;
        }				
      break;
      
      default:
        header("location:index.php");
        break;
    }
  } else {
    $class = '"welcome"';
    echo "<p class=".$class.">Bienvenue ".$_SESSION['nom']."</p>";
  }
?>
</section>
<footer>
  <div class="container">
    <div class="contacts">
      <div class="phone">
        <img src="./img/icons_colorees/telephone.png" width="60" height="60">
        <p class="diff-font">+33(0)144018670</p>
      </div>
      <div class="mail">
        <a href="mailto:contact@ecoleiris.fr">
          <img src="./img/icons_colorees/poster.png" width="60" height="60">
          <p class="diff-font">contact@ecoleiris.fr</p>
        </a>
      </div>
      <div class="link">
        <a href="https://ecoleiris.fr/" target="_blank">
          <img src="./img/icons_colorees/lien.png" width="60" height="60">
          <p class="diff-font">Site de l'école</p>
        </a>
      </div>
    </div>
    <div class="copyrights">
      <p>Copyright © <?php echo date("Y"); ?> GREI IRIS. All Rights Reserved.<p>
    </div>
  </div>
</footer>