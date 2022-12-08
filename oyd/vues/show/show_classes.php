<h2>Liste des classes</h2>
<?php
  require_once ("show.class.php");

  $unControleur -> setTable("classe");
  $lesClasses = $unControleur -> select_all();
  $leType = "classe";
  $unShow = new Show($lesClasses);
  $unShow->setType($leType);
  $unShow->traitement(); 
?>