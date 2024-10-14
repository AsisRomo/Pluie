<?php


$conn = new mysqli("localhost:3306", "root", "", "clientes");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['usuario'];
$phone = $_POST['telefono'];
$password = $_POST['contraseña'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO clientes (usuario, telefono, contraseña) VALUES ('$nombre', '$phone', '$password')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $phone, $password, $hashed_password);

if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();

?>