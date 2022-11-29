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
        switch ($subPage) {
          case 0:
            require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
            break;
          case 1:
            require_once("./vues/tableau_de_bord/admin/tdb-admin-Tickets.php");
            break;
          
          default:
          require_once("index.php?user=admin&page=1");
            break;
        }
      }
    ?>
  </div>
</section>