<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
?>

<?php

$seleciona_produtos = $db->select("SELECT id, nome FROM clientes 
	WHERE nome LIKE '%$campo_busca_produto_modal%'
	ORDER BY nome");

if($db->rows($seleciona_produtos)) {
	$x=1;
	while($line = $db->expand($seleciona_produtos)){
				
		echo '<tr onclick="javascript:seleciona_cliente_venda_modal(\''.$line['nome'].'\','.$line['id'].');" class="passa_clientes" id="linha'.$x.'" data-id="'.$line['id'].'" data-nome="'.$line['nome'].'">';
			echo '<td class="upper">'.$line['id'].' </td>';
			echo '<td class="upper">'.$line['nome'].'</td>';
		echo '</tr>';
		$x++;
	}
} else {
	
	echo '<tr><td colspan="3" align="center"><br>NENHUM CLIENTE ENCONTRADO PARA O NOME PROCURADO.</td></tr>';

}

?>	



