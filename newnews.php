<?php require_once 'inc/functions.php';?>
<?php require_once 'inc/db.php';?>
<?php require 'inc/header.php';
logged_only();
$user_id = $_SESSION['auth']->admin_level;
if($user_id >= 2){
}else{
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acc&eacute;der &agrave; cette page";
    header('Location: account.php');
    exit();
}?>

<form method="post" action="news/create.php"/>

    Titre : <input type="text" class="form-control" name="newstitre">
    <br/>
    Contenu :<br/>
    <textarea class="form-control" rows="6" name="newscontenu" id="newscontenu"></textarea><br/>
    <div align="center"><input type="submit" class="btn btn-primary" value="valider" name="submitnews"></div>

</form>

<?php require 'inc/footer.php';?>
