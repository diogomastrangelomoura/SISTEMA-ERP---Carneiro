<?php
require ("../class/class.db.php");
require ("../class/class.seguranca.php");


	$sel = $db->select("SELECT * FROM produtos WHERE categoria='$categoria' ORDER BY produto");

		if($db->rows($sel)){
			
			echo '<option value="">escolha o produto</option>';

			while($yy = $db->expand($sel)){
				echo '<option value="'.$yy['id'].'" class="upper">'.$yy['produto'].'</option>';
			}


		}  else {

			echo '<option value="">nenhum produto encontrado para esta categoria</option>';

		}

?>