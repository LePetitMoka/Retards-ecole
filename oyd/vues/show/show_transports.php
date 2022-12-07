<h2>Listes de tout les transports</h2>
<?php
  require_once ("show_T.class.php");

  $unControleur -> setTable("transport");
  $lesTransports = $unControleur -> select_all();
  
  $unShow = new Show($lesTransports);

  $unShow->traitement (); 
?>
<script>
  alert("page <?php echo $_SESSION['pg']; ?>");
</script>