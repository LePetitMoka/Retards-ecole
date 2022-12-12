<h2>Liste des classes</h2>
<?php
  require_once ("show.class.php");

  $unControleur -> setTable("classe");
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
    $lesAttributs = array("IdCl", "nom", "nbEtudiants", "email");
    $lesClasses = $unControleur -> select_filter($filtre, $lesAttributs);
   
  } else {
    $lesClasses = $unControleur -> select_all();
  }
  $leType = "classe";
  $unShow = new Show($lesClasses);
  $unShow->setType($leType);
  $unShow->traitement($filtre); 
?>