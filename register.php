<?php require_once 'inc/functions.php';?>

<?php
session_start();
if(!empty($_POST)) {
    require_once 'inc/db.php';
    $errors = array();

    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Votre pseudo n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        if ($user) {
            $errors['username'] = "Ce pseudo est pris par un autre compte";
        }
    }
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if ($user) {
            $errors['email'] = "Cet email est prise par un autre compte";
        }
        if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
            $errors['password'] = "Vous devez rentrer un mot de passe identique";
        }

        if (empty($errors)) {
            $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token =?");
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $token = str_random(60);
            $req->execute([$_POST['username'], $password, $_POST['email'], $token]);
            $user_id = $pdo->lastInsertID();
            mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien \n\nhttp://www.timeofgaming.fr/gmod/confirm.php?id=$user_id&token=$token");
            $_SESSION['flash']['success'] = 'Un email de confirmation vous a &eacute;t&eacute; envoy&eacute; pour valider votre compte';
            header('Location: login.php');
            exit();
        }

    }
}
?>
<?php require 'inc/header.php';?>
<h1>S'inscrire</h1>

<?php if(!empty($errors)):?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">Erreurs</h3>
    </div>
    <div class="panel-body">
    <p>Vous n'avez pas rempi le formulaire correctement</p>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
    </div>
</div>
<?php endif; ?>

<form action="" method="POST">

    <div class="form-group">
        <label for="">Pseudo</label>
        <input type="text" name="username" class="form-control" required/>
    </div>

    <div class="form-group">
        <label for="">Email</label>
        <input type="text" name="email" class="form-control" />
    </div>

    <div class="form-group">
        <label for="">Mot de passe</label>
        <input type="password" name="password" class="form-control" />
    </div>

    <div class="form-group">
        <label for="">Confirmez votre mot de passe</label>
        <input type="password" name="password_confirm" class="form-control" />
    </div>

    <button type="submit" class="btn btn-primary">M'inscrire</button>

</form>

<?php require 'inc/footer.php';?>
