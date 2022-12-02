<center>
<h1>Administrateur</h1>
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
  <input type="submit" value="Connexion" name="Connexion" class="buton">
</form>
<?php
  if(isset($_POST['Connexion'])){
    $id = $_POST['id'];
    $mdp = $_POST['mdp'];

    $unControleur -> setTable($_SESSION['role']);
    $user = $unControleur -> autentification($id, $mdp);
    if($user == null){
      echo "<br/>Vérifiez vos Identifiants<br/>";
    } else {
      $_SESSION['id'] = $user['IdAd'];
      $_SESSION['nom'] = $user['nom'];
      $_SESSION['prenom'] = $user['prenom'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['telephone'] = $user['telephone'];
      $_SESSION['mdp'] = $user['mdp'];
      $_SESSION['adresse'] = $user['adresse'];
      header("location:index.php");
    }
  }
?>
</center>