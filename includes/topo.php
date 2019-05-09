<?php
include("admin/class/class.db.php");
include("admin/class/class.seguranca.php");
include("includes/verifica_session.php");
include("includes/verifica_configuracoes_loja.php");
include("includes/verifica_dados_sistema.php");
include("includes/verifica_caixa_aberto.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

   
    <title>SIS ERP v<?php echo $dados_sistema['versao']; ?></title>

    <!-- vendor css -->
    <link href="admin/lib/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="admin/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="css/icones/icones01/icofont.min.css" rel="stylesheet">
    

    <!-- Slim CSS -->
    <link rel="stylesheet" href="admin/css/slim.css">
    <link rel="stylesheet" href="admin/css/custom.css">
    <link rel="stylesheet" href="css/sistema/custom.css">

    <link rel="shortcut icon" href="favicon.ico">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


  </head>
  <body id="body">

    <div class="is_mobile d-block d-md-none"></div> 

    <?php require("menu.php"); ?>
    <?php require("modais.php"); ?>


    <div class="slim-mainpanel">
      <div class="container" id="conteudo_geral">
        
      

    