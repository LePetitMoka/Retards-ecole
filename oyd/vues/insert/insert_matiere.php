<h2>Nouvelle Matière</h2>
<center>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="intitule">Intitulé : </label>
      </td>
      <td>
        <input type="text" name="intitule" id="intitule" required>
      </td>
    </tr>
  </table>
  <input type="submit" name="Ajouter" value="Ajouter" class="sub-buton">
</form>
</center>
<?php
  if(isset($_POST['Ajouter'])){
    $_POST['intitule'] = "'".$_POST['intitule']."'";
    $ordre = "intitule";
    $valeurs = array("intitule"=>$_POST['intitule']);
    $unControleur -> setTable("Matiere");
    $unControleur -> insert($ordre, $valeurs);
  }
?>