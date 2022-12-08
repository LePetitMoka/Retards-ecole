<h2>Liste des ticket</h2>
<?php
  require_once ("show.class.php");

  $unControleur -> setTable("billet");
  $lesTickets = $unControleur -> select_all();
  $leType = "ticket";
  $unShow = new Show($lesTickets);
  $unShow->setType($leType);
  $unShow->traitement(); 
?>