<?php 

include(ROOT_PATH . "/app/databese/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");

$table = 'users';

$admin_users =  selectAll($table);


$errors = array();
$id = '';
$username = '';
$admin= '';
$email = '';
$password = '';
$passwordConf = '';


function isUserBanned($user_id) {
    // Kullanıcıyı veritabanından seç
    $user = selectOne('users', ['id' => $user_id, 'ban' => 1]); // 'ban' sütunu kontrolü ekledik

    // Kullanıcı var mı kontrol et
    if ($user) {
        // Kullanıcı banlıysa oturumu sonlandır
        session_destroy();

        // Yönlendirme için kullanılacak URL'yi belirle
        $redirectUrl = BASE_URL . '/ban-page.php';

        // HTTP başlıkları kullanarak yönlendirme yap
        header('HTTP/1.1 404 Not Found');
        header("Location: $redirectUrl");
        exit();
    }

    // Kullanıcı banlı değilse, isteğe bağlı olarak başka işlemler yapabilirsiniz
    return false; // Kullanıcı banlı değil
}



function loginUser($user) {
    // Kullanıcı bilgilerini doğru şekilde kontrol et
    if (isUserBanned($user['id'])) {
        // Kullanıcı banlı ise işlemleri gerçekleştirme
        $_SESSION['message'] = "Banlandınız, siteye giriş yapamazsınız.";
        $_SESSION['type'] = "error";
        header('location:' . BASE_URL . 'login.php');
        exit();
    }

    // Kullanıcı banlı değilse, session işlemlerini yap
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = 'Başarıyla giriş yaptınız';
    $_SESSION['type'] = 'success';

    if ($_SESSION['admin']) {
        header('Location:' . BASE_URL .'/admin/dashboard.php');
    } else {
        header('location:' . BASE_URL . '/index.php');
    }
    exit();
}


if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
    $errors = validateUser($_POST);

    if (count($errors) === 0){
        unset($_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    

        if (isset($_POST['admin'])) {
            $_POST['admin'] = 1;
            $user_id = create($table, $_POST);
            $_SESSION['message'] = "Admin kullanıcısı başarıyla oluşturuldu";
            $_SESSION["type"] = "success";
            header('Location:' . BASE_URL .'/admin/users/index.php');
            exit();

        } else {    
            $_POST['admin'] = 0;
            $user_id = create($table, $_POST);
            $user = selectOne($table, ['id' => $user_id]);
            loginUser($user);
        }
        
    } else {
        $username = $_POST['username'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];

    }
}

if (isset($_POST['ban-btn']) || isset($_POST['unban-btn'])) {
    adminOnly();

    $user_id = $_POST['user_id'];
    
    if (isset($_POST['ban-btn'])) {
        // Banla butonuna basıldıysa
        $ban_status = 1;
    } elseif (isset($_POST['unban-btn'])) {
        // Banı Kaldır butonuna basıldıysa
        $ban_status = 0;
    }

    if (is_array($user) && isset($user['id'])) {
        $user_id = $user['id'];
    
        // Kullanıcı banlı mı kontrol et
        if (isUserBanned($user_id)) {
            // Kullanıcı banlı ise oturumu sonlandır ve giriş sayfasına yönlendir
            session_destroy();
            header("Location: login.php?banned=1");
            exit();
        }
    
        // Kullanıcı banlı değilse, isteğe bağlı olarak başka işlemler yapabilirsiniz
    }
    // Kullanıcıyı güncelle
    $count = update($table, $user_id, ['ban' => $ban_status]);

    // Mesajı ayarla
    if ($count > 0) {
        $_SESSION['message'] = "Kullanıcı başarıyla " . ($ban_status ? 'banlandı' : 'banı kaldırıldı');
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['message'] = "Kullanıcı güncellenirken bir hata oluştu";
        $_SESSION['type'] = "error";
    }

    header('Location: index.php');
    exit();
}

if (isset($_POST['update-user'])) {
    adminOnly();
    $errors = validateUser($_POST);

    if (count($errors) === 0){
        $id = $_POST['id'];
        unset($_POST['passwordConf'], $_POST['update-user'], $_POST['id']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
        $_POST['admin'] =  isset($_POST['admin']) ? 1 : 0;
        $count = update($table, $id, $_POST);   
        $_SESSION['message'] = "Admin kullanıcısı başarıyla düzenlendi";
        $_SESSION["type"] = "success";  
        header('Location:' . BASE_URL .'/admin/users/index.php');
        exit();

    } else {
        $username = $_POST['username'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];

    }
}

if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);  

    $id = $user['id']; 
    $username = $user['username'];
    $admin = $user['admin'];
    $email = $user['email'];
}

if (isset($_POST['login-btn'])) 
{
    $errors = validateLogin($_POST);

    if (count($errors) === 0) {
          $user = selectOne($table, ['username' => $_POST['username']]);  
   
        if ($user && password_verify($_POST['password'], $user['password'])) {
            loginUser($user);

        } else {
            array_push($errors, 'Yanlış kullanıcı adı ya da şifre');
        }


        } 

        $username = $_POST['username'];
        $password = $_POST['password'];

}


if (isset($_GET['delete_id'])) {
    adminOnly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = "Admin kullanıcısı başarıyla silindi";
    $_SESSION["type"] = "success";
    header('Location:' . BASE_URL .'/admin/users/index.php');
    exit();
}

if (is_array($user) && isset($user['id'])) {
    $user_id = $user['id'];

    // Kullanıcı banlı mı kontrol et
    if (isUserBanned($user_id)) {
        // Kullanıcı banlı ise oturumu sonlandır ve giriş sayfasına yönlendir
        session_destroy();
        header("Location: login.php");
        exit();
    }

    // Kullanıcı banlı değilse, isteğe bağlı olarak başka işlemler yapabilirsiniz
}





function generateRandomPassword($length = 12) {
    // Şifre karakterleri
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+';

    // Şifreyi oluştur
    $password = '';
    $characterCount = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[mt_rand(0, $characterCount)];
    }

    return $password;
}