<header>
  <div class="container">
    <div class="burger-bar">
      <button class="burger" id="burger"><span class="bar"></span></button>
    </div>
    <div class="buttons">
      <div class="user_icon">
        <a href="index.php?page=3">
          <img src="./img/icons colorées/parametres.png" width="60" height="60">
        </a>
      </div>
      <div class="Deconnection">
        <a href="index.php?page=4">
          <img src="./img/icons colorées/deconnexion.png" width="60" height="60">
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
              require_once("./vues/compte/compte-admin.php");
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
      <?php require_once("./vues/navbar/nav-admin.php"); ?>
    </ul>
  </div>
</section>
<section class="content">
<?php
  if(isset($_GET['user'])){
    $role = $_GET['user'];
    $page = $_GET['page'];
    
    switch ($_SESSION['role']) {
      case 'administrateur':
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
      // case 'prof':
      // 	# code...
      // 	break;
      // case 'etudiant':
      // 	# code...
      // 	break;
      
      default:
        require_once("./vues/tableau_de_bord/admin/tdb-admin.php");
        break;
    }
  } else {
    $class = '"welcome"';
    echo "<p class=".$class.">Bienvenue ".$_SESSION['nom']." ".$_SESSION['prenom']."</p>";
  }
?>
</section>
<footer>
  <div class="container">
    <div class="contacts">
      <div class="phone">
        <img src="./img/icons colorées/telephone.png" width="60" height="60">
        <p class="diff-font">+33(0)144018670</p>
      </div>
      <div class="mail">
        <a href="mailto:contact@ecoleiris.fr">
          <img src="./img/icons colorées/email.png" width="60" height="60">
          <p class="diff-font">contact@ecoleiris.fr</p>
        </a>
      </div>
      <div class="link">
        <a href="https://ecoleiris.fr/" target="_blank">
          <img src="./img/icons colorées/lien.png" width="60" height="60">
          <p class="diff-font">Site de l'école</p>
        </a>
      </div>
    </div>
    <div class="copyrights">
      <p>Copyright © <?php echo date("Y"); ?> GREI IRIS. All Rights Reserved.<p>
    </div>
  </div>
</footer>