<h2>Modification d'un étudiant</h2>
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
        <input type="text" name="nom" id="nom" value=<?php echo $lEtudiant['nom']; ?> required>
      </td>
      <td>
        <label for="prenom">prenom : </label>
      </td>
      <td>
        <input type="text" name="prenom" id="prenom" value=<?php echo $lEtudiant['prenom']; ?> required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="classe">Classe : </label>
      </td>
      <td>
        <select name="classe" id="classe" required>
          <option value="<?php echo $lEtudiant['IdCl'] ?>">Choisir une classe</option>
          <?php
            for($i=0; $i<=count($lesClasses)-1; $i++){
              $uneClasse = $lesClasses[$i];
              echo "<option value=".$uneClasse['IdCl'].">".$uneClasse['nom']."</option>";
            }
          ?>
        </select>
      </td>
      <td>
        <label for="email">Email : </label>
      </td>
      <td>
        <input type="text" name="email" id="email" value=<?php echo $lEtudiant['email']; ?> required>
      </td>
    </tr>
      <td>
        <label for="tel">Telephone : </label>
      </td>
      <td>
        <input type="text" name="tel" id="tel" value=<?php echo $lEtudiant['telephone']; ?> placeholder="ex: 0612345678" required>
      </td>
      <td>
       <label for="addr">Adresse : </label>
      </td>
      <td>
        <input type="text" name="addr" id="addr" value=<?php echo $lEtudiant['adresse']; ?> placeholder="ex: 01 rue jean-baptist" required>
      </td>
    </tr>
  </table>
  <input type="submit" name="Modifier" value="Modifier" class="sub-buton">
</form>
</center>
