<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?></title>

    <link rel="stylesheet" href="styles.css">
</head>
<body>





<?php

require 'server.php';
require 'nav.html';

/*Estamos sacando la tabla con los datos*/


try {
  $conn = new PDO("mysql:host=$servername;port=3307;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
  die("Could not connect. " . $e->getMessage());
}

try {
  $sql = "SELECT id, firstname, lastname, email FROM guests";
  // Execute the SQL query
  $result = $conn->query($sql);
  // Process the result set
  if ($result->rowCount() > 0) {
    echo "<table><tr><th>ID</th><th>Firstname</th><th>Lastname</th><th>E-mail</th></tr>";
    // Output data of each row
    while($row = $result->fetch()) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['firstname'] . "</td>";
      echo "<td>" . $row['lastname'] . "</td>";
       echo "<td>" . $row['email'] . "</td>";

       echo "<td><a href='borrar-registro.php?id=" . $row['id'] . "'>Borrar</a></td>";  
       echo "<td><a href='editar-registro.php?id=" . $row['id'] . "'>Editar</a></td>";
       
        echo "</tr>";

   
    }
    echo "</table>";
    unset($result);
  } else {
    echo "No se han encontrado resultados.";
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}






$conn = null;
?>

</body>
</html>