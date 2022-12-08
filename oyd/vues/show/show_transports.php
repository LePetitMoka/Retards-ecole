<h2>Listes de tout les transports</h2>
<?php
  require_once ("show.class.php");

  $unControleur -> setTable("transport");
  if(isset($_POST['Filtrer'])){
    $filtre = $_POST['filtre'];
    $lesAttributs = array("IdTp", "nom", "type", "transporteur");
    $lesTransports = $unControleur -> select_filter($filtre, $lesAttributs);
  } else {
    $lesTransports = $unControleur -> select_all();
  }
  $leType = "transport";
  $unShow = new Show($lesTransports);
  $unShow->setType($leType);
  $unShow->traitement(); 
?>
<!-- <script>
  alert("page <?php echo $_SESSION['pg']; ?>");
</script> -->