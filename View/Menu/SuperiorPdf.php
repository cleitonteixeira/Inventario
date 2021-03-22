<?php
//$d = filter_input(INPUT_SERVER, 'SERVER_NAME') == "localhost" ? "/intranet" : "";
$d = filter_input(INPUT_SERVER, 'SERVER_NAME') == "localhost" ? "" : "";
define("BASE", filter_input(INPUT_SERVER, 'REQUEST_SCHEME').'://'.filter_input(INPUT_SERVER, 'SERVER_NAME').''.$d.''.'/Inventario/');
?>
<!doctype html>
<html lang="pt_BR">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?=BASE;?>node_modules/bootstrap/compiler/bootstrap.css" />
        <link rel="stylesheet" href="<?=BASE;?>node_modules/bootstrap/compiler/style.css" />        
        <link rel="stylesheet" href="<?=BASE;?>node_modules/bootstrap/compiler/PDF.css" />        
        <link rel="stylesheet" href="<?=BASE;?>node_modules/bootstrap-icons/font/bootstrap-icons.css" />

        <title>Intranet Nutribem</title>
    </head>
    <body>