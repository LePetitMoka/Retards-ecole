<section class="role-choice">
  <div class="container">
    <form method="post">
      <div class="roles">
        <div class="role-admin">
          <label for="admin">
            <img src="./img/icons_colorees/administrateur.png">
            <p>Administrateur</p>
          </label>
          <input type="submit" name="role" value="administrateur" id="admin" class="invisible">
        </div>
        <div class="role-prof">
          <label for="prof">
            <img src="./img/icons_colorees/professeur.png">
            <p>Professeur</p>
          </label>
          <input type="submit" name="role" value="professeur" id="prof" class="invisible">
        </div>
        <div class="role-etudiant">
          <label for="etudiant">
            <img src="./img/icons_colorees/etudiant.png">
            <p>Etudiant</p>
          </label>
          <input type="submit" name="role" value="etudiant" id="etudiant" class="invisible">
        </div>
      </div>
      <div class="options">
        <input type="submit" value="Retourner à l'acceuil" name="AConnexion" class="buton">
        <input type="submit" value="Créer un compte" name="NCompte" class="buton">
      <div>
    </form>
  </div>
  <?php
    if(isset($_POST['role'])){
      $_SESSION['role'] = $_POST['role'];
      header("location:index.php");
    }
  ?>
</section>