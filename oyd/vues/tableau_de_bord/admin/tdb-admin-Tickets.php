<section class="InfoTrafic">
  <div class="container">
    <ul class="minibar unstyled-list">
      <li class="sub-buton">
        <a href="index.php?user=admin&page=0&subPage=1&action='show_tickets'">Liste des tickets</a>
      </li>
      <li class="sub-buton">
        <a href="index.php?user=admin&page=0&subPage=1&action='insert_tickets'">Nouveau tickets</a>
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
            case 'show_tickets':
              require_once("./vues/show/show_ticket.php");
              break;
            case 'insert_tickets':
              require_once("./vues/insert/insert_ticket.php");
              break;
          }
        }
      ?>
    </div>
  </div>
</section>