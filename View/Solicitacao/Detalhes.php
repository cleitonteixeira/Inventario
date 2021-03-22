<?php
use Model\Solicitacao\SolicitacaoDao;

if (!isset($_SESSION)) { session_start(); }
if(!isset($_SESSION['idUser'])){
    header("Location: ../../index.php");
}else{
    
    require_once '../../vendor/autoload.php';
    require_once '../../View/Menu/Superior.php';

    $Solicitacao = new SolicitacaoDao();    
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
                                            <label for="mSequencial" class="col-form-label">Sequencial:</label>
                                            <input type="text" readonly class="form-control" id="mSequencial" value="<?=$dSolicitaca->Regiao_idRegiao.'.'.$dSolicitaca->idUnidade.'.'.$dSolicitaca->Sequencial;?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mEquipamento" class="col-form-label">Equipamento:</label>
                                            <input type="text" readonly class="form-control" id="mEquipamento" value="<?=utf8_decode($dSolicitaca->Equipamento);?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mUnidade" class="col-form-label">Unidade Atual:</label>
                                            <input type="text" readonly class="form-control" id="mUnidade" value="<?=utf8_decode($dSolicitaca->UnidadeAtual);?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mDestino" class="col-form-label">Unidade Destino:</label>
                                            <input type="text" readonly class="form-control" id="mDestino" value="<?=utf8_decode($dSolicitaca->Unidade);?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mDescricao">Descrição:</label>
                                            <textarea class="form-control" id="mDescricao" readonly ><?=utf8_decode($dSolicitaca->Descricao);?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mSituacao" class="col-form-label">Requisição Tipo:</label>
                                            <input type="text" readonly class="form-control" id="mSituacao" value="<?=utf8_decode($dSolicitaca->Tipo);?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mUnidade" class="col-form-label">Previsão de Envio:</label>
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