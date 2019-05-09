<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
?>

<?php

if(isset($nome_cliente) && !empty($nome_cliente)){

	$seleciona_produtos = $db->select("SELECT id, nome, cpf_cnpj, telefone FROM clientes 
	WHERE nome LIKE '%$nome_cliente%'
	ORDER BY nome");

} else {

	$seleciona_produtos = $db->select("SELECT id, nome, cpf_cnpj, telefone FROM clientes 	
	ORDER BY id DESC LIMIT 20");

}


if($db->rows($seleciona_produtos)) {
	$x=1;
	while($line = $db->expand($seleciona_produtos)){
				
		echo '<tr>';
			echo '<td class="upper">'.$line['id'].' </td>';
			echo '<td class="upper">'.$line['nome'].'</td>';
			echo '<td class="upper">'.$line['cpf_cnpj'].'</td>';
			echo '<td class="upper">'.$line['telefone'].'</td>';
			echo '<td class="upper">
          			<a tabindex="-1" href="javascript:void(0);" onclick="javascript:ficha_cliente('.$line['id'].')" class="thin">
          				<button tabindex="-1" class="btn btn-primary btn-sm"><i class="icofont-edit"></i></button>
          			</a>
          		  </td>';
		echo '</tr>';
		$x++;
	}
} else {
	
	echo '<tr><td colspan="13" align="center">NENHUM CLIENTE ENCONTRADO PARA O NOME PROCURADO.</td></tr>';

}

?>	
