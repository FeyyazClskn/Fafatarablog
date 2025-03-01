<?php include('../../path.php'); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");
adminonly();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Font Awesome -->
        <link rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
            crossorigin="anonymous">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Candal|Lora"
            rel="stylesheet">

        <!-- Custom Styling -->
        <link rel="stylesheet" href="../../assets/css/style.css">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../../assets/css/admin.css">
        <link rel="icon" href="assets/images/fafatara.ico" type="image/x-icon" />

        <title>Admin Paneli</title>
    </head>

    <body>
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">

            <!-- Left Sidebar -->
            <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
            <!-- // Left Sidebar -->


            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Post Ekle</a>
                    <a href="index.php" class="btn btn-big">Post Düzenle</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Post Düzenle</h2>
                    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                    <form action="edit.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div>
                            <label>Başlık</label>
                            <input type="text" name="title" value="<?php echo $title ?>"class="text-input">
                        </div>
                        <div>
                            <label>Açıklama</label>
                            <textarea name="body" id="body"><?php echo $body ?></textarea>
                        </div>
                        <div>
                            <label>Resim</label>
                            <input type="file" name="image" class="text-input">
                        </div>
                        <div>
                            <label>Konu</label>
                            <select name="topic_id" class="text-input">
                            <option value=""></option>
                            <?php foreach ($topics as $key => $topic): ?>
                                    <?php if (!empty($topic_id) && $topic_id == $topic['id'] ): ?>
                                        <option selected value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                    <?php endif; ?>

                                <?php endforeach; ?>


                            </select>
                        </div>
                          <div>
                            <?php if (!empty($published) && $published == 0): ?>

                                <label>
                                    <input type ="checkbox" name="published">
                                    Paylaş
                                </label>


                            <?php else: ?>

                                <input type ="checkbox" name="published" checked>
                                    Paylaş
                                </label>


                            <?php endif; ?>


                            </div>
                        <div>
                            <button type="submit" name="update-post" class="btn btn-big">Post Düzenle</button>
                        </div>
                    </form>

                </div>

            </div>
            <!-- // Admin Content -->

        </div>
        <!-- // Page Wrapper -->



        <!-- JQuery -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Ckeditor -->
        <script
            src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
        <!-- Custom Script -->
        <script src="../../assets/js/scripts.js"></script>

    </body>

</html>