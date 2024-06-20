<?php
session_start();
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$comment_id = $data['comment_id'];

$sql = "UPDATE comments SET likes = likes + 1 WHERE id = :comment_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':comment_id', $comment_id);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['video_id'], $_SESSION['user_id'])) {
    $video_id = $_POST['video_id'];
    $user_id = $_SESSION['user_id'];
    $is_like = isset($_POST['like']) ? 1 : 0;

    $sql = "INSERT INTO likes_dislikes (video_id, user_id, is_like) VALUES (:video_id, :user_id, :is_like)
            ON DUP";
}