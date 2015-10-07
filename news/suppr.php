<?php require_once '../inc/functions.php';?>
<?php require_once '../inc/db.php';
logged_only();
$user_id = $_SESSION['auth']->admin_level;
if($user_id >= 2){
}else{
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acc&eacute;der &agrave; cette page";
    header('Location: ../account.php');
    exit();
}?>

<?php
    $suppr = $pdo->prepare("DELETE FROM news WHERE id={$_GET['id']}")->execute();
    header('Location: ../news.php');
    exit();
?>