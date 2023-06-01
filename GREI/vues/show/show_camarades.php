<h2>Liste des camarades</h2>
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

  $unControleur -> setTable("Etudiant");
  $filtre = ""; 
  $lesEtudiants = $unControleur -> select_where_all("IdCl", $_SESSION['IdCl']);
  $leType = "etudiant-lite";
  $unShow = new Show($lesEtudiants, $_SESSION['nbep']);
  $unShow->setType($leType);
  $unShow->traitement($filtre);
?>