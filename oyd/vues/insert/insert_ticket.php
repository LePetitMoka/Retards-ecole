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
          <?php
            for($i=0; $i<=count($lesEtudiants)-1; $i++){
              $unEtudiant = $lesEtudiants[$i];
              echo "<option value=".$unEtudiant['IdE'].">".$unEtudiant['nom']."</option>";
            }
          ?>
        </select>
      </td>
      <td>
        <label for="sign">Signature : </label>
      </td>
      <td>
        <label for="sign"><?php echo $_SESSION['nom']." ".$_SESSION['prenom'] ?></label>
        <input type="hidden" name="sign" value=<?php echo $_SESSION['nom']." ".$_SESSION['prenom'] ?>>
        <input type="hidden" name="admin" value=<?php echo $_SESSION['id'] ?>>
      </td>
    </tr>
  </table>
  <input type="submit" name="Ajouter" value="Ajouter" class="sub-buton">
</form>
</center>
<?php
  if(isset($_POST['Ajouter'])){
    $_POST['dater'] = "'".$_POST['dater']."'";
    $_POST['sign'] = "'".$_POST['sign']."'";
    $_POST['dureer'] = "'".$_POST['dureer'].":00'";
    $ordre = "dateb, dureeRetard, URLSignature, IdE, IdAd";
    $valeurs = array("dateb" => $_POST['dater'], "dureeRetard" => $_POST['dureer'], "sign" => $_POST['sign'], "IdE" => $_POST['etud'], "IdAd" => $_POST['admin']);
    $unControleur -> setTable("billet");
    $unControleur -> insert($ordre, $valeurs);
  }
?>