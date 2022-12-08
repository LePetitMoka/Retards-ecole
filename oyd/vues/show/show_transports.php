<h2>Listes de tout les transports</h2>
<?php
  require_once ("show.class.php");

  $unControleur -> setTable("transport");
  $lesTransports = $unControleur -> select_all();
  $leType = "transport";
  $unShow = new Show($lesTransports);
  $unShow->setType($leType);
  $unShow->traitement(); 
?>
<!-- <script>
  alert("page <?php echo $_SESSION['pg']; ?>");
</script> -->