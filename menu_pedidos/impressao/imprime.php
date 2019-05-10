<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_configuracoes_loja.php");

if(file_exists("../../z_imprimir/".$arquivo)){

//IMPRESSÃO VENDA OU ORÇAMENTO//
//if($tipo==1){

	if(!empty($dados_configuracoes['impressora_principal'])){
		$printer_principal = $dados_configuracoes['impressora_principal'];
		if($ph = printer_open($printer_principal)){
	   		$fh = fopen("../../z_imprimir/".$arquivo, "rb");
	   		$content = fread($fh, filesize("../../z_imprimir/".$arquivo));
	   		fclose($fh);
	       
	   		printer_start_doc($ph, "IMPRESSAO"); // Name Document 
			printer_start_page($ph); // Start Logo
		       
		   		printer_set_option($ph, PRINTER_MODE, "RAW");
		   		printer_write($ph, $content);

		   	printer_end_page($ph);
			printer_end_doc($ph);			

			printer_close($ph);
		}
	}

//}


$del = $db->select("DELETE FROM arquivos_imprimir WHERE arquivo='$arquivo'");

if(file_exists("../../z_imprimir/".$arquivo)) {
  unlink("../../z_imprimir/".$arquivo);
} 


} else {
	$del = $db->select("DELETE FROM arquivos_imprimir WHERE arquivo='$arquivo'");	
}

echo 1;

?>