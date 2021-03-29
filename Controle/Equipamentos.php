<?php
use Model\Equipamento\EquipamentoDao;

require_once '../vendor/autoload.php';

$Equipamento = new EquipamentoDao();

$Controle = filter_input(INPUT_POST, 'Equipamento');

if($Controle === 'Lista'){
    
    $pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
    echo $Equipamento->readTableEquipamento($pagina, $qnt_result_pg);

}elseif ($Controle == 'Busca') {
    
    $idEquipamento = filter_input(INPUT_POST, 'idEquipamento', FILTER_SANITIZE_NUMBER_INT);
    echo json_encode($Equipamento->readEDetalhes($idEquipamento));
    
}elseif($Controle === 'ListarEquipamento'){
    
    $Tipo = filter_input( INPUT_POST, 'Tipo', FILTER_SANITIZE_STRING );
    
    $ListEquipamento = filter_input( INPUT_POST, 'ListEquipamento', FILTER_SANITIZE_STRING );
    
    if( $ListEquipamento == '' ){
        $ListEquipamento = 0;
    }
    
    $Unidade = filter_input( INPUT_POST, 'Unidade', FILTER_SANITIZE_NUMBER_INT );
    echo json_encode($Equipamento->readListEquipamento($Tipo, $Unidade, $ListEquipamento));
    
}elseif($Controle === 'AddEquipamento'){
    
    $idEquipamento = filter_input( INPUT_POST, 'idEquipamento', FILTER_SANITIZE_NUMBER_INT );
    
    echo json_encode($Equipamento->readListEquipamentoSingle( $idEquipamento ));
    
}