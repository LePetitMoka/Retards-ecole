<?php
  require_once("Element_display.class.php");

  class Show {
    private
    $unDisplay,
    $btnClass = '"sub-buton"',
    $inpClass = '"invisible"',
    $lesElements,
    $totEl,
    $nbEp,
    $totpg;

    public function __construct ($lesElements, $nbEpE){
      $this->lesElements = $lesElements;
      $this->nbEp = $nbEpE;
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
  
    public function setElements($lesElements){
      $this->lesElements -> $lesElements;
    }
    function showLoop($x, $y){
      if($x != $y){
        for($i=$x; $i<=$y; $i++){
          if($this->lesElements[$i] != null){
            $unElement = $this->lesElements[$i];
            $this->unDisplay -> display($unElement);
          } else {
            echo "Aucun resultat";
          }
        }
      } else {
        if(isset($this->lesElements[$x])){
          $unElement = $this->lesElements[$x];
          $this->unDisplay -> display($unElement);
        } else {
          echo "Aucun resultat";
        }
      }
    }

    public function loopConditions(){
      if($_SESSION['pg']>=1 && $_SESSION['pg']<$this->totpg){
        $a = ($_SESSION['pg']-1)*$this->nbEp;
        $b = $_SESSION['pg']*$this->nbEp-1;
        // echo "a = ".$a;
        // echo "b = ".$b;
        // echo "1";
        $this->showLoop($a, $b);
      } elseif($_SESSION['pg'] == $this->totpg){
        $b = $this->totEl-1;
        if($b <= 0){
          $b = 0;
        }
        if($b > 0){
          $a = $b - ($this->totEl - floor($this->totEl/$this->nbEp)*$this->nbEp);
          if($a < 0){
            $a = 0;
          }
        } else {   
          $a = $b;
        }
        // echo "a = ".$a;
        // echo "b = ".$b;
        // echo "2";
        $this->showLoop($a, $b);
      } elseif($_SESSION['pg']<1){
        $_SESSION['pg'] = 1;
        $a = ($_SESSION['pg']-1)*$this->nbEp;
        $b = $_SESSION['pg']*$this->nbEp-1;
        // echo "a = ".$a;
        // echo "b = ".$b;
        // echo "3";
        $this->showLoop($a, $b);
      } elseif($_SESSION['pg']>$this->totpg){
        $_SESSION['pg'] = $this->totpg;
        $b = $this->totEl-1;
        if($b <= 0){
          $b = 0;
        }
        if($b > 0){
          $a = $b - ($this->totEl - floor($this->totEl/$this->nbEp)*$this->nbEp);
          if($a < 0){
            $a = 0;
          }
        } else {   
          $a = $b;
        }
        // echo "a = ".$a;
        // echo "b = ".$b;
        // echo "4";
        $this->showLoop($a, $b);
      }
    }

    public function traitement ($filtre){
      if(isset($_POST['pre'])){
        $_SESSION['pg'] = $_SESSION['pg']-1;
        // require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
      } elseif (isset($_POST['sui'])){
        $_SESSION['pg'] = $_SESSION['pg']+1;
        // require_once("./vues/tableau_de_bord/admin/tdb-admin-InfoTrafic.php");
      }
      if(isset($_SESSION['pg'])){
        echo "<center>";
        // echo "<div class='show-content'>";
        $this->loopConditions();
        // echo "</div>";
        echo "<form method='post'>";
        if($_SESSION['pg']>1){
          echo "<label for='pre' class=".$this->btnClass.">Precedent</label>";
          echo "<input type='submit' name='pre' value='pre' id='pre' class=".$this->inpClass.">";
          if ($filtre !=""){
            echo "<input type='hidden' name='Filtrer' value='Filtrer'>";
            echo "<input type='hidden' name='filtre' value='".$_POST['filtre']."'>";
           
          }
        }

        if($_SESSION['pg']<$this->totpg){
          echo "<label for='sui' class=".$this->btnClass.">suivant</label>";
          echo "<input type='submit' name='sui' value='sui' id='sui' class=".$this->inpClass.">";
          if ($filtre !=""){
            echo "<input type='hidden' name='Filtrer' value='Filtrer'>";
            echo "<input type='hidden' name='filtre' value='".$_POST['filtre']."'>";
          }
        }
        echo "</form>";
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
