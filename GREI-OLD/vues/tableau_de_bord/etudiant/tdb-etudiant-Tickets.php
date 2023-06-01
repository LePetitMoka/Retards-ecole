<h2>Retards</h2>
<center>
<section class="stats">
  <div class="container">
    <?php 
      $unControleur -> setTable("vue_totalbilleteleve");
      $lesInfos = $unControleur -> select_where("IdE", $_SESSION['id']);
    ?>
    <p>Nombre total de retards : <?php echo $lesInfos['nbBillets'] ?></p>
    <p>Durée total de retards : <?php echo $lesInfos['dureeCumulee'] ?></p>
  </div>
</section>
<?php
  require_once("./vues/show/show_tickets_etudiants.php");
?>
</center>