<?php require_once 'inc/functions.php';?>
<?php require_once 'inc/db.php';?>
<?php require 'inc/header.php';
logged_only()?>
<?php
$user_id = $_SESSION['auth']->admin_level;
if($user_id >= 2){

}else{
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acc&eacute;der &agrave; cette page";
    header('Location: account.php');
    exit();
}?>

<?php

if(isset($_POST['submitnews'])){
    $id=$_POST['id'];
    if(!empty($_POST['newstitre'] && $_POST['newscontenu'])){
        $reqnew = $pdo->prepare("UPDATE news SET titre=?, contenu=? WHERE id=$id");
        $reqnew->execute(array($_POST['newstitre'], $_POST['newscontenu']));
        $_SESSION['flash']['success'] = "News modifi&eacute;e";
        header('Location: news.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = "Titre ou Contenu vide !";
        header('Location: news.php');
        exit();
    }
}



$req = $pdo->prepare("SELECT * FROM news WHERE id=?");
$req->execute(array($_GET['id']));
$data = $req->fetch(PDO::FETCH_ASSOC);

?>

<form method="post" action="edit.php"/>
<input name ="id" type="hidden" value="<?php echo $data['id']; ?>"/>
Titre : <input type="text" class="form-control" name="newstitre" value="<?php echo $data['titre']; ?>"/>
<br/>
Contenu :<br/>
<textarea class="form-control" rows="6" name="newscontenu" id="newscontenu"><?php echo $data['contenu']; ?></textarea><br/>
<div align="center"><input type="submit" class="btn btn-primary" value="valider" name="submitnews"/>  <a href="news.php" class="btn btn-primary">Annuler</a></div>

</form>
<?php require 'inc/footer.php';?>
