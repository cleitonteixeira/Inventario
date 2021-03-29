<?php
use Model\Solicitacao\SolicitacaoDao;
use Model\Equipamento\EquipamentoDao;

if (!isset($_SESSION)) { session_start(); }
if(!isset($_SESSION['idUser'])){
    header("Location: ../../index.php");
}else{
    
    require_once '../../vendor/autoload.php';
    require_once '../../View/Menu/Superior.php';

    $Solicitacao = new SolicitacaoDao();    
    $Equipamento = new EquipamentoDao();    
    $dSolicitaca = $Solicitacao->readSolicitacao(filter_input(INPUT_GET, 'id'));
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header-inventario">
                            <h4 class="card-title mb-0">Requisição: <?=$dSolicitaca->CodSolicitacao; ?> </h4>    
                        </div>
                        <div class="card-body">
                            <form method="post" action="Salvar.php" enctype="multipart/form-data" data-toggle="validator">
                                <div class="row">
                                    
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mDestino" class="col-form-label">Unidade Destino:</label>
                                            <input type="text" readonly class="form-control" id="mDestino" value="<?=utf8_decode($dSolicitaca->Unidade);?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mSituacao" class="col-form-label">Requisição Tipo:</label>
                                            <input type="text" readonly class="form-control" id="mSituacao" value="<?=utf8_decode($dSolicitaca->Tipo);?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="Solicitante" class="col-form-label">Solicitante:</label>
                                            <input type="text" readonly class="form-control" id="Solicitante" value="<?=utf8_decode($dSolicitaca->Solicitante);?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="lDate" class="col-form-label">Previsão de Envio:</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" id="lDate" name="lDate" required data-error="Selecione uma data." <?=$dSolicitaca->Status === 'Andamento' || $dSolicitaca->Status === 'Finalizada'  ? 'value="'.date("d/m/Y", strtotime($dSolicitaca->dEnvio)).'" readonly' : '' ?>>
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2 mt-2 border-top">
                                            <p class="text-muted mt-3">Lista de Equipamentos:</p>
                                            <table class="table table-striped table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nome</th>
                                                        <th>Categoria</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?=$Equipamento->readRequest( filter_input( INPUT_GET, 'id' ) );?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <?php if( $dSolicitaca->Status == 'Andamento' || $dSolicitaca->Status == 'Finalizada' ){ ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <p>Data programada por <strong><?=$dSolicitaca->Estoque?></strong> em <strong><?=date("d/m/Y", strtotime($dSolicitaca->dAceite))?></strong>.</p>
                                        </div>
                                    </div>
                                </div>
                                <?php } 
                                if($dSolicitaca->Status === 'Nova'){ ?>
                                <div class="row mt-3">
                                    <div class="col">
                                        <input type="hidden" name="Solicitacao" value="Aceite" />
                                        <input type="hidden" name="idSolicitacao" value="<?=$dSolicitaca->idSolicitacao;?>" />
                                        <button type="submit" class="btn btn-outline-success btn-block">Aceitar</button>
                                    </div>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    require_once '../../View/Menu/Inferior.php';
}