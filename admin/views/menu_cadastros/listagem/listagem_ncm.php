<?php
include_once("../../../class/class.db.php");
include_once("../../../class/class.seguranca.php");
?>
<div class="table-responsive">
	<table class="table mg-b-0 tx-13">
    	<thead>
			<tr class="tx-10">                      
            	<th class="pd-y-5" width="40">Cód</th>
                <th class="pd-y-5">Descrição</th>                                      
			</tr>
        </thead>
        
        <tbody>

        	<?php 
	        	if(isset($busca) && $busca!=''){
	        		$sql = $db->select("SELECT codigo, descricao FROM fiscal_ncm WHERE codigo LIKE '%$busca%' OR descricao LIKE '%$busca%' ORDER BY descricao");
	        	} else {
	        		$sql = $db->select("SELECT codigo, descricao FROM fiscal_ncm ORDER BY descricao");
	        	}

	        	if($db->rows($sql)){
	        		while($line = $db->expand($sql)){

	        			echo '<tr>';
	        				echo '<td class="upper">'.$line['codigo'].'</td>';
	        				echo '<td class="upper">'.$line['descricao'].'</td>';
	        			echo '</tr>';

	        		}
	        	} else {

	        	}
        	?>



		</tbody>                  	

	</table>
</div>	