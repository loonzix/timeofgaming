<?php require_once 'inc/functions.php';?>
<?php require_once 'inc/db.php';?>
<?php require 'inc/header.php';
logged_only()?>
<?php
$user_id = $_SESSION['auth']->admin_level;
if($user_id >= 1){

}else{
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acc&eacute;der &agrave; cette page";
    header('Location: account.php');
    exit();
}?>
<?php
//exec("cmdkill.bat");
$kill = 'taskkill /IM srcds.exe /F';
$start = 'start /high /wait C:\Users\Administrateur\Desktop\DevServer\GarrysMod\srcds.exe -console -game ttt_vessel +map clue +gamemode terrortown +fps_max 600 -maxplayers 24 -autoupdate -port 27015 -tickrate 100';
if(isset($_POST['serveron'])){
    echo 'Serveur ouvert !';
    exec($start);
}

if(isset($_POST['serveroff'])){
    echo 'Serveur close !';
    shell_exec($kill);
}

if(isset($_POST['serverreboot'])){
    echo 'Reboot effectu&eacute; !';
    shell_exec($kill);
    sleep (2);
    shell_exec($start);

}
if(isset($_POST['servercheck'])){
    $process = shell_exec('tasklist');
    if (preg_match("/\bsrcds.exe\b/i", $process)) {
        echo 'Le processus recherch&eacute; est lanc&eacute;<br />';
    }
    else {
        echo 'Le processus recherch&eacute; n\'est pas lanc&eacute;<br />';
    }
}
?>

<div align="center">
    <h2>Administration</h2>
    <br /><br />
    <form method="POST"action="">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Nom du serveur</th>
                <th>Start</th>
                <th>Stop</th>
                <th>Reboot</th>
                <th>Check</th>
            </tr>
            </thead>
            <tbody>
            <tr class="active">
                <td>1</td>
                <td>Garry's mod TTT</td>
                <td><input type="submit" class="btn btn-success" name="serveron" value="ON"/></td>
                <td><input type="submit" class="btn btn-danger" name="serveroff" value="OFF"/></td>
                <td><input type="submit" class="btn btn-warning" name="serverreboot" value="REBOOT"/></td>
                <td><input type="submit" class="btn btn-primary" name="servercheck" value="CHECK"/></td>
            </tr>
            </tbody>
        </table>

    </form>
    <?php
    if(isset($erreur))
    {
        echo '<font color="red">'.$erreur.'</front>';
    }
    ?>
</div>

<?php require 'inc/footer.php';?>
