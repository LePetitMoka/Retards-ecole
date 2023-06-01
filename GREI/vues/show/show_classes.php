<h2>Liste des classes</h2>
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

  $unControleur -> setTable("Classe");
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
    $lesAttributs = array("IdCl", "nom", "nbEtudiants", "email", "diplomePrepare", "promotion");
    $lesClasses = $unControleur -> select_filter($filtre, $lesAttributs);
   
  } else {
    $lesClasses = $unControleur -> select_all();
  }
  $leType = "classe";
  $unShow = new Show($lesClasses, $_SESSION['nbep']);
  $unShow->setType($leType);
  $unShow->traitement($filtre); 
?>