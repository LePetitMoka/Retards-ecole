<h2>Liste des étudiants</h2>
<?php
  require_once ("show.class.php");

  $unControleur -> setTable("etudiant");
  $lesEtudiants = $unControleur -> select_all();
  $leType = "etudiant";
  $unShow = new Show($lesEtudiants);
  $unShow->setType($leType);
  $unShow->traitement(); 
?>