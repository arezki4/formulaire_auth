<?php
session_start();
if(!isset($auth)){
	if(!isset($_SESSION['Auth']['id'])){
		header('Location:'. WEBROOT .'login.php');
		die();//toujours mettre des die apres des header location pour eviter d'executer du code non authorisé
	}
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];


/*if(!isset($_SESSION['csrf'])){
	$_SESSION['csrf'] = md5(time() + rand());
}

function csrf(){
	return 'csrf=' . $_SESSION['csrf'];
}

function csrfInput(){
	return '<input type="hidden" value="' . $_SESSION['csrf']. '" name="csrf">';
}

function checkCsrf(){
	if(
		(isset($_POST['csrf']) && $_POST['csrf'] == $_SESSION['csrf']) ||
		(isset($_GET['csrf']) && $_GET['csrf'] == $_SESSION['csrf'])
		){
		return true;
	}
	header('Location:' . WEBROOT . '/csrf.php');
	die();
}*/

?>