<section class="gest-classes">
  <div class="container">
    <ul class="minibar unstyled-list">
      <li class="sub-buton">
        <a href="index.php?user=admin&page=1&subPage=2&action=show_classes">Liste des classes</a>
      </li>
      <li class="sub-buton">
        <a href="index.php?user=admin&page=1&subPage=2&action=insert_classe">Ajouter une classe</a>
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
          switch ($action) {
            case 'show_classes':
              require_once("./vues/show/show_classes.php");
              break;
            case 'insert_classe':
              require_once("./vues/insert/insert_classe.php");
              break;

            default :
              require_once("./vues/show/show_classe.php");
              break;
          }
        }
      ?>
    </div>
  </div>
</section>