<section class="InfoTrafic">
  <div class="container">
    <ul class="minibar unstyled-list">
      <li>
        <a class="sub-buton selected" href="index.php?user=etudiant&page=0&subPage=0&profs=0">Camarades de classe</a>
      </li>
      <li>
        <a class="sub-buton selected" href="index.php?user=etudiant&page=0&subPage=0&profs=1">Professeurs</a>
      </li>
    </ul>
    <div class="result">
      <?php
        if(isset($_GET['profs'])){
          $profs = $_GET['profs'];
        } else {
          $profs = 0;
        }
        switch ($profs) {
          case 0 :
            require_once("./vues/show/show_camarades.php");
            break;
          case 1 :
            require_once("./vues/show/show_professeurs_lite.php");
            break;

          default :
            require_once("index.php?user=etudiant&page=0&subPage=0&profs=0");
            break;
        }
      ?>
    </div>
  </div>
</section>