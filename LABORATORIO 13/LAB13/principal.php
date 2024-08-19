<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooking Mama's</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #f8b400;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav {
            background-color: #333;
            overflow: hidden;
        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        main {
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: auto;
            overflow: hidden;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .product {
            background-color: white;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            width: 30%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product img {
            max-width: 100%;
        }
        .product h2 {
            text-align: center;
        }
        .contact-details {
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border
        }
        .contact-details {
            margin-bottom: 20px;
        }
        .contact-details h3, from h3 {
            margin-top: 20px;
        }
        form{
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form label{
            display: block;
            margin: 10px 0 5px;
        }
        .footer{
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

    </style>
</head>
<body>
    <header>
        <h1>Cooking Mama's</h1>
    </header>
    <nav>
        <a href="#home">Inicio</a>
        <a href="#products">Productos</a>
        <a href="#contact">Contacto</a>
        <a href="logout.php">Log out</a>
    </nav>

    <main class="container">
        <section id="home">
            <h2>¡Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?>!</h2>
            <p>Disfruta de los más deliciosos pasteles y postres, hechos con amor y los mejores ingredientes.</p>
        </section>
        <section id="products">
            <h2>Nuestros Productos</h2>
            <div class="products">
                <div class="product">
                    <img src="pastel1.jpg" alt="Pastel 1">
                    <h2>Pastel de Chocolate</h2>
                    <p>Delicioso pastel de chocolate con relleno cremoso.</p>
                </div>
                <div class="product">
                    <img src="pastel2.jpg" alt="Pastel 2">
                    <h2>Cheesecake</h2>
                    <p>Suave y cremoso cheesecake con una base crujiente.</p>
                </div>
                <div class="product">
                    <img src="pastel3.jpg" alt="Pastel 3">
                    <h2>Pastel de Fresas</h2>
                    <p>Fresco pastel de fresas con crema batida.</p>
                </div>
            </div>
        </section>
        <section id="contact">
            <h2>Contacto</h2>
            <p>Visítanos en nuestra tienda o contáctanos a través de nuestras redes sociales.</p>
            <div class="contact-details">
                <h3>Nuestra Dirección</h3>
                <p>Calle de la Dulzura, 123<br>
                Ciudad del Sabor, PA 12345</p>
                <h3>Teléfono</h3>
                <p>(+123) 456-7890</p>
                <h3>Email</h3>
                <p><a href="mailto:info@cookingmamas.com">info@cookingmamas.com</a></p>
            </div>
            <h3>Formulario de Contacto</h3>
            <form action="mailto:info@cookingmamas.com" method="post" enctype="text/plain">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                <label for="message">Mensaje:</label><br>
                <textarea id="message" name="message" rows="4" required></textarea><br><br>
                <input type="submit" value="Enviar">
            </form>
            <h3>Síguenos en Redes Sociales</h3>
            <p>
                <a href="https://facebook.com/cookingmamas" target="_blank">Facebook</a> |
                <a href="https://instagram.com/cookingmamas" target="_blank">Instagram</a> |
                <a href="https://twitter.com/cookingmamas" target="_blank">X</a>
            </p><br><br><br>
        </section>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Cooking Mama's</p>
    </footer>
</body>
</html>
