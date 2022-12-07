<?php
 
  class Show {
    private  
  // 1963
  $tabClass = '"show-table"',
  $btnClass = '"sub-buton"',
  $inpClass = '"invisible"',
  $classFull = '"full"',
  $classPartial = '"partial"',
  $stateClass = '"state"',
  $lesElements,
  $totEl,
  $nbEp = 10,
  $totpg ;

  public function __construct ($lesElements){
    $this->lesElements = $lesElements ;
    $this->totEl = count($lesElements);
    $this->totpg = floor($this->totEl/$this->nbEp);
    if ($this->totEl%$this->nbEp > 0){
      $this->totpg ++;
    }
  }
 
  function showLoop($x, $y){
    for($i=$x; $i<=$y; $i++){
      $unElement = $this->lesElements[$i];
      echo "<table class=".$this->tabClass.">";
      echo "<tr>";
      echo "<td rowspan='2' class=".$this->classFull."><img src='".$unElement['pictogramme']."' width='100' height='100'></td>";
      echo "<td class=".$this->classPartial.">".$unElement['type']." ".$unElement['nom']."</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class=".$this->classPartial."> Géré par : ".$unElement['transporteur']."</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class=".$this->classFull.">".$unElement['type']."</td>";
      echo "<td class=".$this->stateClass.">Etat : fluide</td>";
      echo "</tr>";
      echo "</table>";
    }
  }

  public function loopConditions(){
    if($_SESSION['pg']>=1 && $_SESSION['pg']<$this->totpg){
      $a = ($_SESSION['pg']-1)*$this->nbEp;
      $b = $_SESSION['pg']*$this->nbEp-1;
      $this->showLoop($a, $b);
    } elseif($_SESSION['pg'] == $this->totpg){
      $b = $this->totEl;
      $a = $b - ($this->totEl - floor($this->totEl/$this->nbEp)*$this->nbEp);
      $this->showLoop($a, $b);
    } elseif($_SESSION['pg']<1){
      $_SESSION['pg'] = 1;
      $a = ($_SESSION['pg']-1)*$this->nbEp;
      $b = $_SESSION['pg']*$this->nbEp-1;
    } elseif($_SESSION['pg']>$this->totpg){
      $_SESSION['pg'] = $this->totpg;
      $b = $this->totEl;
      $a = $b - ($this->totEl - floor($this->totEl/$this->nbEp)*$this->nbEp);
      $this->showLoop($a, $b);
    }
  }

  public function traitement (){
    if(isset($_SESSION['pg'])){
      echo "<center>";
      // echo "<div class='show-content'>";
      $this->loopConditions();
      // echo "</div>";
      echo "<form method='post'>";
      if($_SESSION['pg']>1){
        echo "<label for='pre' class=".$this->btnClass.">Precedent</label>";
        echo "<input type='submit' name='pre' value='pre' id='pre' class=".$this->inpClass.">";
      }

      if($_SESSION['pg']<$this->totpg){
        echo "<label for='sui' class=".$this->btnClass.">suivant</label>";
        echo "<input type='submit' name='sui' value='sui' id='sui' class=".$this->inpClass.">";
      }
      echo "</form>";
      if(isset($_POST['pre'])){
        $_SESSION['pg'] = $_SESSION['pg']-1;
        // require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
      } elseif (isset($_POST['sui'])){
        $_SESSION['pg'] = $_SESSION['pg']+1;
        // require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
      }
      echo "<p>page ".$_SESSION['pg']."/".$this->totpg."</p>";
      echo "</center>";
    } else {
      $_SESSION['pg'] = 1;
      echo "<center>";
      // echo "<div class='show-content'>";
      $this->loopConditions();
      // echo "</div>";
      echo "<form method='post'>";
      if($_SESSION['pg']>1){
        echo "<label for='pre' class=".$this->btnClass.">Precedent</label>";
        echo "<input type='submit' name='pre' value='pre' id='pre' class=".$this->inpClass.">";
      }
      echo "<p>page ".$_SESSION['pg']." tot:".$this->totpg."</p>";
      if($_SESSION['pg']<$this->totpg){
        echo "<label for='sui' class=".$this->btnClass.">suivant</label>";
        echo "<input type='submit' name='sui' value='sui' id='sui' class=".$this->inpClass.">";
      }
      echo "</form>";
      /*if(isset($_POST['pre'])){
        $_SESSION['pg'] = $_SESSION['pg']-1;
        // require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
      } elseif (isset($_POST['sui'])){
        $_SESSION['pg'] = $_SESSION['pg']+1;
        // require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
      }*/
      echo "<p>page ".$_SESSION['pg']."/".$this->totpg."</p>";
      echo "</center>";
    }
  }
}
?>
