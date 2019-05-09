<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");


$sql = $db->select("SELECT id, produto, preco_venda FROM produtos WHERE codigo='$produto_frente_caixa' LIMIT 1");

if($db->rows($sql)){
	$row = $db->expand($sql);	
	echo $row['produto'].'&@&'.$row['preco_venda'].'&@&'.$row['id'];
} else {
	echo 0;
}


?>