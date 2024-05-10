<?php // admin/comments/delete_comment.php

include('../../path.php');
include(ROOT_PATH . '/app/databese/db.php');
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/includes/messages.php");  
if (!isset($pdo) || $pdo === null) {
    die("PDO bağlantısı başarısız. db.php dosyasını kontrol edin.");
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $commentId = $_GET['id'];

    try {
        // Yorumu sil
        $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->execute([$commentId]);

        // Başarıyla silindiğini belirten bir mesaj ekleyebilirsiniz
        $_SESSION['message'] = "Yorum başarıyla silindi.";
        $_SESSION['type'] = "success";
    } catch (PDOException $e) {
        die("Yorum silinirken bir hata oluştu: " . $e->getMessage());
    }
}

// Yorum silindikten sonra single.php sayfasına yönlendir
header('location: ' . BASE_URL . '/admin/comments/show.php');
exit;
