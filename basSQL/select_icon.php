<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
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

// un Fetch current user icon 
$sql = "SELECT icon FROM users WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$currentIcon = $user['icon'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une Icône</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <h2>Choisir une Icône</h2>
    <form action="select_icon.php" method="post">
        <label for="icon">Sélectionnez votre icône :</label>
        <select name="icon" id="icon">
            <option value="icon1.png" <?php if ($currentIcon == 'icon1.png') echo 'selected'; ?>>Icône 1</option>
            <option value="icon2.png" <?php if ($currentIcon == 'icon2.png') echo 'selected'; ?>>Icône 2</option>
            <option value="icon3.png" <?php if ($currentIcon == 'icon3.png') echo 'selected'; ?>>Icône 3</option>
            <!-- Ajouter plus d'options d'icônes ici -->
        </select>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
