<?php require_once 'inc/functions.php';?>
<?php require 'inc/db.php';?>
<?php require 'inc/header.php';?>

<?php

    $req = $pdo->query('SELECT * FROM news ORDER BY date DESC');
?>

<div class="row">
    <h1>Actualités</h1>
    <br /><br />
    <?php
    while ($new = $req->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="panel panel-default">
        <div class="panel-heading"><strong>Titre</strong> : <?php echo $new['titre']; ?></div>
            <div class="panel-body">
                <?php echo $new['contenu']; ?>
                <br /><br />
                <div align="right"><?php echo date("d/n/Y G:i",strtotime($new['date'])); ?>
            </div>
        </div>
        </div>
    <?php
    }

    ?>
    </div>
</div>
<?php require 'inc/footer.php';?></html>