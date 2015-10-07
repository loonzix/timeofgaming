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

$req = $pdo->query('SELECT * FROM users');
?>

    <div align="center">
        <h1>Tous les utilisateurs</h1>
        <br /><br />
        <div align="left">
            <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
				<th>Email</th>
                <th>Admin Level</th>
                <th>Editer</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>

            <?php
            while ($user = $req->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="panel panel-default">
                <tr class="active">
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
					<td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['admin_level']; ?></td>
                    <td><a href="edituser.php?id=<?php echo$user['id'] ?>" class="btn btn-primary">Editer</a></td>
                    <td><a href="user/suppr.php?id=<?php echo$user['id'] ?>" class="btn btn-danger">Supprimer</a></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>







<?php require 'inc/footer.php';?>