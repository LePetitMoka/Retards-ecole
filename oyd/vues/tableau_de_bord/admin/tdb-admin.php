<h1>Tableau de bord admin</h1>
<section class="subnavbar">
  <div class="container">
    <div class="submenu">
      <ul class="submenu-list unstyled-list">
        <li><a class="buton selected" href="index.php?user=admin&page=0&subPage=0">Info Trafic</a></li>
        <li><a class="buton selected" href="index.php?user=admin&page=0&subPage=1">Ticket de retard</a></li>
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
          require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
          break;
        case 1:
          require_once("./vues/tableau_de_bord/admin/tdb-admin-Tickets.php");
          break;
        
        default:
        require_once("index.php?user=admin&page=0&subPage=0");
          break;
      }
    ?>
  </div>
</section>