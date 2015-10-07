<?php require_once 'inc/functions.php'; ?>
<?php

if(!empty($_POST) && !empty($_POST['email'])){
    require_once 'inc/db.php';
    session_start();
    $req = $pdo->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');
    $req->execute([$_POST['email']]);
    $user = $req->fetch();
    if($user){
        $reset_token = str_random(60);
        $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont &eacute;t&eacute; envoy&eacute;es par emails';
        mail($_POST['email'], 'Réinitiatilisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://www.timeofgaming.fr/gmod/reset.php?id={$user->id}&token=$reset_token");
        header('Location: login.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cet adresse';
    }
}


?>
<?php require 'inc/header.php';?>

<h1>Mot de passe oubli&eacute;</h1>

<form action="" method="POST">

    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control" required/>
    </div>

    <button type="submit" class="btn btn-primary">Demander</button>

</form>

<?php require 'inc/footer.php';?>
