<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
?>

<?php

$pesq = $db->select("SELECT * FROM cad_cidade WHERE cidade_id_estado='$estado' ORDER BY cidade_nome");
echo '<option value="">-- ESCOLHA --</option>';
while($est = $db->expand($pesq)){
	echo '<option value="'.$est['cidade_cod_ibge'].'">'.$est['cidade_nome'].'</option>';	
}

?>