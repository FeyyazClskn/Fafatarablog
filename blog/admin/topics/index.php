<?php include('../../path.php'); ?>
<?php include(ROOT_PATH . "/app/controllers/topics.php");
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

        <title>Admin Paneli </title>
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
                    <a href="create.php" class="btn btn-big">Konu Ekle</a>
                    <a href="index.php" class="btn btn-big">Konuları Yönet</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Konuları Yönet</h2>

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                    <table>
                        <thead>
                            <th>#</th>
                            <th>İsim</th>
                            <th>Düzenle</th>
                            <th>Sil</th>
                        </thead>
                        <tbody>
                            
                            <?php foreach ($topics as $key => $topic): ?>
                                <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $topic['name'];?></td>
                                <td><a href="edit.php?id=<?php echo $topic['id']; ?>" class="edit">düzenle</a></td>
                                <td><a href="index.php?del_id=<?php echo $topic['id'];?>" class="delete">sil</a></td>
                            </tr>
                            <?php endforeach; ?>
                        
                        </tbody>
                    </table>

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