<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header("header.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $icon = $_POST['icon'];
    $username = $_SESSION['username'];

    $sql = "UPDATE users SET icon = :icon WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':icon', $icon);
    $stmt->bindParam(':username', $username);

    if ($stmt->execute()) {
        echo "Icône mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de l'icône.";
    }
}

// ---------------- un Fetch de l'icone utilisateur en cours ------------------------>
$sql = "SELECT icon FROM users WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$user = $stmt->fetch();
$currentIcon = $user['icon'];
?>

<!-----------------  HTML Form pour la selection de l'icone ---------------------->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une Icône</title>
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
        <a href="credits.html">Crédits</a>
        <a href="links.html">Links</a>
    </div>
        <span class="openbtn" onclick="openNav()">&#9776; Menu</span>
    <main>
        <section class="contact-section">
    <h2>Choisir une Icône</h2>
    <form action="/basSQL/select_icon.php" method="post">
        <label for="icon">Sélectionnez votre icône :</label>
        <select name="icon" id="icon">
            <option value="131481_boy_guy_male_man_men_icon.png" <?php if ($currentIcon == '131481_boy_guy_male_man_men_icon.png') echo 'selected'; ?>>Icône 1</option>
            <option value="131482_eastern_muslim_male_arab_arabian_icon.png" <?php if ($currentIcon == '131482_eastern_muslim_male_arab_arabian_icon.png') echo 'selected'; ?>>Icône 2</option>
            <option value="131487_themis_blind_femida_justice_lawer_icon.png" <?php if ($currentIcon == '131487_themis_blind_femida_justice_lawer_icon.png') echo 'selected'; ?>>Icône 3</option>
            <option value="131496_guard_male_man_password_power_icon.png" <?php if ($currentIcon == '131496_guard_male_man_password_power_icon.png') echo 'selected'; ?>>Icône 4</option>
            <option value="131500_woman_china_chinese_japanese_femine_icon.png" <?php if ($currentIcon == '131500_woman_china_chinese_japanese_femine_icon.png') echo 'selected'; ?>>Icône 5</option>
            <option value="131502_god_problem_evil_red_hell_icon.png" <?php if ($currentIcon == '131502_god_problem_evil_red_hell_icon.png') echo 'selected'; ?>>Icône 6</option>
            <option value="131504_woman_chief_femine_sexy_lady_icon.png" <?php if ($currentIcon == '131504_woman_chief_femine_sexy_lady_icon.png') echo 'selected'; ?>>Icône 7</option>
            <option value="131509_harlem_boss_african_chief_afroamerican_icon.png" <?php if ($currentIcon == '131509_harlem_boss_african_chief_afroamerican_icon.png') echo 'selected'; ?>>Icône 8</option>
            <option value="131511_caucasian_boss_head_chief_director_icon.png" <?php if ($currentIcon == '131511_caucasian_boss_head_chief_director_icon.png') echo 'selected'; ?>>Icône 9</option>
            <!-- Ajouter plus d'options d'icônes ici --------------->
        </select>
        <button type="submit">Mettre à jour</button>
    </form>
    </section>
    </main>
    <footer>
        <center><p>©Copyright 2024 by Atorianzo. All rights reversed.</p></center>
    </footer>
</body>
</html>
