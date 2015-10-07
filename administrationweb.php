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


<form method="post"/>
    <div align="center">
       <div align="left">
       <h2>Administration Web</h2>
       <br /><br />
       <h5>Users</h5>
       <a href="userinfo.php" class="btn btn-default">User list</a>
       <br /><br />
       <h5>News</h5>
       <div><a href="newnews.php" class="btn btn-primary">Ajouter News</a><br/><br/></div>
       <div><a href="news.php" class="btn btn-default">Voir liste News</a></div>
       </div>
    </div>
</form>
<?php require 'inc/footer.php';?>