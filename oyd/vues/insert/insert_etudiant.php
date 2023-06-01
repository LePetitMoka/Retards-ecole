<h2>Nouveau étudiant</h2>
<?php
  $unControleur -> setTable("Classe");
  $lesClasses = $unControleur -> select_all();
?>
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
        <label for="classe">Classe : </label>
      </td>
      <td>
        <select name="classe" id="classe" required>
          <option>Choisir une classe</option>
          <?php
            for($i=0; $i<=count($lesClasses)-1; $i++){
              $uneClasse = $lesClasses[$i];
              echo "<option value=".$uneClasse['IdCl'].">".$uneClasse['nom']."</option>";
            }
          ?>
        </select>
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
  <input type="submit" name="Ajouter" value="Ajouter" class="sub-buton">
</form>
</center>
<?php
  if(isset($_POST['Ajouter'])){
    $_POST['nom'] = "'".$_POST['nom']."'";
    $_POST['prenom'] = "'".$_POST['prenom']."'";
    $_POST['tel'] = "'".$_POST['tel']."'";
    $_POST['email'] = "'".$_POST['email']."'";
    $_POST['addr'] = "'".$_POST['addr']."'";
    $_POST['mdp'] = "'".$_POST['mdp']."'";
    $ordre = "IdE, nom, prenom, telephone, adresse, email, mdp, IdCl";
    $valeurs = array("IdE"=>$_POST['id'], "nom"=>$_POST['nom'], "prenom"=>$_POST['prenom'], "telephone"=>$_POST['tel'], "adresse"=>$_POST['addr'], "email"=>$_POST['email'], "mdp"=>$_POST['mdp'], "IdCl"=>$_POST['classe']);
    $unControleur -> setTable("Etudiant");
    $unControleur -> insert($ordre, $valeurs);
  }
?>