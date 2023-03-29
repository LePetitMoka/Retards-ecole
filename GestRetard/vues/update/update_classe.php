<h2>Modification d'une classe</h2>
<?php
  $unControleur -> setTable("Classe");
?>
<center>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="nom">Nom : </label>
      </td>
      <td>
        <input type="text" name="nom" id="nom" value=<?php echo $laClasse['nom']; ?> required>
      </td>
      <td>
        <label for="promotion">Promotion : </label>
      </td>
      <td>
        <input type="text" name="promotion" id="promotion" value=<?php echo $laClasse['promotion']; ?> placeholder="ex: 20XX/20YY">
      </td>
    </tr>
    <tr>
      <td>
        <label for="email">Email : </label>
      </td>
      <td>
        <input type="text" name="email" id="email" value=<?php echo $laClasse['email']; ?> placeholder="ex: exemple@iris.fr" required>
      </td>
      <td>
        <label for="dipprepre">dipprelome preparé : </label>
      </td>
      <td>
        <input type="text" name="dipprepre" value=<?php echo $laClasse['diplomePrepare']; ?> id="dipprepre">
      </td>
    </tr>
  </table>
  <input type="submit" name="Modifier" value="Modifier" class="sub-buton">
</form>
</center>
