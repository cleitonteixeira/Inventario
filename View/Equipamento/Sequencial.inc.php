<?php
use Model\Equipamento\EquipamentoDao;

if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    header("Location: ../../");
}else{
    require_once '../../vendor/autoload.php';

    function gSequencial($Categoria){
        $e = new EquipamentoDao();
        
        $d = array();
        
        $Sequencia = ["Sequencia" => $e->createSequencial($Categoria)];
        
        array_push( $d, $Sequencia );
        
        echo json_encode($d);
    }
    
    if(!empty(filter_input(INPUT_POST, 'Sequencial'))){
        gSequencial(filter_input(INPUT_POST, 'Categoria'));
    }
}