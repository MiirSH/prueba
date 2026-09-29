<?php
require 'server.php';
require 'nav.html';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//creamos la consulta
    $sql = "UPDATE guests
            SET firstname = :firstname,
                lastname = :lastname,
                email = :email
            WHERE id = :id";

//revisa la consulta
    $stmt = $conn->prepare($sql);

//se sustituyen los parametros con los que escribimos en el form
    $stmt->execute([
        ':firstname' => $_POST['firstname'],
        ':lastname'  => $_POST['lastname'],
        ':email'     => $_POST['email'],
        ':id'        => $_POST['id']
    ]);

    echo "Registro actualizado correctamente.";
}

// Obtener los datos del registro
$stmt = $conn->prepare("SELECT * FROM guests WHERE id = :id");
$stmt->execute([':id' => $_GET['id']]);

//devuelve el resultado
$guest = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<form method="post">

    <input type="hidden" name="id" value="<?= $guest['id'] ?>">

    <label>Nombre</label><br>
    <input type="text" name="firstname" value="<?= $guest['firstname'] ?>"><br><br>

    <label>Apellido</label><br>
    <input type="text" name="lastname" value="<?= $guest['lastname'] ?>"><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?= $guest['email'] ?>"><br><br>

    <button type="submit">Guardar cambios</button>

</form>