<?php

function input($id){
	$value = htmlspecialchars(isset($_POST[$id]) ? $_POST[$id] : '');//ternaire: if plus legé 
	return "<input type='text' class='form-control' id='$id' name='$id' value='$value' size=10 maxlength=10 title='nom utilisateur, 10 caractères maximum, interdit aux caractéres spéciaux'";
}

?>
