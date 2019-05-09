<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");


if(isset($verifica_senha)){

	$del = $db->select("SELECT id FROM configuracoes WHERE senha_cancelamento='$senha_cancelamento' LIMIT 1");	
	if(!$db->rows($del)){
		echo 0;
		exit();
	}

}


	///BAIXA DO ESTOQUE//
	$sil = $db->select("SELECT id_produtos, quantidade FROM produtos_venda WHERE id_venda='$id_venda_cancela'");
	while($line = $db->expand($sil)){
		$id_prd = $line['id_produtos'];
		$qtd_prd = $line['quantidade'];
		$baixa = $db->select("UPDATE produtos SET estoque=estoque+$qtd_prd WHERE id='$id_prd' LIMIT 1");	
	}

	
$del = $db->select("DELETE FROM produtos_venda WHERE id_venda='$id_venda_cancela'");
$del = $db->select("DELETE FROM pagamentos_vendas WHERE id_venda='$id_venda_cancela'");
$del = $db->select("DELETE FROM contas_clientes WHERE id_venda='$id_venda_cancela'");
$del = $db->select("DELETE FROM vendas WHERE id='$id_venda_cancela' LIMIT 1");
			
echo 1;
	
?>
