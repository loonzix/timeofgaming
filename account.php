<?php require_once 'inc/functions.php';?>
<?php

logged_only();

if(!empty($_POST)){
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
    }else{
        $user_id = $_SESSION['auth']->id;
        $password=password_hash($_POST['password'], PASSWORD_BCRYPT);
        require_once 'inc/db.php';
        $pdo->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$password,$user_id]);
        $_SESSION['flash']['success'] = "Votre mot de passe a bien &eacute;t&eacute; mis &agrave; jour";
    }
}

require 'inc/header.php';
?>
<div align="center">
    <h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>
    <br /><br />
<div align="center">
    <h2>Param&egrave;tres du compte</h2>
    </div>
    <form action"" method="post">

        <div class=""form-group">
            <input class="form-control" type="password" name="password" placeholder="Changer de mot de passe"/>
        </div>
        <div class=""form-group">
            <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe"/>
        </div>
        <br /><br />
        <button class="btn btn-primary">Changer mon mot de passe</button>
    </form>
</div>


<?php require 'inc/footer.php';?>
