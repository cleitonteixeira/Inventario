<?php
use Model\Solicitacao\SolicitacaoClass;
use Model\Solicitacao\SolicitacaoDao;

if (!isset($_SESSION)) {
    session_start();
}
require_once '../vendor/autoload.php';

$Solicitacao = new SolicitacaoClass();

$Solicita = new SolicitacaoDao();

$Controle = filter_input ( INPUT_POST, 'Equipamento' );

if ($Controle === 'Solicitacao') {
    
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
