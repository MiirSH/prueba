<?php
require 'server.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//nos traemos el form
        $name = $_POST["nombre"];
        $lastname = $_POST["apellidos"];
        $email = $_POST["email"];

        $sql = "INSERT INTO guests (firstname, lastname, email)
                VALUES ('$name', '$lastname', '$email')";

        $conn->exec($sql);

        $mensaje = "Registro creado correctamente.";
    }

} catch (PDOException $e) {
    $mensaje = "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
</head>
<body>

<?php require 'nav.html'; ?>

<?php
if (isset($mensaje)) {
    echo "<p>$mensaje</p>";
}
?>

<form action="" method="post">

    <label>Nombre:</label><br>
    <input type="text" name="nombre"><br>

    <label>Apellido:</label><br>
    <input type="text" name="apellidos"><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <button type="submit">Enviar</button>

</form>

</body>
</html>