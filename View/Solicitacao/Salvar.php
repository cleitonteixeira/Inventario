<?php
use Model\Solicitacao\SolicitacaoDao;
use Model\Solicitacao\SolicitacaoClass;

if(!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    header("Location: ../../index.php");
}else{
    if(!filter_input(INPUT_POST, 'Solicitacao') == "Aceite"){
        header("Location: ../../index.php");
    }
    require_once '../../vendor/autoload.php';
    require_once '../../View/Menu/Superior.php';
    $Solicitacao = new SolicitacaoClass();
    $Solicita = new SolicitacaoDao();
    
    
    $Solicitacao->setIdSolicitacao( filter_input(INPUT_POST, 'idSolicitacao') );
    $Solicitacao->setIdEstoque( $_SESSION['idUser'] );
    $Solicitacao->setDAceite( date("Y-m-d") );
    $Solicitacao->setDEnvio( filter_input(INPUT_POST, 'lDate') );
    
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                
            </div>
        </div>
<?php
    require_once '../../View/Menu/Inferior.php';
}