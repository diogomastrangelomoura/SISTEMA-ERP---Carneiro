<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
?>

<form id="BuscaProdutosModal" action="menu_clientes/pesquisas/pesquisa_clientes.php">
	<div class="form-group icones-campo2">		   
	    <input type="text" class="form-control passa_clientes  upper" placeholder="NOME DO PRODUTO OU CÓDIGO" autocomplete="off" name="campo_busca_produto_modal" id="campo_busca_produto_modal" required>
	    <f class="icofont-search"></f>	
	</div>
</form>	

<div class="row">
<div class="col-md-12">

<table class="table table-hover table_passa_produtos">
	
	<thead>
    	<tr>
        	<th width="100">ID</th>
            <th >Cliente</th>            
		</tr>
    </thead>

<tbody id="resultado_pesquisa">    

	<tr><td colspan="3" align="center"><br>PESQUISE POR NOME NO CAMPO ACIMA</td></tr>

</tbody>
</table>

</div>
</div>

<script src="javascript/pedidos.js"></script>
<script src="javascript/teclas_atalho.js"></script>
