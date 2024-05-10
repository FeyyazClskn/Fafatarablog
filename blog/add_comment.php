<?php
require_once("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postID = $_POST['post_id'];
    $name = $_POST['name'];
    $commentText = $_POST['comment'];

    try {
        $stmt = $pdo->prepare("INSERT INTO comments (post_id, name, comment_text) VALUES (?, ?, ?)");
        $stmt->execute([$postID, $name, $commentText]);
    } catch (PDOException $e) {
        die("Yorum eklenirken bir hata oluştu: " . $e->getMessage());
    }
}

header('Location: single.php?id=' . $postID);
exit;
?>
