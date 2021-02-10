<?php
require_once '../vendor/autoload.php';

if (!isset($_SESSION)) {
    session_start();
}

$u = new \Model\Usuario\UsuarioDao;
$uBean = new \Model\Usuario\UsuarioClass;

$Login = filter_input(INPUT_POST, 'login');
$Senha = filter_input(INPUT_POST, 'senha');

if(isset($Login) && !empty($Login) && isset($Senha) && !empty($Senha)){
    
    $uBean->setLogin(addslashes($Login));
    $uBean->setSenha(addslashes($u->cript($Login, $Senha)));
    
    
    echo $uBean->getLogin();
    echo $uBean->getSenha();
    
    
    if($u->logar($uBean) == true){
        if(isset($_SESSION['idUser'])){
            header("Location: ../");
        }else{
            session_destroy();
            header("Location: ../");
        }
    }else{
        session_destroy();
        header("Location: ../");
    }
    
}else{
    session_destroy();
    header("Location: ../");
}
