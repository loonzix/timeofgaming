<?php
require_once 'inc/functions.php';
reconnect_from_cookie();
?>
<?php
if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    require_once 'inc/db.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if(session_status() == PHP_SESSION_NONE){
        session_start(); }
    if($user) {
        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = 'Vous &ecirc;tes maintenant connect&eacute;';
            if ($_POST['remember']) {
                $remember_token = str_random(250);
                $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
                setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
            }
            header('Location: account.php');
            exit();
        } else {
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
        }
    }else{
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
        header('Location: login.php');
        exit();
    }
}

header('Location: index.php');
exit();

?>
<?php require 'inc/header.php';?>
<?php require 'inc/footer.php';?>
