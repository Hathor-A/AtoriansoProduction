<?php
session_start();
require 'config.php';

// Récupération des catégories
$sql_categories = "SELECT * FROM categories";
$stmt_categories = $conn->prepare($sql_categories);
$stmt_categories->execute();
$categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

// Récupération des vidéos
$sql_videos = "SELECT videos.*, video_views.views, categories.name as category_name FROM videos 
               JOIN video_views ON videos.id = video_views.video_id
               JOIN categories ON videos.category_id = categories.id";
$stmt_videos = $conn->prepare($sql_videos);
$stmt_videos->execute();
$videos = $stmt_videos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section Originals</title>
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
            <ul>
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

    <main>
        <h1>Originals</h1>
        <div class="videos-container">
            <?php foreach ($videos as $video): ?>
                <div class="video-card">
                    <img src="<?php echo htmlspecialchars($video['thumbnail']); ?>" alt="<?php echo htmlspecialchars($video['title']); ?>">
                    <h3><?php echo htmlspecialchars($video['title']); ?></h3>
                    <p><?php echo htmlspecialchars($video['description']); ?></p>
                    <p>Catégorie : <?php echo htmlspecialchars($video['category_name']); ?></p>
                    <p>Vues : <?php echo $video['views']; ?></p>
                    <video controls>
                        <source src="<?php echo htmlspecialchars($video['video_path']); ?>" type="video/mp4">
                        Votre navigateur ne supporte pas l'élément vidéo.
                    </video>
                    <div>
                        <form action="like_dislike.php" method="POST">
                            <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
                            <button type="submit" name="like">👍</button>
                            <button type="submit" name="dislike">👎</button>
                        </form>
                    </div>
                    <div>
                        <h4>Commentaires</h4>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form action="add_comment.php" method="POST">
                                <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
                                <textarea name="comment" required></textarea>
                                <button type="submit">Ajouter un commentaire</button>
                            </form>
                        <?php else: ?>
                            <p><a href="login.php">Connectez-vous</a> pour commenter.</p>
                        <?php endif; ?>
                        <?php
                        $sql_comments = "SELECT comments.*, users.username FROM comments 
                                         JOIN users ON comments.user_id = users.id 
                                         WHERE comments.video_id = :video_id";
                        $stmt_comments = $conn->prepare($sql_comments);
                        $stmt_comments->bindParam(':video_id', $video['id']);
                        $stmt_comments->execute();
                        $comments = $stmt_comments->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <div class="comments-list">
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment-item">
                                    <p><?php echo htmlspecialchars($comment['username']); ?>: <?php echo htmlspecialchars($comment['comment']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
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
