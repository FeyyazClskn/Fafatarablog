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
                    <a href="create.php" class="btn btn-big">Kullanıcı Ekle</a>
                    <a href="index.php" class="btn btn-big">Kullanıcıları Yönet</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Kullanıcıyı Düzenle</h2>

                    <?php include (ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                    <form action="edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" >
                    <div>
                            <label>Kullanıcı Adı</label>
                            <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
                        </div>
                        <div>
                            <label>Şifre</label>
                            <input type="password" name="password" value="<?php echo $password; ?>"class="text-input">
                        </div>
                        <div>
                            <label>Şifre Doğrulama</label>
                            <input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" class="text-input">
                        </div>
                        <div>

                        <?php if (isset($admin) && $admin == 1): ?>
                            <label>
                                <input type="checkbox" name="admin" checked>
                                Admin
                            </label>    
                        <?php else: ?>
                            <label>
                                <input type="checkbox" name="admin">
                                Admin
                            </label>
                        <?php endif; ?>    

                        <?php if (isset($ban) && $ban == 1): ?>
    <label>
        <input type="checkbox" name="banla" checked>
        Banla
    </label>    
<?php else: ?>
    <label>
        <input type="checkbox" name="banla">
        Banla
    </label>
<?php endif; ?>  
                
                        </div>

                        <div>
                            <button type="submit" name="update-user" class="btn btn-big">Kullanıcıyı Düzenle</button>
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