<section class="gest-profs">
  <div class="container">
    <ul class="minibar unstyled-list">
      <li class="sub-buton">
        <a href="index.php?user=admin&page=1&subPage=1&action=show_professeurs">Liste des professeurs</a>
      </li>
      <li class="sub-buton">
        <a href="index.php?user=admin&page=1&subPage=1&action=insert_professeur">Ajouter un professeur</a>
      </li>
      <li>
        <input type="text" name="filtre">
        <input type="submit" name="Filtrer" value="Filtrer" class="sub-buton">
      </li>
    </ul>
    <div class="result">
      <?php
        if(isset($_GET['action'])){
          $action = $_GET['action'];
        } else {
          $action = 'show_professeurs';
        }
        switch ($action) {
          case 'show_professeurs':
            require_once("./vues/show/show_professeurs.php");
            break;
          case 'insert_professeur':
            require_once("./vues/insert/insert_professeur.php");
            break;

          default :
            require_once("index.php?user=admin&page=1&subPage=1&action=show_professeurs");
            break;
        }
      ?>
    </div>
  </div>
</section>