<nav class="main-nav">
    <img src="https://1000logos.net/wp-content/uploads/2023/01/Myspace-Logo-2004.png" alt="Logo">
    <ul>
        <?php if (isset($_SESSION['username'])): ?>
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">LogIn</a></li>
            <li><a href="registro.php">SignUp</a></li>
        <?php endif; ?>
    </ul>
    <div class="search-container">
        <form method="GET" action="/buscador.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit">Submit</button>
        </form>
    </div>
</nav>

<header>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="mis-publicaciones.php">Mis publicaciones</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                <li><a href="moderacion.php">Moderacion</a></li>
            <?php endif; ?>
            
        </ul>
    </nav>
</header>