<?php
include("../admin/class/class.db.php");
include("../admin/class/class.seguranca.php");


$arquivo = fopen ('prod_cod.txt', 'r');
$x=1;
while(!feof($arquivo)){

	$linha = fgets($arquivo, 1024);
	//echo $linha.'<br />';
    $linha = utf8_encode(trim($linha));
	//$insert = $db->select("INSERT INTO produtos (produto) VALUES ('$linha')");
	$update = $db->select("UPDATE produtos SET codigo='$linha' WHERE id='$x' LIMIT 1");


	$x++;
}
fclose($arquivo);
?>