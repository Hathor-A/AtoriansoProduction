<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_icon'] = $user['icon'];
        header("Location: header.php");
    exit;
} else {
        echo "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>
<!---------------- HTML form for login ------------------------------------------------->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="/reset.css">
    <script src="/script.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img id="Logo Prod" src="/images/Ator/AtoProd.webp" alt="Un logo" title="Logo Ato" height="200">
        </div>
        <nav>
            
                <ul id="filters-nav">
                    <li><a href="/AtoProd.html"><img src="/icons/accueil.png" class="icon">Accueil</a></li>
                    <li><a href="/html/shows.html"><img src="/icons/cercle-de-jeu.png" class="icon">Publicités</a></li>
                    <li><a href="/html/clips.html"><img src="/icons/bouton-facetime.png" class="icon">Clips</a></li>
                    <li><a href="/html/teasers.html"><img src="/icons/bouton-jouer.png" class="icon">Teasers</a></li>
                    <li><a href="/html/spots.html"><img src="/icons/info.png" class="icon">Spots</a></li>
                    <li><a href="/html/originals.html"><img src="/icons/etoile.png" class="icon">Originaux</a></li>
                    <li><a href="/html/search.html"><img src="/icons/loupe.png" class="icon">Recherche</a></li>
                    <li><a href="/basSQL/albums.php"><img src="/icons/music_note_sound_audio_icon.png" class="icon">Musique</a></li>
                </ul>
        </nav>
    </header>
    <div id="side-nav" class="side-nav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="/AtoProd.html">Accueil</a>
        <a href="/basSQL/contact.php">Contact</a>
        <a href="/basSQL/login.php">Connexion</a>
        <?php
        if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_icon'] = $user['icon'];
        header("Location: header.php");
            // exit;
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect";
        }
        ?>
        <a href="/basSQL/registers.php">Enregistrement</a>
        <a href="/basSQL/logout.php">Déconnexion</a>
        <a href="/BasSQL/profile.php">Profile</a>
        <a href="credits.html">Crédits</a>
        <a href="links.html">Links</a>
    </div>
    <span class="openbtn" onclick="openNav()">&#9776; Menu</span>
    <main>
        <section class="login-section">
            <h2>Connexion</h2>
            <form action="/basSQL/header.php" method="post">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Se connecter</button>
            </form>
        </section>
    </main>
    <footer>
        <center><p>©Copyright 2024 by Atorianzo. All rights reversed.</p></center>
    </footer>
</body>
</html>

