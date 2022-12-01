<h1>Administrateur</h1>
<center>
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
  <input type="submit" value="Connexion" name="Connexion" class="sub-buton">
</form>
<?php
  if(isset($_POST['Connexion'])){
    $id = $_POST['id'];
    $mdp = $_POST['mdp'];

    $unControleur -> setTable($role);
    $user = $unControleur -> autentification($id, $mdp);
    var_dump($user);
    $_SESSION = $user;
    header("location:index.php");
  }
?>
</center>