<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['new_username'];
    $new_password = !empty($_POST['new_password']) ? password_hash($_POST['new_password'], PASSWORD_BCRYPT) : null;

    $photo_path = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_name = basename($_FILES['profile_picture']['name']);
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, $upload_file)) {
            $photo_path = $file_name;
        } else {
            echo "<p>Error al cargar la foto de perfil.</p>";
        }
    }


    $sql = "UPDATE usuarios SET nombre = '$new_username'";
    if ($new_password) {
        $sql .= ", password = '$new_password'";
    }
    if ($photo_path) {
        $sql .= ", foto_perfil = '$photo_path'";
    }
    $sql .= " WHERE nombre = '$username'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $new_username;
        $conn->close();
        header('Location: index.php'); 
        exit();
    } else {
        echo "<p>Error al actualizar el perfil: " . $conn->error . "</p>";
    }
    $conn->close();
}
?>
