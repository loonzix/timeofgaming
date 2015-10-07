<?php
require_once 'inc/functions.php';
require_once 'inc/db.php';
logged_only();
$user_id = $_SESSION['auth']->admin_level;
if($user_id >= 2){

}else{
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acc&eacute;der &agrave; cette page";
    header('Location: account.php');
    exit();
}

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $adminlevel = $_POST['adminlevel'];
    //$requser = $pdo->prepare("UPDATE users SET admin_level =$adminlevel WHERE id =$id");
    $requser = $pdo->prepare("UPDATE users SET admin_level = :adminLevel WHERE id = :idUser");
    $requser->execute(array(
        'adminLevel' => $adminlevel,
        'idUser' => $id
    ));
    $_SESSION['flash']['success'] = "User modifié";
    header('Location: userinfo.php');
    exit();
}



$req = $pdo->prepare("SELECT * FROM users WHERE id=?");
$req->execute(array($_GET['id']));
$data = $req->fetch(PDO::FETCH_ASSOC);
require 'inc/header.php';
?>

<form method="post" name="submit" action="edituser.php"/>
<div align="center">
<input name ="id" type="hidden" value="<?php echo $data['id']; ?>"/>
Username : <?php echo $data['username']; ?>
<br/>
Admin _level : <?php echo $data['admin_level'] ?><br/>
Changer pour : <select name="adminlevel">
    <option value="0"> ---- Choisir ---- </option>
    <option value="0"> Admin level 0 </option>
    <option value="1"> Admin level 1 </option>
    <option value="2"> Admin level 2 </option>
</select><br/><br/><br/>
<input type="submit" class="btn btn-primary" value="valider" name="submit"/>  <a href="userinfo.php" class="btn btn-primary">Annuler</a></div>

</form>
<?php require 'inc/footer.php';?>
