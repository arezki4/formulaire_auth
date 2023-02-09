<?php
    $auth =0;
    include 'lib/include.php'; 
    include 'partials/header.php'; 
    //include 'partials/auth.php';
    //include 'lib/db.php';  
?>

<div class="row">

    <h1>Mon Site Bien Securisé</h1>

    <br></br>
    
    <div class="col-sm-4" style="width: 34.3333%;">
        <div class="jumbotron">
            <h2>Connexion au Site</h2>
            <a type="button" class="btn btn-primary btn-large" href="login.php" > Se connecter </a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="jumbotron">
                <h2>Inscription au Site</h2>
                <a type="button" class="btn btn-primary btn-large"  href="account.php" >Inscription</a>
            </div>
    </div>
</div>

<?php //include 'lib/debug.php' ?>
<?php include 'partials/footer.php' ?>


