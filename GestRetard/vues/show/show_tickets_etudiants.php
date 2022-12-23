<h2>Liste des tickets</h2>
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

  $unControleur -> setTable("billet");
  $filtre = "";
  $lesTickets = $unControleur -> select_where_all("IdE", $_SESSION['id']);
  $leType = "ticket";
  $unShow = new Show($lesTickets, $_SESSION['nbep']);
  $unShow->setType($leType);
  $unShow->traitement($filtre); 
?>