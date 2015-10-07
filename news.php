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
$reqnews = $pdo->query('SELECT * FROM news ORDER BY date DESC');
?>
<table class="table table-striped table-hover ">
    <thead>
    <tr>
        <th>#</th>
        <th>Titre</th>
        <th>Editer</th>
        <th>Supprimer</th>
    </tr>
    </thead>
    <tbody>
<?php while ($new = $reqnews->fetch(PDO::FETCH_ASSOC)){ ?>
    <tr class="active">
        <td><?php echo $new['id']; ?></td>
        <td><div align="left"><?php echo $new['titre'];?></div></td>
        <td><a href="edit.php?id=<?php echo$new['id'] ?>" class="btn btn-primary">Editer</a></td>
        <td><a href="news/suppr.php?id=<?php echo$new['id'] ?>" class="btn btn-danger">Supprimer</a></td>
    </tr>
    <?php
}
?>
    </tbody>
</table>
<?php require 'inc/footer.php';?>
