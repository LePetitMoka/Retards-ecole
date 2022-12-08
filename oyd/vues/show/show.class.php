<?php
  require_once("Element_display.class.php");

  class Show {
    private
    $unDisplay,
    $btnClass = '"sub-buton"',
    $inpClass = '"invisible"',
    $lesElements,
    $totEl,
    $nbEp = 10,
    $totpg;

    public function __construct ($lesElements){
      $this->lesElements = $lesElements ;
      $this->unDisplay = new Display;
      $this->totEl = count($lesElements);
      $this->totpg = floor($this->totEl/$this->nbEp);
      if ($this->totEl%$this->nbEp > 0){
        $this->totpg ++;
      }
    }

    public function setType($leType){
      $this->unDisplay -> setType($leType);
    }
  
    function showLoop($x, $y){
      if($x != $y){
        for($i=$x; $i<=$y; $i++){
          $unElement = $this->lesElements[$i];
          $this->unDisplay -> display($unElement);
        }
      } else {
        $unElement = $this->lesElements[$x];
        $this->unDisplay -> display($unElement);
      }
    }

    public function loopConditions(){
      if($_SESSION['pg']>=1 && $_SESSION['pg']<$this->totpg){
        $a = ($_SESSION['pg']-1)*$this->nbEp;
        $b = $_SESSION['pg']*$this->nbEp-1;
        $this->showLoop($a, $b);
      } elseif($_SESSION['pg'] == $this->totpg){
        $b = $this->totEl-1;
        if($b > 0){
          $a = $b - ($this->totEl - floor($this->totEl/$this->nbEp)*$this->nbEp);
          if($a < 0){
            $a = 0;
          }
        } else {   
          $a = $b;
        }
        $this->showLoop($a, $b);
      } elseif($_SESSION['pg']<1){
        $_SESSION['pg'] = 1;
        $a = ($_SESSION['pg']-1)*$this->nbEp;
        $b = $_SESSION['pg']*$this->nbEp-1;
      } elseif($_SESSION['pg']>$this->totpg){
        $_SESSION['pg'] = $this->totpg;
        $b = $this->totEl-1;
        if($b > 0){
          $a = $b - ($this->totEl - floor($this->totEl/$this->nbEp)*$this->nbEp);
          if($a < 0){
            $a = 0;
          }
        } else {   
          $a = $b;
        }
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
