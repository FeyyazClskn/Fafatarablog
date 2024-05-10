<?php include("path.php"); ?>
<?php include(ROOT_PATH . '/app/controllers/posts.php');

if (isset($_GET['id'])) {
  $post = selectOne('posts', ['id' => $_GET['id']]);
}
$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);

try {
  $stmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = ?");
  $stmt->execute([$post['id']]);
  $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Yorumlar getirilirken bir hata oluştu: " . $e->getMessage());
}
  $topics = selectAll('topics');
  $posts = selectAll('posts', ['published' => 1]);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Sofia" rel="stylesheet">

  <!-- Custom Styling -->
  <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/comment.css">

  <title><?php echo $post['title']; ?> | FafataraBlog</title>
</head>

<body>


  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content Wrapper -->
      <div class="main-content-wrapper">
        <div class="main-content single">
          <h1 class="post-title"><?php echo $post['title']; ?></h1>

          <div class="post-content">
            <?php echo html_entity_decode($post['body']); ?>
          </div>

        </div>
      </div>
      <!-- // Main Content -->

<!-- Sidebar -->
<div class="sidebar single">
  <div class="section popular">
    <h2 class="section-title">Popüler Postlar</h2>

    <?php
    $counter = 0; // Counter to limit the number of posts
    foreach ($posts as $p):
      if ($counter < 10): // Display only the first 10 posts
    ?>
        <div class="post clearfix">
          <img src="<?php echo BASE_URL . '/assets/images/' . $p['image']; ?>" alt="">
          <a href="<?php echo BASE_URL . '/single.php?id=' . $p['id']; ?>" class="title">
            <h4><?php echo $p['title'] ?></h4>
          </a>
        </div>
    <?php
        $counter++;
      else:
        break; // Break the loop once 10 posts are displayed
      endif;
    endforeach;
    ?>
  </div>

  <div class="section topics">
    <h2 class="section-title">Konular</h2>
    <ul>
      <?php foreach ($topics as $topic): ?>
        <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<!-- // Sidebar -->


      
        <!-- Yorum Ekleme Formu -->
  <div class="comment-form">
      <h3>Yorum Yap</h3>
      
      <?php if (isset($_SESSION['id'])): ?>
          <form action="add_comment.php" method="post">
              <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
              <input type="hidden" name="name" value="<?php echo $_SESSION['username']; ?>">
              
              <label for="comment">Yorumunuz:</label>
              <textarea name="comment" rows="4" required></textarea>
              <button type="submit" name="submit">Yorumu Gönder</button>
          </form>
      <?php else: ?>
          <p>Yorum yapabilmek için giriş yapmalısınız. <a href="<?php echo BASE_URL . '/login.php' ?>">Giriş yap</a></p>
      <?php endif; ?>
  </div>



  <!-- Yorumları Gösterme -->
  <div class="comments">
      <h3>Yorumlar</h3>
      <?php
      require_once(__DIR__ . "/config.php");

      try {
          $stmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = ?");
          $stmt->execute([$post['id']]);
          $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

          foreach ($comments as $comment) {
              echo '<div class="comment">';
              echo '<strong>' . htmlspecialchars($comment['name']) . ':</strong><br>';
              echo htmlspecialchars($comment['comment_text']);
              echo '</div>';
          }
      } catch (PDOException $e) {
          die("Yorumlar getirilirken bir hata oluştu: " . $e->getMessage());
      }
      ?>
  </div>

    </div>
    <!-- // Content -->

  </div>
  <!-- // Page Wrapper -->

  <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>


  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Slick Carousel -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>

</body>

</html>