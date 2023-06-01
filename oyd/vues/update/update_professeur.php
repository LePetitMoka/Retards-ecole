<h2>Modification d'un professeur</h2>
<?php
  $unControleur -> setTable("Professeur");
?>
<center>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="nom">Nom : </label>
      </td>
      <td>
        <input type="text" name="nom" id="nom" value=<?php echo $leProfesseur['nom']; ?> required>
      </td>
      <td>
        <label for="prenom">prenom : </label>
      </td>
      <td>
        <input type="text" name="prenom" id="prenom" value=<?php echo $leProfesseur['prenom']; ?> required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="diplome">Diplome : </label>
      </td>
      <td>  
        <input type="text" name="diplome" id="diplome" value=<?php echo $leProfesseur['diplome']; ?> required>
      </td>
      <td>
        <label for="email">Email : </label>
      </td>
      <td>
        <input type="text" name="email" id="email" value=<?php echo $leProfesseur['email']; ?> required>
      </td>
    </tr>
      <td>
        <label for="tel">Telephone : </label>
      </td>
      <td>
        <input type="text" name="tel" id="tel" value=<?php echo $leProfesseur['telephone']; ?> placeholder="ex: 0612345678" required>
      </td>
      <td>
       <label for="addr">Adresse : </label>
      </td>
      <td>
        <input type="text" name="addr" id="addr" value=<?php echo $leProfesseur['adresse']; ?> placeholder="ex: 01 rue jean-baptist" required>
      </td>
    </tr>
  </table>
  <input type="submit" name="Modifier" value="Modifier" class="sub-buton">
</form>
</center>
