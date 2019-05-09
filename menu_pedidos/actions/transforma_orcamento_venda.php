<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");


$sel = $db->select("SELECT * FROM produtos_venda WHERE id_orcamento='$id' ORDER BY id");
while($row = $db->expand($sel)){

	$id_produtos = $row['id_produtos'];
	$valor = $row['valor'];
	$quantidade = $row['quantidade'];

	$insere = $db->select("INSERT INTO produtos_venda (id_produtos, valor, quantidade, id_usuario, user_hash) VALUES ('$id_produtos', '$valor', '$quantidade', '$id_usuario', '$md5_usuario_logado')");

}
			
echo 1;
	
?>
