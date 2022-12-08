<h2>Liste des professeur</h2>
<?php
  require_once ("show.class.php");

  $unControleur -> setTable("professeur");
  $lesProfesseurs = $unControleur -> select_all();
  $leType = "professeur";
  $unShow = new Show($lesProfesseurs);
  $unShow->setType($leType);
  $unShow->traitement(); 
?>