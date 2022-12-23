<h2>Modifier l'identifiant de connexion</h2>
<center>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="oldId">Identifiant actuel (email)</label>
      </td>
      <td>
        <input type="text" name="oldId" id="oldId">
      </td>
    </tr>
    <tr>
      <td>
        <label for="newId">Nouvel identifiant (email)</label>
      </td>
      <td>
        <input type="text" name="newId" id="newId">
      </td>
    </tr>
    <tr>
      <td>
        <label for="confNewId">Confirmer</label>
      </td>
      <td>
        <input type="text" name="confNewId" id="confNewId">
      </td>
    </tr>
  </table>
  <input type="submit" name="ModifierI" value="Modifier" class="sub-buton">
</form>
</center>
<?php
  $unControleur = Connexion::getConnexion();
  if(isset($_POST['ModifierI'])){
    if(($_POST['oldId'] == $_SESSION['email']) && ($_POST['newId'] == $_POST['confNewId'])){
      $_POST['oldId'] = "'".$_POST['oldId']."'";
      $_POST['confNewId'] = "'".$_POST['confNewId']."'";
      $tableau = array("email" => $_POST['confNewId']);
      $unControleur -> setTable($_SESSION['role']);
      if($_SESSION['role'] == "administrateur"){
        $unControleur -> update_where($tableau, "IdAd", $_SESSION['id']);
      } elseif ($_SESSION['role'] == "professeur"){
        $unControleur -> update_where($tableau, "IdPf", $_SESSION['id']);
      } elseif ($_SESSION['role'] == "etudiant"){
        $unControleur -> update_where($tableau, "IdE", $_SESSION['id']);
      }
      echo "L identifiant de connexion a bien été modifié.";
      $_SESSION['email'] = $_POST['confNewId'];
    } else {
      echo "Les identifiants ne correspondent pas.";
    }
  }
?>