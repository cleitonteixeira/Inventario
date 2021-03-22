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
        <link rel="stylesheet" href="<?=BASE;?>node_modules/bootstrap-select/dist/css/bootstrap-select.min.css" />
        <link rel="stylesheet" href="<?=BASE;?>node_modules/bootstrap-icons/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="<?=BASE;?>codes/css/bootstrap-datepicker.min.css" />

        <title>Intranet Nutribem</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-ligth bg-light" >
            <div class="container">
                <a class="navbar-brand h1 mb-0" href="<?=BASE?>">Nutribem</a>
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarSite">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSite">
                  
                    <!-- Menu Principal -->
                    <?php
                    if($_SESSION['Acesso'] <= 2){
                    ?>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="NavLancamento" href="#">Equipamento</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=BASE;?>View/Equipamento/Listar.php">Listar</a>
                                <a class="dropdown-item" href="<?=BASE;?>View/Solicitacao/NovaSolicitacao.php">Solicitação</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="NavLancamento" href="#">Relatório</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item">Solicitação</a>
                            </div>
                        </li>
                    </ul>
                    <?php
                    }
                    ?>
                    <!-- Fim Menu Principal -->

                    <!-- Menu Administração -->
                    <?php
                    if($_SESSION['Acesso'] <= 1){
                    ?>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="NavLancamento" href="#">Solicitações</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=BASE;?>View/Solicitacao/Nova.php">Novas</a>
                                <a class="dropdown-item" href="<?=BASE;?>View/Solicitacao/Andamento.php">Andamento</a>
                                <a class="dropdown-item" href="<?=BASE;?>View/Solicitacao/Todas.php">Finalizadas</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="NavLancamento" href="#">Cadastro</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=BASE;?>View/Equipamento/Cadastro.php">Equipamento</a>
                                <a class="dropdown-item" href="<?=BASE;?>View/Categoria/Cadastro.php">Categoria</a>
                                <a class="dropdown-item" href="<?=BASE;?>View/Unidade/Cadastro.php">Unidade</a>
                                <a class="dropdown-item" href="<?=BASE;?>View/Regiao/Cadastro.php">Região</a>
                            </div>
                        </li>
                    </ul>
                    <?php
                    }
                    ?>
                    <!-- Fim Menu Administração -->
                    
                    <!-- Menu de Usuário -->
                    <ul class="navbar-nav ml-auto">
                        <span class="navbar-text">Olá, <?=$_SESSION['Nome'];?>!</span>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="navConfig">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                </svg>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item">Dados da Usuário</a>
                                <a class="dropdown-item">Trocar de Sistema</a>
                                <a class="dropdown-item" href="<?=BASE;?>Controle/Logout.php">Sair</a>
                            </div>
                        </li>
                    </ul>
                    <!-- Fim Menu de Usuário -->
                </div>
            </div>
        </nav>
        <!-- FIM MENU -->

