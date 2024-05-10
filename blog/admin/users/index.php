<?php include('../../path.php'); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php");
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
                    <a href="create.php" class="btn btn-big">Kullanıcı Ekle</a>
                    <a href="index.php" class="btn btn-big">Kullanıcıları Yönet</a>
                </div>


                <div class="content">

    <h2 class="page-title">Kullanıcıları Yönet</h2>

    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

    <table>
        <thead>
            <th>#</th>
            <th>Kullanıcı Adı</th>
            <th>Email</th>
            <th>Durumu</th>
            <th>Düzenle</th>
            <th>Sil</th>
            <th>Banla</th> <!-- Yeni sütun -->
        </thead>
        <tbody>
            <?php foreach ($admin_users as $key => $user): ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo ($user['ban'] == 1) ? 'Banlı' : 'Aktif'; ?></td> <!-- Durumu göster -->
                    <td><a href="edit.php?id=<?php echo $user['id']; ?>" class="edit">düzenle</a></td>
                    <td><a href="index.php?delete_id=<?php echo $user['id']; ?>" class="delete">sil</a></td>
                    <td>
                        <form action="index.php" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <?php if ($user['ban'] == 1): ?>
                                <button type="submit" name="unban-btn">Banı Kaldır</button>
                            <?php else: ?>
                                <button type="submit" name="ban-btn">Banla</button>
                            <?php endif; ?>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>

</div>

<!-- ... -->
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