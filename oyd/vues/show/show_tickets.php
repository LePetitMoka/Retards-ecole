<h2>Liste des ticket</h2>
<?php
  require_once ("show.class.php");

  $unControleur -> setTable("billet");
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
  $unShow = new Show($lesTickets);
  $unShow->setType($leType);
  $unShow->traitement($filtre); 
?>