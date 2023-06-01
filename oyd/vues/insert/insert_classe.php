<h2>Nouvelle classe</h2>
<center>
<form method="post">
  <table>
    <tr>
      <td>
        <label for="nom">Nom : </label>
      </td>
      <td>
        <input type="text" name="nom" id="nom">
      </td>
      <td>
        <label for="promotion">Promotion : </label>
      </td>
      <td>
        <input type="text" name="promotion" id="promotion" placeholder="ex: 20XX/20YY">
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
        <label for="dipprepre">dipprelome preparé : </label>
      </td>
      <td>
        <input type="text" name="dipprepre" id="dipprepre">
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
    $_POST['promotion'] = "'".$_POST['promotion']."'";
    $_POST['dipprepre'] = "'".$_POST['dipprepre']."'";
    $_POST['email'] = "'".$_POST['email']."'";
    $ordre = "IdCl, nom, promotion, diplomePrepare, email";
    $valeurs = array("IdCl"=>$_POST['id'], "nom"=>$_POST['nom'], "promotion"=>$_POST['promotion'], "dipprepre"=>$_POST['dipprepre'], "email"=>$_POST['email']);
    $unControleur -> setTable("Classe");
    $unControleur -> insert($ordre, $valeurs);
  }
?>