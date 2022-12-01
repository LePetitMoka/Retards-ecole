<section class="gest-etudiants">
  <div class="container">
    <ul class="minibar unstyled-list">
      <li class="sub-buton">
        <a href="index.php?user=admin&page=1&subPage=0&action=show_etudiants">Liste des étudiants</a>
      </li>
      <li class="sub-buton">
        <a href="index.php?user=admin&page=1&subPage=0&action=insert_etudiant">Ajouter un etudiant</a>
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
          $action = 'show_etudiants';
        }
        switch ($action) {
          case 'show_etudiants':
            require_once("./vues/show/show_etudiants.php");
            break;
          case 'insert_etudiant':
            require_once("./vues/insert/insert_etudiant.php");
            break;

          default :
            require_once("index.php?user=admin&page=1&subPage=0&action=show_etudiants");
            break;
        }
      ?>
    </div>
  </div>
</section>