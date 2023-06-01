<br/>
<center>
<form method="post">
  <label for="nbep">Nombre d'éléments par page : </label>
  <input type="numbre" name="nbep" id="nbep" required>
  <input type="submit" name="Changer" value="Changer" class="sub-buton">
</form>
</center>
<br/>
<?php
  require_once ("show.class.php");

  if(isset($_POST['Changer'])){
    $_SESSION['nbep'] = $_POST['nbep'];
  }

  if(!isset($_SESSION['nbep'])){
    $_SESSION['nbep'] = 10;
  }

  $unControleur -> setTable("Billet");
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
    $lesAttributs = array("dateB", "dureeRetard", "URLSignature", "IdAd", "IdE");
    $lesTickets = $unControleur -> select_filter($filtre, $lesAttributs);
   
  } else {
    $lesTickets = $unControleur -> select_all();
  }
  $leType = "ticket";
  $unShow = new Show($lesTickets, $_SESSION['nbep']);
  $unShow->setType($leType);
  $unShow->traitement($filtre); 
?>