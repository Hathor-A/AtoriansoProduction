<?php
session_start();
require 'config.php';

$video_id = $_GET['video_id'];

$user_id = $_SESSION['user_id'];
$video_id = $_POST['video_id'];
$comment = $_POST['comment'];

$sql = "INSERT INTO comments (user_id, video_id, comment, created_at) VALUES (:user_id, :video_id, :comment, created_at:)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':video_id', $video_id);
$stmt->bindParam(':comment', $comment);
$stmt->bindParam('created_at:', $created_at);

if ($stmt->execute()) {
    header("Location: show_video.php?video_id=" . $video_id);
    exit;
} else {
    echo "Erreur lors de l'ajout du commentaire.";
}

// Mise à jour des vues
$sql_update_views = "UPDATE video_views SET views = views + 1 WHERE video_id = :video_id";
$stmt_update_views = $conn->prepare($sql_update_views);
$stmt_update_views->bindParam(':video_id', $video_id);
$stmt_update_views->execute();

// Récupération des détails de la vidéo
$sql_video = "SELECT videos.*, video_views.views FROM videos JOIN video_views ON videos.id = video_views.video_id WHERE videos.id = :video_id";
$stmt_video = $conn->prepare($sql_video);
$stmt_video->bindParam(':video_id', $video_id);
$stmt_video->execute();
$video = $stmt_video->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($video['title']); ?></title>
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="/reset.css">
    <script src="/script.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img id="Logo Prod" src="./images/Ator/AtoProd.webp" alt="Un logo" title="Logo Ato" height="200">
        </div>
        <nav>
            <ul id="filters-nav">
                <li><a href="/header.php"><img src="icons/accueil.png " class="icon"> Accueil</a></li>
                <li><a href="/html/shows.html"><img src="icons/cercle-de-jeu.png " class="icon"> Publicités</a></li>
                <li><a href="/videos.php"><img src="icons/bouton-facetime.png " class="icon"> Vidéos</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="header.php"><img src="<?php echo $_SESSION['user_icon']; ?>" alt="User Icon" style="width:30px;height:30px;"></a></li>
                <?php else: ?>
                    <li><a href="/AtoProd.html"><img src="icons/accueil.png " class="icon">Accueil</a></li>
                <?php endif; ?>
                <li><a href="/html/teasers.html"><img src="icons/bouton-jouer.png " class="icon"> Teasers</a></li>
                <li><a href="/html/spots.html"><img src="/icons/info.png " class="icon"> Spots</a></li>
                <li><a href="/html/originals.html"><img src="icons/etoile.png " class="icon"> Originaux</a></li>
                <li><a href="/html/search.html"><img src="icons/loupe.png " class="icon"> Recherche</a></li>
                <li><a href="../basSQL/albums.php"><img src="/icons/music_note_sound_audio_icon.png" class="icon">Musique</a></li>
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
        <a href="credits.html">Crédits</a>
        <a href="links.html">Links</a>
        <a href="/projet_dataViz/index.html">Météo ClimaX</a>
    </div>
        <span class="openbtn" onclick="openNav()">&#9776; Menu</span>
        
                <li><a href="header.php">Accueil</a></li>
                <li><a href="videos.php">Vidéos</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="header.php"><img src="<?php echo $_SESSION['user_icon']; ?>" alt="User Icon" style="width:30px;height:30px;"></a></li>
                <?php else: ?>
                    <li><a href="login.php">Se connecter</a></li>
                    <li><a href="register.php">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="content-section" id="shows">
        <div class="video-detail">
            <h1><?php echo htmlspecialchars($video['title']); ?></h1>
            <p><?php echo htmlspecialchars($video['description']); ?></p>
            <p>Vues : <?php echo $video['views']; ?></p>
            <video controls>
                <source src="<?php echo htmlspecialchars($video['video_path']); ?>" type="video/mp4">
                Votre navigateur ne supporte pas l'élément vidéo.
            </video>
            <h3>Commentaires</h3>
            <!-- Ajoutez ici le formulaire et l'affichage des commentaires -->
            <?php 
            if (isset($_SESSION['user_id'])): 
                header("Location: header.php");?>
                            <form action="submit_comment.php" method="post">
                                <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
                                <textarea name="comment" required></textarea>
                                <button type="submit">Commenter</button>
                            </form>
                        <?php else: ?>
                            <p><a href="login.php">Connectez-vous</a> pour laisser un commentaire.</p>
                        <?php endif; ?>
            <?php
                session_start();
                require 'config.php';

        // Récupération des commentaires --------------------------------------------------->
                        $sql_comments = "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.video_id = :video_id ORDER BY comments.created_at DESC";
                        $stmt_comments = $conn->prepare($sql_comments);
                        $stmt_comments->bindParam(':video_id', $video['id']);
                        $stmt_comments->execute();
                        $comments = $stmt_comments->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="comment"><img src="<?php echo htmlspecialchars($comment['./icons/']); ?>" alt="User Icon" style="width:30px;height:30px;">
                                <span><?php echo htmlspecialchars($comment['username']); ?></span>
                                <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                                <p><?php echo $comment['created_at']; ?></p>
                                <button onclick="likeComment(<?php echo $comment['id']; ?>)">👍 <?php echo $comment['likes']; ?></button>
                                <button onclick="dislikeComment(<?php echo $comment['id']; ?>)">👎 <?php echo $comment['dislikes']; ?></button>
                            </div>
                        <?php endforeach; ?>
                        <?php
                        if (!isset($_SESSION['user_id'])) {
                            header("Location: header.php");
                        exit;
                        }?>

        </div>
        </section>
    </main>

    <footer>
        <section class="credits-section">
            <p>&copy; 2024 Atorianzo. Tous droits réservés.</p>
            <p>Ce site web a été créé avec le soutien précieux de <strong><a href="https://adatechschool.fr/ecole/">Ada Tech School</strong></a>____________</p>
            <p>Réalisé par <strong>Atorianzo</strong>, basé à <strong>Lyon, France</strong>.</p>
            <p>Chez Atorianzo Production, nous nous engageons à produire le meilleur de nous-mêmes et à réaliser les rêves de chacun et chacune.</p>
        </section>
        <center><p>©Copyright 2024 by Atorianzo. All rights reversed.</p></center>
    </footer>
</body>
</html>
