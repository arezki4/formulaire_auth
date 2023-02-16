<?php
function flash(){
	if(isset($_SESSION['Flash'])){
		extract($_SESSION['Flash']);
		unset($_SESSION['Flash']);
		return "<div class='alert alert-$type'>$message</div>";
	}
}

function setflash($message, $type = 'success'){
	$_SESSION['Flash']['message'] = $message;
	$_SESSION['Flash']['type'] = $type;
}

function setflash_danger($message, $type = 'danger'){
	$_SESSION['Flash']['message'] = $message;
	$_SESSION['Flash']['type'] = $type;
}


?>