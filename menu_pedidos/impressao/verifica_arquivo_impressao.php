<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");

$sel = $db->select("SELECT * FROM arquivos_imprimir ORDER BY id LIMIT 1");
if($db->rows($sel)){
	$imp = $db->expand($sel);
	echo $imp['arquivo'];
} else {
	echo 0;
}

?>