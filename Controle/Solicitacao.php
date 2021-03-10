<?php
use Model\Solicitacao\SolicitacaoClass;
use Model\Solicitacao\SolicitacaoDao;

if (!isset($_SESSION)) {
    session_start();
}
require_once '../vendor/autoload.php';

$Solicitacao = new SolicitacaoClass();

$Solicita = new SolicitacaoDao();

$Controle = filter_input ( INPUT_POST, 'Solicitacao' );

if($Controle === 'Lista'){
    
    $pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
    echo $Solicita->readTableNew($pagina, $qnt_result_pg);
    
}elseif ($Controle === 'Solicitacao') {
    
    $Solicitacao->setIdEquipamento( filter_input( INPUT_POST, 'idEquipamento' ) );
    $Solicitacao->setIdUnidade( filter_input ( INPUT_POST, 'idUnidade') );
    $Solicitacao->setTipo( utf8_encode ( ( filter_input ( INPUT_POST, 'Tipo' ) ) ) );
    $Solicitacao->setIdSolicitante( $_SESSION['idUser'] );
    $Solicitacao->setDSolicitacao( date("Y-m-d") );
    
    $d = array();
    
    $Re = ['Retorno' => $Solicita->create($Solicitacao) ];
    
    array_push($d, $Re );
    
    echo json_encode($d);
}
