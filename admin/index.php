<?php
include '../lib/include.php';
include '../partials/admin_header.php';

$auth = $_SESSION['Auth']['id'];

$query = 'SELECT username FROM users WHERE id = :id';

$select = $db->prepare($query);
$select->bindValue('id', $auth);
$select->execute();
$user = $select->fetch();

echo '<h1>Bienvenue '.$user['username'].'</h1>';


echo'<div class="row">

    <div class="col-md-12">
        <img style="width: 20%;" alt="Bootstrap Image Preview" src="../img/logo.png" />
    </div>

    <br></br>
    
    <div class="col-sm-4">
        <div class="jumbotron">
            <h2>Déconnexion du Site</h2>
            <a type="button" class="btn btn-danger btn-large" href="../logout.php" > Se Déconnecter </a>
        </div>
    </div>
</div>';

include '../partials/footer.php'; ?>