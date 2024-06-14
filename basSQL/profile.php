<?php
require 'config.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <header>
        <a href="/BasSQL/header.php">
    </header>
    <main>
        <h2>Bienvenue, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Ceci est votre page de profil.</p>
        
    </main>
    <footer>
        <center><p>©Copyright 2024 by Atorianzo. All rights reversed.</p></center>
    </footer>
</body>
</html>


