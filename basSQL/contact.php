<?php
require 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param(':name', $name);
    $stmt->bind_param(':email', $email);
    $stmt->bind_param(':message', $message);
    
    if ($stmt->execute()) {
        echo "Message envoyé avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!--------------------- HTML form for contact ------------------------------------>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img id="Logo Prod" src="/images/Ator/AtoProd.webp" alt="Un logo" title="Logo Ato" height="200">
        </div>
        <nav>
            <ul>
                <ul id="filters-nav">
                    <li><a href="/AtoProd.html"><img src="/icons/accueil.png" class="icon">Accueil</a></li>
                    <li><a href="/html/shows.html"><img src="/icons/cercle-de-jeu.png" class="icon">Publicités</a></li>
                    <li><a href="/html/clips.html"><img src="/icons/bouton-facetime.png" class="icon">Clips</a></li>
                    <li><a href="/html/teasers.html"><img src="/icons/bouton-jouer.png" class="icon">Teasers</a></li>
                    <li><a href="/html/spots.html"><img src="/icons/info.png" class="icon">Spots</a></li>
                    <li><a href="/html/originals.html"><img src="/icons/etoile.png" class="icon">Originaux</a></li>
                    <li><a href="/html/search.html"><img src="/icons/loupe.png" class="icon">Recherche</a></li>
                </ul>
        </nav>
    </header>
    <div id="side-nav" class="side-nav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="/AtoProd.html">Accueil</a>
        <a href="/basSQL/contact.php">Contact</a>
        <a href="/basSQL/login.php">Connexion</a>
        <a href="/basSQL/registers.php">Enregistrement</a>
        <a href="/credits.html">Crédits</a>
        <a href="/links.html">Links</a>
    </div>
        <span class="openbtn" onclick="openNav()">&#9776; Menu</span>
    <main>
        <section class="contact-section">
            <h2>Contactez-nous</h2>
            <form id="contact-form" method="post" >
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </section>
    </main>
    <footer>
        <center><p>©Copyright 2024 by Atorianzo. All rights reversed.</p></center>
    </footer>
    <script src="/script.js"></script>
</body>
</html>

