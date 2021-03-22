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
    
    if($Solicita->update($Solicitacao)){
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="col-6 mr-auto">
                    <div class="alert alert-success" role="alert">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Entrega Programada.</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Você será redirecionado em 5 segundos.</h6>
                                <a href="Detalhes.php?id=<?=filter_input(INPUT_POST, 'idSolicitacao')?>" class="card-link">Click aqui para voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "<?=BASE?>View/Solicitacao/Detalhes.php?id=<?=filter_input(INPUT_POST, 'idSolicitacao')?>";
            }, 5000);
        </script>
<?php
        }else{
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="col-6 mr-auto">
                    <div class="alert alert-warning" role="alert">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Falha no Formulário.</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Você será redirecionado em 5 segundos.</h6>
                                <a href="Detalhes.php?id=<?=filter_input(INPUT_POST, 'idSolicitacao')?>" class="card-link">Click aqui para voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "<?=BASE?>View/Solicitacao/Detalhes.php?id=<?=filter_input(INPUT_POST, 'idSolicitacao')?>";
            }, 5000);
        </script>
<?php
        }
    require_once '../../View/Menu/Inferior.php';
}