<section class="gest-cours">
  <div class="container">
    <ul class="minibar unstyled-list">
      <li class="sub-buton">
        <a href="index.php?user=admin&page=1&subPage=3&action=show_cours">Liste des cours</a>
      </li>
      <li class="sub-buton">
        <a href="index.php?user=admin&page=1&subPage=3&action=insert_cours">Ajouter un cours</a>
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
          $action = 'show_cours';
        }
        switch ($action) {
          case 'show_cours':
            require_once("./vues/show/show_cours.php");
            break;
          case 'insert_cours':
            require_once("./vues/insert/insert_cours.php");
            break;

          default :
            require_once("index.php?user=admin&page=1&subPage=3&action=show_cours");
            break;
        }
      ?>
    </div>
  </div>
</section>