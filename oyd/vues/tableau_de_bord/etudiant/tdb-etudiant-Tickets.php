<h2>Retards</h2>
<center>
<section class="stats">
  <div class="container">
    <?php 
      $unControleur -> setTable("billet");
      $lesTickets = $unControleur -> select_where_all("IdE", $_SESSION['id']);
      $nbret = count($lesTickets);
      // foreach($lesTickets as $unTicket){
      //   $dureeTot;
      //   var_dump($unTicket);
      // }
    ?>
    <p>Nombre total de retards : <?php echo $nbret ?>
    </p>
    <!-- <p>Durée total de retards : </p> -->
  </div>
</section>
<?php
  require_once("./vues/show/show_tickets_etudiants.php");
?>
</center>