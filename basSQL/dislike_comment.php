<?php
session_start();
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$comment_id = $data['comment_id'];

$sql = "UPDATE comments SET dislikes = dislikes + 1 WHERE id = :comment_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':comment_id', $comment_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>,
