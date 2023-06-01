<section class="gest-matiere">
  <div class="container">
    <ul class="minibar unstyled-list">
      <li class="sub-buton">
        <a href="index.php?user=admin&page=1&subPage=4&action=show_matieres">Liste des matières</a>
      </li>
      <li class="sub-buton">
        <a href="index.php?user=admin&page=1&subPage=4&action=insert_matiere">Ajouter une matières</a>
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
        if(isset($_GET['action'])){
          $action = $_GET['action'];
        } else {
          $action = 'show_matieres';
        }
        switch ($action) {
          case 'show_matieres':
            require_once("./vues/show/show_matieres.php");
            break;
          case 'insert_matiere':
            require_once("./vues/insert/insert_matiere.php");
            break;

          default :
            require_once("index.php?user=admin&page=1&subPage=4&action=show_matieres");
            break;
        }
      ?>
    </div>
  </div>
</section>