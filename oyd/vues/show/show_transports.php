<h2>Listes de tout les transports</h2>
<?php
  $unControleur -> setTable("transport");

  $lesTransports = $unControleur -> select_all();

  echo "<center>";
  echo "<table border='1'>";
  echo "<thead>";
  echo "<th>ID</th>";
  echo "<th>Ligne</th>";
  echo "<th>Type</th>";
  echo "<th>Trnasporteur</th>";
  echo "<th>Logo</th>";
  echo "</thead>";
  foreach ($lesTransports as $unTransport) {
    echo "<tr>";
    echo "<td>".$unTransport['IdTp']."</td>";
    echo "<td>".$unTransport['nom']."</td>";
    echo "<td>".$unTransport['type']."</td>";
    echo "<td>".$unTransport['transporteur']."</td>";
    echo "<td>".$unTransport['pictogramme']."</td>";
    echo "</tr>";
  }
  echo "</table>";
  echo "</center>";
?>