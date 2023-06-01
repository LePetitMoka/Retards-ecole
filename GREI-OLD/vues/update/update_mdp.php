<h2>Modifier le mot de passe</h2>
<center>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="oldMdp">Mot de passe Actuel</label>
      </td>
      <td>
        <input type="text" name="oldMdp" id="oldMdp">
      </td>
    </tr>
    <tr>
      <td>
        <label for="newMdp">Nouvau mot de passe</label>
      </td>
      <td>
        <input type="text" name="newMdp" id="newMdp">
      </td>
    </tr>
    <tr>
      <td>
        <label for="confNewMdp">Comfirmer</label>
      </td>
      <td>
        <input type="text" name="confNewMdp" id="confNewMdp">
      </td>
    </tr>
  </table>
  <input type="submit" name="ModifierM" value="Modifier" class="sub-buton">
</form>
</center>
<?php
  $unControleur = Connexion::getConnexion();
  if(isset($_POST['ModifierM'])){
    if(($_POST['oldMdp'] == $_SESSION['mdp']) && ($_POST['newMdp'] == $_POST['confNewMdp'])){
      $_POST['oldMdp'] = "'".$_POST['oldMdp']."'";
      $_POST['confNewMdp'] = "'".$_POST['confNewMdp']."'";
      $tableau = array("mdp" => $_POST['confNewMdp']);
      $unControleur -> setTable($_SESSION['role']);
      if($_SESSION['role'] == "administrateur"){
        $unControleur -> update_where($tableau, "IdAd", $_SESSION['id']);
      } elseif ($_SESSION['role'] == "professeur"){
        $unControleur -> update_where($tableau, "IdPf", $_SESSION['id']);
      } elseif ($_SESSION['role'] == "etudiant"){
        $unControleur -> update_where($tableau, "IdE", $_SESSION['id']);
      }
      echo "Le mot de pass a bien été modifié.";
      $_SESSION['mdp'] = $_POST['confNewMdp'];
    } else {
      echo "Les mots de pass ne correspondent pas.";
    }
  }
?>