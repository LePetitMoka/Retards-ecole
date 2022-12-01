<h1>Messagerie</h1>
<section class="subnavbar">
  <div class="container">
    <div class="submenu">
      <ul class="submenu-list unstyled-list">
        <li><a href="index.php?user=admin&page=2&subPage=0" class="buton">Messages</a></li>
        <li><a href="index.php?user=admin&page=2&subPage=1" class="buton">Nouveau message</a></li>
        <li><a href="index.php?user=admin&page=2&subPage=2" class="buton">Nouveau canal</a></li>
      </ul>
    </div>
  </div>
</section>
<section class="tdb-content">
  <div class="container">
    <?php
      if(isset($_GET['subPage'])){
        $subPage = $_GET['subPage'];
      } else {
        $subPage = 0;
      }
      switch ($subPage) {
        case 0:
          require_once("./vues/show/show_messages.php");
          break;
        case 1:
          require_once("./vues/insert/insert_message.php");
          break;
        case 2:
          require_once("./vues/insert/insert_canal.php");
          break;
        
        default:
        require_once("index.php?user=admin&page=2");
          break;
      }
    ?>
  </div>
</section>