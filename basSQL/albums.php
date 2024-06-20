<?php
session_start();
require 'config.php';
    // Récupération des albums
    $sql_albums = "SELECT * FROM albums";
    $stmt_albums = $conn->prepare($sql_albums);
    $stmt_albums->execute();
    $albums = $stmt_albums->fetchAll(PDO::FETCH_ASSOC);
?>

<!--------------------- HTML form pour l'Album ------------------------------------>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section Musique</title>
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
        <a href="/BasSQL/profile.php">Profile</a>
        <a href="/credits.html">Crédits</a>
        <a href="/links.html">Links</a>
    </div>
        <span class="openbtn" onclick="openNav()">&#9776; Menu</span>
    <main>
        <h1>Musique</h1>
        <div class="albums-container">
            <?php foreach ($albums as $album): ?>
                <div class="album-card">
                    <img src="<?php echo htmlspecialchars($album['album_cover']); ?>" alt="<?php echo htmlspecialchars($album['title']); ?>">
                    <h3><?php echo htmlspecialchars($album['title']); ?></h3>
                    <p>Par <?php echo htmlspecialchars($album['artist']); ?></p>
                    <?php
                    // Récupération des chansons de l'album
                    $sql_songs = "SELECT * FROM songs WHERE album_id = :album_id";
                    $stmt_songs = $conn->prepare($sql_songs);
                    $stmt_songs->bindParam(':album_id', $album['id']);
                    $stmt_songs->execute();
                    $songs = $stmt_songs->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <div class="songs-list">
                        <?php foreach ($songs as $song): ?>
                            <div class="song-item">
                                <p><?php echo htmlspecialchars($song['title']); ?></p>
                                <audio controls>
                                    <source src="<?php echo htmlspecialchars($song['track_path']); ?>" type="audio/mp3">
                                    Votre navigateur ne supporte pas l'élément audio
                                </audio>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <center><p>©Copyright 2024 by Atorianzo. All rights reversed.</p></center>
    </footer>
</body>
</html>
