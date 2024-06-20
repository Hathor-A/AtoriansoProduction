<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['video_id'], $_SESSION['user_id'])) {
    $video_id = $_POST['video_id'];
    $user_id = $_SESSION['user_id'];
    $is_like = isset($_POST['like']) ? 1 : 0;

    $sql = "INSERT INTO likes_dislikes (video_id, user_id, is_like) VALUES (:video_id, :user_id, :is_like)
            ON DUP";
}