<?php
require ("../class/class.db.php");


function gera_codebar(){

	$x = preg_replace("/[^0-9]/", "", uniqid(time()));

	$db = new DB();
	$sql = $db->select("SELECT id FROM produtos WHERE codigo='$x' LIMIT 1");
	if(!$db->rows($sql)){
		return $x;
	} else {
		gera_codebar();
	}

}

echo gera_codebar();


?>
