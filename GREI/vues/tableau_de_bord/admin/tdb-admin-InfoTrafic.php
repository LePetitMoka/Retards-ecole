<section class="InfoTrafic">
  <div class="container">
    <ul class="minibar unstyled-list">
      <li>
        <a class="sub-buton selected" href="index.php?user=admin&page=0&subPage=0&perturbe=0">Toutes les lignes</a>
      </li>
      <li>
        <a class="sub-buton selected" href="index.php?user=admin&page=0&subPage=0&perturbe=1">Lignes perturbées</a>
      </li>
      <li>
        <a class="sub-buton selected" href="index.php?user=admin&page=0&subPage=0&perturbe=2">Etudiants concernés</a>
      </li>
      <li>
        <form method="post">
          <input type="text" name="filtre">
          <input type="submit" name="Filtrer" value="Filtrer" class="sub-buton">
        </form>
      </li>
    </ul>
    <div class="result">
      <?php
        if(isset($_GET['perturbe'])){
          $perturbe = $_GET['perturbe'];
        } else {
          $perturbe = 0;
        }
        switch ($perturbe) {
          case 0 :
            require_once("./vues/show/show_transports.php");
            break;
          case 1 :
            require_once("./vues/show/show_disturbed_transports.php");
            break;
          case 2 :
            if(isset($_GET['idE']) && isset($_GET['date'])){
              $ID = $_GET['idE'];
              $date = $_GET['date'];
          
              $unControleur -> setTable("Etudiant");
              $lEtudiant = $unControleur -> select_where("IdE", $ID);
              // if(isset($_POST['Ajouter'])){
              //   require_once("./vues/show/show_disturbed_etudiants.php");
              // } else {
              //   require_once("./vues/insert/insert_ticket-perturbation.php");
              // }
              require_once("./vues/insert/insert_ticket-perturbation.php");
            }else {
              require_once("./vues/show/show_disturbed_etudiants.php");
            }
            break;

          default :
            require_once("index.php?user=admin&page=0&subPage=0&perturbe=0");
            break;
        }
      ?>
    </div>
  </div>
</section>