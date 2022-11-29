<section class="InfoTrafic">
  <div class="container">
    <ul class="minibar unstyled-list">
      <li class="sub-buton">
        <a href="index.php?user=admin&page=0&subPage=0&perturbe=0">Toutes les lignes</a>
      </li>
      <li class="sub-buton">
        <a href="index.php?user=admin&page=0&subPage=0&perturbe=1">Lignes perturbées</a>
      </li>
      <li>
        <input type="text" name="filtre">
        <input type="submit" name="Filtrer" value="Filtrer" class="sub-buton">
      </li>
    </ul>
    <div class="result">
      <?php
        if(isset($_GET['perturbe'])){
          $perturbe = $_GET['perturbe'];
          switch ($perturbe) {
            case 0 :
              require_once("./vues/show/show_transports.php");
              break;
            case 1 :
              require_once("./vues/show/show_disturbed_transports.php");
              break;
          }
        }
      ?>
    </div>
  </div>
</section>