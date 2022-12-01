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
          require_once("./vues/gestion_bdd/gest-bdd-etudiants.php");
          break;
        case 1:
          require_once("./vues/gestion_bdd/gest-bdd-profs.php");
          break;
        case 2:
          require_once("./vues/gestion_bdd/gest-bdd-classes.php");
          break;
        
        default:
        require_once("index.php?user=admin&page=1&subPage=0");
          break;
      }
    ?>
  </div>
</section>