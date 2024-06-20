<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header("header.php");
    // exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
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
                    <li><a href="/basSQL/header.php"><img src="/icons/accueil.png" class="icon">Accueil</a></li>
                <li><a href="/basSQL/shows.php"><img src="/icons/cercle-de-jeu.png" class="icon">Publicités</a></li>
                <?php foreach ($categories as $category): ?>
                    <li><a href="videos.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                <?php endforeach; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/basSQL/shows.php"><img src="<?php echo $_SESSION['user_icon']; ?>" alt="User Icon" style="width:30px;height:30px;"></a></li>
                <?php else: ?>
                    <!--<li><a href="/login.php">Se connecter</a></li>
                    <li><a href="/registers.php">S'inscrire</a></li>-->
                <?php endif; ?>
                <li><a href="/basSQL/videos.php"><img src="/icons/bouton-facetime.png" class="icon">Vidéos</a></li>
                <?php foreach ($categories as $category): ?>
                    <li><a href="videos.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                <?php endforeach; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/basSQL/videos.php"><img src="<?php echo $_SESSION['user_icon']; ?>" alt="User Icon" style="width:30px;height:30px;"></a></li>
                <?php else: ?>
                <?php endif; ?>
                <li><a href="/basSQL/teasers.php"><img src="/icons/bouton-jouer.png" class="icon">Teasers</a></li>
                <?php foreach ($categories as $category): ?>
                    <li><a href="videos.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                <?php endforeach; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/basSQL/teasers.php"><img src="<?php echo $_SESSION['user_icon']; ?>" alt="User Icon" style="width:30px;height:30px;"></a></li>
                <?php else: ?>
                <?php endif; ?>
                <li><a href="/basSQL/spots.php"><img src="/icons/info.png" class="icon">Spots</a></li>
                <?php foreach ($categories as $category): ?>
                    <li><a href="videos.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                <?php endforeach; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/basSQL/spots.php"><img src="<?php echo $_SESSION['user_icon']; ?>" alt="User Icon" style="width:30px;height:30px;"></a></li>
                <?php else: ?>
                <?php endif; ?>
                <li><a href="/basSQL/originals.php"><img src="icons/etoile.png" class="icon">Originaux</a></li>
                <?php foreach ($categories as $category): ?>
                    <li><a href="videos.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                <?php endforeach; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/basSQL/originals.php"><img src="<?php echo $_SESSION['user_icon']; ?>" alt="User Icon" style="width:30px;height:30px;"></a></li>
                <?php else: ?>
                <?php endif; ?>
                <li><a href="/basSQL/search.php"><img src="/icons/loupe.png" class="icon">Recherche</a></li>
                <li><a href="/basSQL/albums.php"><img src="/icons/music_note_sound_audio_icon.png" class="icon">Musique</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/basSQL/albums.php"><img src="<?php echo $_SESSION['user_icon']; ?>" alt="User Icon" style="width:30px;height:30px;"></a></li>
                    <?php else: ?>
                    <?php endif; ?>
                </ul>
        </nav>
    </header>
    <div id="side-nav" class="side-nav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="/AtoProd.html">Accueil</a>
        <a href="/basSQL/contact.php">Contact</a>
        <a href="/basSQL/login.php">Connexion</a>
        <a href="/basSQL/registers.php">Enregistrement</a>
        <a href="/basSQL/logout.php">Déconnexion</a>
        <a href="/BasSQL/profile.php">Profile</a>
        <?php
        if (!isset($_SESSION['username'])) {
            header("header.php");
            
        }
        ?>
        <a href="credits.html">Crédits</a>
        <a href="links.html">Links</a>
        
    </div>
        <span class="openbtn" onclick="openNav()">&#9776; Menu</span>
    <main>
        <h2>Bienvenue, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Ceci est votre page de profil.</p>
        
    </main>
    <footer>
        <center><p>©Copyright 2024 by Atorianzo. All rights reversed.</p></center>
    </footer>
</body>
</html>


