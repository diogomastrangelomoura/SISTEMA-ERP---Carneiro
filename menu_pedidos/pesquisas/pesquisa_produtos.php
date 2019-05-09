<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
?>

<?php

$seleciona_produtos = $db->select("SELECT codigo, produto, preco_venda, estoque FROM produtos 
	WHERE produto LIKE '%$campo_busca_produto_modal%' OR codigo LIKE '%$campo_busca_produto_modal%' 
	ORDER BY produto");

if($db->rows($seleciona_produtos)) {
	$x=1;
	while($line = $db->expand($seleciona_produtos)){
				
		echo '<tr onclick="javascript:seleciona_produto_venda_modal('.$line['codigo'].');" class="passa_produtos" id="linha'.$x.'" data-id="'.$line['codigo'].'">';
			echo '<td class="upper">'.$line['produto'].'</td>';
			echo '<td>R$ '.number_format($line['preco_venda'],2,",",".").'</td>';
			echo '<td align="right">'.$line['estoque'].'</td>';
		echo '</tr>';
		$x++;
	}
} else {
	
	echo '<tr><td colspan="3" align="center"><br>NENHUM PRODUTO ENCONTRADO PARA O TERMO PROCURADO.</td></tr>';

}

?>	



