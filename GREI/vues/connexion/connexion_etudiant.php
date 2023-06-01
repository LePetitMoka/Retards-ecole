<center>
<h1>Etudiant</h1>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="id">Email :</label>
      </td>
      <td>
        <input type="text" name="id" id="id">
      </td>
    </tr>
    <tr>
      <td>
        <label for="mdp">Mot de passe :</label>
      </td>
      <td>
        <input type="password" name="mdp" id="mdp">
      </td>
    </tr>
  </table>
  <input type="submit" value="Connexion" name="Connexion" class="inv-buton">
  <input type="submit" value="Annuler" name="Annuler" class="buton">
  <input type="submit" value="Connexion" name="Connexion" class="buton">
</form>
<?php
  if(isset($_POST['Connexion'])){
    $id = $_POST['id'];
    $mdp = sha1($_POST['mdp']);

    $unControleur -> setTable($_SESSION['role']);
    $user = $unControleur -> autentification($id, $mdp);
    if($user == null){
      echo "<br/>Assurez vous d'étre ".$_SESSION['role'];
      echo "<br/>et vérifiez vos Identifiants<br/>";
    } else {
      $_SESSION['id'] = $user['IdE'];
      $_SESSION['nom'] = $user['nom'];
      $_SESSION['prenom'] = $user['prenom'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['telephone'] = $user['telephone'];
      $_SESSION['mdp'] = $user['mdp'];
      $_SESSION['adresse'] = $user['adresse'];
      $_SESSION['IdCl'] = $user['IdCl'];
      header("location:index.php");
    }
  }
  if(isset($_POST['Annuler'])){
    unset($_SESSION['role']);
    header("location:index.php");
  }
?>
</center>