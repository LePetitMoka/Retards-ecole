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
        } else {
          $action = 'show_classes';
        }
        switch ($action) {
          case 'show_classes':
            require_once("./vues/show/show_classes.php");
            break;
          case 'insert_classe':
            require_once("./vues/insert/insert_classe.php");
            break;

          default :
            require_once("index.php?user=admin&page=1&subPage=2&action=show_classes");
            break;
        }
      ?>
    </div>
  </div>
</section>