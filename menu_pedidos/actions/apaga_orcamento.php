<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");

$del = $db->select("DELETE FROM produtos_venda WHERE id_orcamento='$id'");
$del = $db->select("DELETE FROM vendas WHERE id='$id' LIMIT 1");
			
echo 1;
	
?>
