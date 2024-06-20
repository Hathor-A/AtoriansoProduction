
<!-- HTML form for registration -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
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
        <a href="/basSQL/registers.php">Enregistrement</a>
        <?php
        session_start();
        require 'config.php';
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = $_POST['email'];
            $icon = $_POST['icon'];

            $sql = "INSERT INTO users (username, password, email, icon) VALUES (:username, :password, :email, :icon)";
            $stmt = $conn->prepare($sql);
            
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':icon', $icon);
            
            if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['username'] = $username;
            $_SESSION['user_icon'] = $icon; 
            header("Location: header.php");
            exit;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->$error;
                }
            }
        ?>
        <a href="/basSQL/logout.php">Déconnexion</a>
        <a href="/BasSQL/profile.php">Profile</a>
        <a href="credits.html">Crédits</a>
        <a href="links.html">Links</a>
    </div>
        <span class="openbtn" onclick="openNav()">&#9776; Menu</span>
    <main>
        <section class="contact-section">
            <h2>Inscription</h2>
            <form action="login-form" method="post">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="icon">Sélectionnez votre icône :</label>
                <select name="icon" id="icon">
                    <option value="/icons/icon_users/131481_boy_guy_male_man_men_icon.png">Icône 1</option>
                    <option value="/icons/icon_users/131482_eastern_muslim_male_arab_arabian_icon.png">Icône 2</option>
                    <option value="/icons/icon_users/131487_themis_blind_femida_justice_lawer_icon.png">Icône 3</option>
                    <option value="/icons/icon_users/131496_guard_male_man_password_power_icon.png">Icône 4</option>
                    <option value="/icons/icon_users/131500_woman_china_chinese_japanese_femine_icon.png">Icône 5</option>
                    <option value="/icons/icon_users/131502_god_problem_evil_red_hell_icon.png">Icône 6</option>
                    <option value="/icons/icon_users/131504_woman_chief_femine_sexy_lady_icon.png">Icône 7</option>
                    <option value="/icons/icon_users/131509_harlem_boss_african_chief_afroamerican_icon.png">Icône 8</option>
                    <option value="/icons/icon_users/131511_caucasian_boss_head_chief_director_icon.png">Icône 9</option>
                    <!-- Ajouter plus d'options d'icônes ici -->
                </select>
                <button type="submit">S'inscrire</button>
            </form>
        </section>
    </main>
    <footer>
        <center><p>©Copyright 2024 by Atorianzo. All rights reversed.</p></center>
    </footer>
</body>
</html>
