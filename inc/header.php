
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';
    if(session_status() == PHP_SESSION_NONE){
session_start(); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <link rel="icon" href="/img/icon.ico">

    <title>Administration</title>

    <!-- Bootstrap core CSS -->
    <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Time Of Gaming</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if(isset($_SESSION['auth'])): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Administration
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" class="center-menu">
                        <?php
                        $admin_level_grade = $_SESSION['auth']->admin_level;
                        if($admin_level_grade >= 1): ?>
                            <li><a href="administration.php"><i class="fa fa-server"></i> Server</a></li>
                            <?php if($admin_level_grade >= 2): ?>
                                <li><a href="administrationweb.php"><i class="fa fa-globe"></i> Web</a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user fa-2x"></i>
                        <span class="caret"></span>
                    </a>
                <?php if(isset($_SESSION['auth'])): ?>
                    <ul class="dropdown-menu" class="center-menu">
                        <li><a href="account.php">Mon compte</a></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Se déconnecter</a></li>
                    </ul>
                <?php else: ?>
                    <ul class="dropdown-menu" class="center-menu">
                        <li><a href="register.php">S'inscrire</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal">Se connecter</a></li>
                    </ul>
                <?php endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form method="POST" action="login.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Connexion</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group margin-bottom-sm">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                        <input class="form-control" type="text" name="username" placeholder="Email address">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label><br/>
                            <input type="checkbox" name="remember" value="1"/>Se souvenir de moi
                        </label>
                    </div>
                </div>


                <div class="modal-footer">
                    <a href="forget.php" class="btn btn-warning">Mot de passe perdu</a>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div class="container">

    <?php if(isset($_SESSION['flash'])){
         foreach($_SESSION['flash'] as $type => $message) ?>
            <div class="alert alert-<?php $type ?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?php $message; ?>
            </div>

        <?php }
        unset($_SESSION['flash']); ?>

