<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="registration-form">
        <div class="avatar"></div>
        <h2>Registration Form</h2>
        <form method="post">
            <div class="first_name">
                <input type="text" id="first_name" name="first_name" placeholder="First name" required>
            </div>
            <div class="last_name">
                <input type="text" id="last_name" name="last_name" placeholder="Last name" required>
            </div>
            <div class="username">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="email">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="password">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="confirmed_password">
                <input type="password" id="confirmed" name="confirmed_password" placeholder="Confirm Password" required>
            </div><br>
            <button type="submit">OK</button>
            <button onclick="window.location.href='mostrar.php'">Mostrar Registros</button>
 </form>
 <?php
include 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmed_password = htmlspecialchars($_POST['confirmed_password']);
    $sql = "INSERT INTO quiz_form_data(first_name, last_name, username, email, password) VALUES('$first_name', '$last_name', '$username', '$email', '$password')";
    if($conn->query($sql) === TRUE){
        echo "Registro exitoso";
    } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if ($password!=$confirmed_password) {
        echo "Las contraseñas no coinciden.";
        exit;
    }
    $conn->close();
    }
    ?>
    </div>
</body>
</html>