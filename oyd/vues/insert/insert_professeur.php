<h2>Nouveau professeur</h2>
<center>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="nom">Nom : </label>
      </td>
      <td>
        <input type="text" name="nom" id="nom" required>
      </td>
      <td>
        <label for="prenom">prenom : </label>
      </td>
      <td>
        <input type="text" name="prenom" id="prenom" required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="dip">Diplome : </label>
      </td>
      <td>
        <input type="text" name="dip" id="dip" required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="email">Email : </label>
      </td>
      <td>
        <input type="text" name="email" id="email" placeholder="ex: exemple@iris.fr" required>
      </td>
      <td>
        <label for="mdp">Mot de passe : </label>
      </td>
      <td>
        <input type="text" name="mdp" id="mdp" required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="tel">Telephone : </label>
      </td>
      <td>
        <input type="text" name="tel" id="tel" placeholder="ex: 0612345678" required>
      </td>
      <td>
        <label for="addr">Adresse : </label>
      </td>
      <td>
        <input type="text" name="addr" id="addr" placeholder="ex: 01 rue jean-baptist" required>
      </td>
    </tr>
  </table>
  <input type="hidden" name="id" value="null">
  <input type="submit" name="Ajouter" value="Ajouter" class="sub-buton" required>
</form>
</center>
<?php
  if(isset($_POST['Ajouter'])){
    $_POST['nom'] = "'".$_POST['nom']."'";
    $_POST['prenom'] = "'".$_POST['prenom']."'";
    $_POST['dip'] = "'".$_POST['dip']."'";
    $_POST['tel'] = "'".$_POST['tel']."'";
    $_POST['email'] = "'".$_POST['email']."'";
    $_POST['addr'] = "'".$_POST['addr']."'";
    $_POST['mdp'] = "'".$_POST['mdp']."'";
    $ordre = "IdPf, nom, prenom, diplome, telephone, adresse, email, mdp";
    $valeurs = array("IdPf"=>$_POST['id'], "nom"=>$_POST['nom'], "prenom"=>$_POST['prenom'], "dip"=>$_POST['dip'], "telephone"=>$_POST['tel'], "adresse"=>$_POST['addr'], "email"=>$_POST['email'], "mdp"=>$_POST['mdp']);
    $unControleur -> setTable("Professeur");
    $unControleur -> insert($ordre, $valeurs);
  }
?>