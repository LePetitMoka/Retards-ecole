<section class="role-choice">
  <div class="container">
    <form method="post">
      <div class="role-admin">
        <label for="admin">
          <img src="./img/icons colorées/administrateur.png">
          <p>Administrateur</p>
        </label>
        <input type="submit" name="role" value="administrateur" id="admin">
      </div>
      <div class="role-prof">
        <label for="prof">
          <img src="./img/icons colorées/professeur.png">
          <p>Professeur</p>
        </label>
        <input type="submit" name="role" value="professeur" id="prof">
      </div>
      <div class="role-etudiant">
        <label for="etudiant">
          <img src="./img/icons colorées/etudiant.png">
          <p>Etudiant</p>
        </label>
        <input type="submit" name="role" value="etudiant" id="etudiant">
      </div>
    </form>
  </div>
  <?php
    if(isset($_POST['role'])){
      $_SESSION['role'] = $_POST['role'];
      header("location:index.php");
    }
  ?>
</section>