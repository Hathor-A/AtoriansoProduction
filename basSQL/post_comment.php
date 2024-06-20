<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: header.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$video_id = $_POST['video_id'];
$comment = $_POST['comment'];

$sql = "INSERT INTO comments (user_id, video_id, comment) VALUES (:user_id, :video_id, :comment)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':video_id', $video_id);
$stmt->bindParam(':comment', $comment);

if ($stmt->execute()) {
    header("Location: show_video.php?video_id=" . $video_id);
    exit;
} else {
    echo "Erreur lors de l'ajout du commentaire.";
}
?>
