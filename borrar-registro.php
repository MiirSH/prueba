<?php
require 'server.php';
require 'nav.html';

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
  die("Could not connect. " . $e->getMessage());
}

try {
  // SQL to delete a record
  $sql = "DELETE FROM guests WHERE id=" . $_GET['id'];
 $stmt = $conn->prepare($sql);
  echo "Invitado borrado exitosamente";
    $stmt->execute();
} catch(PDOException $e) {
  echo "Error deleting record: " .$sql . "<br>" . $e->getMessage();
}

$conn = null;

$stmt = null;
?>
