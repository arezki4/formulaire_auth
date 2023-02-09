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
	    header('Location: account.php');
	    die();
	  	}

	  	if (strlen($password) < 8) {
	       setFlash_danger('Le mot de passe doit avoir au moins 8 caractères et au moins une lettre et un chiffre');
	       header('Location: account.php');
	       die();
	    }

	    if (!preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password) || !preg_match("#[^a-zA-Z0-9]+#", $password)) {
	      setFlash_danger('Le mot de passe doit contenir au moins une lettre, un chiffre et un caractère spécial');
	      header('Location: account.php');
	      die();
	    }

	    if (strlen($username) > 10) {
			   setFlash_danger('Le nom d\'utilisateur ne doit pas dépasser 10 caractères');
			   header('Location: account.php');
			   die();
			}
			if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
				setFlash_danger('Le nom d\'utilisateur ne peut contenir que des lettres et des chiffres');
		    header('Location: account.php');
		    die();
			}

		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


		$query = 'SELECT COUNT(*) FROM users WHERE username = :username';
		$select = $db->prepare($query);
		$select->bindValue('username', $username);
		$select->execute();
		$result = $select->fetchColumn();

		if ($result) {
		  setFlash_danger('Le nom d\'utilisateur existe déjà');
		  header('Location: account.php');
		  die();
		}

		$query = 'INSERT INTO users (username, password) VALUES (:username, :password)';
		$select = $db->prepare($query);
		$select->bindValue('username', $username);
		$select->bindValue('password', $password);
		$res = $select->execute();

		if($res){
				setFlash('Inscription Réussie');
				header('Location: login.php');
				die();
			}
		//var_dump($sql);
	}
}
/** Inclusion du header **/

 include 'partials/header.php'; 

?>

<h1>Creation d'un compte utilisateur</h1>

<form action="#" method="post" >
	<input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
	<div class="form-group">
		<label for="username">Nom d'utilisateur</label>
		<?= input('username'); ?>
	</div>
	<div class="form-group">
		<label for="password">Mot de passe</label>
		<input type="password" class="form-control" id="password" name="password" size=20 maxlength=20>
	</div>
	<button type="submit" class="btn btn-default" id="password">Validée</button>
</form>


<?php //include 'lib/debug.php'; ?>
<?php include 'partials/footer.php'; ?>