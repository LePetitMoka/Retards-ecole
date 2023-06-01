<section class="InfoTrafic">
  <div class="container">
    <ul class="minibar unstyled-list">
      <li class="sub-buton">
        <a href="index.php?user=admin&page=0&subPage=1&action=show_tickets">Liste des tickets</a>
      </li>
      <li class="sub-buton">
        <a href="index.php?user=admin&page=0&subPage=1&action=insert_tickets">Nouveau tickets</a>
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
          $action = 'show_tickets';
        }
        switch ($action) {
          case 'show_tickets':
            require_once("./vues/show/show_tickets.php");
            break;
          case 'insert_tickets':
            $unControleur -> setTable("Vue_Etudiant_Retard__SansBillet");
            $lesEtudiants = $unControleur -> select_all();
            require_once("./vues/insert/insert_ticket.php");
            break; 

          default :
            require_once("index.php?user=admin&page=0&subPage=1&action=show_tickets");
            break;
        }
      ?>
    </div>
  </div>
</section>