<h2>Listes de tout les transports</h2>
<?php
  require_once ("show.class.php");

  $unControleur -> setTable("transport");
  $filtre = ""; 
  if(isset($_POST['Filtrer'])){
    $filtre = $_POST['filtre'];
    if (isset($_SESSION['filtre']) && (isset($_POST['sui']) || isset($_POST['pre']))){
      if($filtre != $_SESSION['filtre']){
        $_SESSION['pg'] = 1; 
      }
    }else {
      $_SESSION['pg'] =1; 
      $_SESSION['filtre'] = $filtre;
    }
    $lesAttributs = array("IdTp", "nom", "type", "transporteur");
    $lesTransports = $unControleur -> select_filter($filtre, $lesAttributs);
   
  } else {
    $lesTransports = $unControleur -> select_all();
  }
  $leType = "transport";
  $unShow = new Show($lesTransports);
  $unShow->setType($leType);
  $unShow->traitement($filtre); 
?>
<!-- <script>
  alert("page <?php echo $_SESSION['pg']; ?>");
</script> -->