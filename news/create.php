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
if (isset($_POST['submitnews'])){
    if(!empty($_POST['newstitre']) && !empty($_POST['newscontenu'])){
        $pdo->prepare("INSERT INTO news SET titre = ?, contenu = ?")->execute(array($_POST['newstitre'], $_POST['newscontenu']));
        $_SESSION['flash']['success'] = 'Le post a &eacute;t&eacute; ajout&eacute; ';
        header('Location: ../newnews.php');
        exit();
    } else {
        $_SESSION['flash']['danger'] = 'Titre ou Contenu vide !';
        header('Location: ../newnews.php');
        exit();
    }
}
?>