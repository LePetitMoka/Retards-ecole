<h2>Nouveau ticket</h2>
<center>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="dater">Date : </label>
      </td>
      <td>
        <input type="date" name="dater" id="dater" value=<?php echo date("J\N\Y"); ?> class="input-zone" required>
      </td>
      <td>
        <label for="dureer">Durée de retard : </label>
      </td>
      <td>
        <input type="time" name="dureer" id="dureer" required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="etud">Etudiant concerné : </label>
      </td>
      <td>
        <select name="etud" id="etud" required>
          <option>Choisir un étudiant</option>
          <!-- <?php
            for($i=0; $i<=count($lesClasses)-1; $i++){
              $uneClasse = $lesClasses[$i];
              echo "<option value=".$uneClasse['IdCl'].">".$uneClasse['nom']."</option>";
            }
          ?> -->
        </select>
      </td>
      <td>
        <label for="sign">Signature : </label>
      </td>
      <td>
        <label for="sign"><?php echo $_SESSION['nom']." ".$_SESSION['prenom'] ?></label>
      </td>
    </tr>
  </table>
  <input type="submit" name="Ajouter" value="Ajouter" class="sub-buton">
</form>
</center>