<?php
	$auth = 0;
    include 'lib/include.php'; 
    include 'partials/header.php'; 

/** Traitement du Formulaire **/

//var_dump($_POST);
$csrf_token = $_SESSION['csrf_token'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    // Traitement d'erreur pour une requête non valide (CSRF)
    exit('Requête non valide');
  }

  if(isset($_POST['username']) && isset($_POST['password'])){

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if(empty($username) || empty($password)){
        setFlash_danger('Veuillez remplir tous les champs');
        header('Location: login.php');
        die();
      }

    $query = 'SELECT * FROM users WHERE username = :username';
    
    // Check if the user has tried to log in too many times
    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 3) {
      // Check if the lock out time has passed
      if (isset($_SESSION['last_failed_login']) && (time() - $_SESSION['last_failed_login']) < 60) {
        setFlash_danger('Trop de tentatives de connexion. Veuillez réessayer dans une minute.');
        header('Location: login.php');
        die();
      } else {
        // Reset the login attempts and last failed login time
        $_SESSION['login_attempts'] = 0;
        unset($_SESSION['last_failed_login']);
      }
    }

    $select = $db->prepare($query);
    $select->bindValue('username', $username);
    $select->execute();
    
    $user = $select->fetch();

    if($user){
      $passwordHash = $user['password'];
      if (password_verify($password, $passwordHash)) {
        $_SESSION['Auth'] = $user;
        setFlash('Vous étes maintenant connecté');
        header('Location:' . WEBROOT . 'admin/index.php');
        die();
      }else {
        	// Increment the login attempts
        	if (!isset($_SESSION['login_attempts'])) {
          	$_SESSION['login_attempts'] = 1;
      	}else {
          	$_SESSION['login_attempts']++;
        	}
        	// Store the time of the failed login
        	$_SESSION['last_failed_login'] = time();
  		setFlash_danger("Identifiants incorrects. vous n'avais que 3 tentatives");
        	header('Location: login.php');
        	die();
      }
    }else{
      // Increment the login attempts
      if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 1;
      } else {
        $_SESSION['login_attempts']++;
      }
      // Store the time of the failed login
      $_SESSION['last_failed_login'] = time();
  	setFlash_danger("Identifiants incorrects. vous n'avais que 3 tentatives");
      header('Location: login.php');
      die();
    }
  }
}

/** Inclusion du header **/

 include 'partials/header.php'; 

?>

<h1>Mon formulaire d'authentification</h1>

<form action="#" method="post" >
  <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
	<div class="form-group">
		<label for="username">Nom d'utilisateur</label>
		<?= input('username'); ?>
	</div>
	<div class="form-group">
		<label for="password">Mot de passe</label>
		<input type="password" class="form-control" id="password" name="password">
	</div>
	<button type="submit" class="btn btn-default" id="password">Se connecter</button>
</form>


<?php //include 'lib/debug.php'; ?>
<?php include 'partials/footer.php'; ?>
