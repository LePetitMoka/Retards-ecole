<h2>Retards</h2>
<center>
<section class="stats">
  <div class="container">
    <?php 
      $lesInfos = array();
      $unControleur -> setTable("Vue_TotalBilletEleve");
      $lesInfos = $unControleur -> select_where("IdE", $_SESSION['id']);
      if($lesInfos == false){
        $lesInfos['nbBillets'] = 0;
        $lesInfos['dureeCumulee'] = "00:00:00";
      }
    ?>
    <p>Nombre total de retards : <?php echo $lesInfos['nbBillets'] ?></p>
    <p>Durée total de retards : <?php echo $lesInfos['dureeCumulee'] ?></p>
  </div>
</section>
<?php
  require_once("./vues/show/show_tickets_etudiants.php");
?>
</center>