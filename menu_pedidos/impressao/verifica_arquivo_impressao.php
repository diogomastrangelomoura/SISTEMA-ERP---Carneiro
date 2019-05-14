<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");


if(isset($cancela)){
	
	$sel = $db->select("SELECT * FROM arquivos_imprimir WHERE usuario='$id_usuario' ORDER BY id LIMIT 1");
	$imp = $db->expand($sel);
	$arquivo = $imp['arquivo'];	

	$del = $db->select("DELETE FROM arquivos_imprimir WHERE arquivo='$arquivo'");

	if(file_exists("../../z_imprimir/".$arquivo)) {
	  unlink("../../z_imprimir/".$arquivo);
	} 
	echo 0;

} else {
	$sel = $db->select("SELECT * FROM arquivos_imprimir ORDER BY id LIMIT 1");	

	if($db->rows($sel)){
		$imp = $db->expand($sel);
		echo $imp['arquivo'];
	} else {
		echo 0;
	}

}



?>