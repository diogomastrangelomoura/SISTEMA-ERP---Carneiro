<div class="col-md-12 top15">

<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");


$total_final_pedido =0;
$qtd_itens_pedido=0;

if(!isset($venda_ja_efetuada)){
	
	$sql = $db->select("SELECT * FROM produtos_venda WHERE id_venda='0' AND id_orcamento='0' AND id_usuario='$id_usuario' AND user_hash='$md5_usuario_logado'  ORDER BY id DESC");

} else {

	$sql = $db->select("SELECT * FROM produtos_venda WHERE id_venda='$venda_ja_efetuada' ORDER BY id DESC");

}

if($db->rows($sql)){
	while($row = $db->expand($sql)){

		echo '';

		$qtd_itens_pedido = ($qtd_itens_pedido+$row['quantidade']);
		$total_final_pedido = ($total_final_pedido+($row['quantidade']*$row['valor']));
		
		$id_produto = $row['id_produtos'];
		$id_controle = $row['id'];
		

		$pg = $db->select("SELECT produto FROM produtos WHERE id='$id_produto' LIMIT 1");
		$var = $db->expand($pg);
		$nome_produto= $var['produto'];

		//POE O ZERO NA QUANTIDADE
		$quan = explode('.', $row['quantidade']);
		
		if($quan[1]=='00'){
			if($row['quantidade']<10){$row['quantidade']= '0'.$quan[0];}	
		} 

		
		echo '<span  style="color:#333">';			

			echo '<strong>'.$row['quantidade'].' x</strong>';			

		echo '</span>';

		
		if(!isset($venda_ja_efetuada)){
		echo '<a tabindex="-1" href="javascript:void(0);" onclick="javascript:exlcui_produto_compra('.$id_controle.');" class="  thin pull-right icone_deleta_item_pedido">
					<button tabindex="-1" class="btn btn-danger btn-sm"><i class="icofont-ui-close"></i></button></a>';
		}

        
        echo '<br>';
        echo '<span class="name_produto_comanda upper corta_texto">'.$nome_produto.'</span>';
        echo '<span class="pull-right text-right">R$ '.number_format($row['valor'],2,",",".").'</span>';
        


        echo '<hr style="margin-top:8px; padding-top:8px">';



	}

	

} else {

	echo '<center>NENHUM ÍTEM ADICIONADO A VENDA.</center>';

}



?>


<input type="hidden" id="soma_qtd_itens" value="<?php echo $qtd_itens_pedido; ?>">
<input type="hidden" id="soma_total_pedido" value="<?php echo $total_final_pedido; ?>">

 

</div>
