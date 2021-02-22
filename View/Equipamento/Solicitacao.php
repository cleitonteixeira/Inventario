<?php
use Model\Categoria\CategoriaDao;
use Model\Unidade\UnidadeDao;
use Model\Equipamento\EquipamentoDao;

if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    include ("../../");
}else{
    require_once '../../vendor/autoload.php';

    require_once '../../View/Menu/Superior.php';
    $Categoria = new CategoriaDao();
    $Unidade = new UnidadeDao();
    $Equipamento = new EquipamentoDao();
    
    $Tipo = filter_input(INPUT_POST, "tSolicita");
    $idEquipamento = filter_input(INPUT_POST, "sEquipamento");
    $nTipo = '';
    if($Tipo === 'Devolucao'){
        $nTipo = 'Devolução';
    }elseif ($Tipo === 'Solicitacao') {
        $nTipo = 'Solicitação';
    }
    $E = $Equipamento->readEDetalhes($idEquipamento);
?>
<!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header-inventario">
                            <h4 class="card-title mb-2">Formulário de <?=$nTipo?> de Equipamento</h4>
                        </div>
                        <div class="card-body">
                            <form class="my-2" action="Salvar.php" enctype="multipart/form-data" method="post" data-toggle="validator">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mSequencial" class="col-form-label">Sequencial:</label>
                                            <input type="text" readonly class="form-control" id="mSequencial" value="<?=$E[0]['CodRegiao'].'.'.$E[0]['CodUnidade'].'.'.$E[0]['Sequencial']?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mEquipamento" class="col-form-label">Equipamento:</label>
                                            <input type="text" readonly class="form-control" id="mEquipamento" value="<?=$E[0]['Equipamento']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mCategoria" class="col-form-label">Categoria:</label>
                                            <input type="text" readonly class="form-control" id="mCategoria" value="<?=$E[0]['Categoria']?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mSituacao" class="col-form-label">Situação:</label>
                                            <input type="text" readonly class="form-control" id="mSituacao" value="<?=$E[0]['Situacao']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mDescricao">Descrição:</label>
                                            <textarea class="form-control" id="mDescricao" readonly ><?=$E[0]['Descricao']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mResponsavel" class="col-form-label">Responsável:</label>
                                            <input type="text" readonly class="form-control" id="mResponsavel" value="<?=$E[0]['Responsavel']?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mUnidade" class="col-form-label">Unidade/Região:</label>
                                            <input type="text" readonly class="form-control" id="mUnidade" value="<?=$E[0]['Unidade'].' - '.$E[0]['Regiao']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="UnidadeDestino" class="col-form-label">Unidade Destino:</label>
                                            <select class="selectpicker form-control dropdown" required data-live-search="true" title="Selecione uma Unidade" data-size="5" name="UnidadeDestino" id="UnidadeDestino" >
                                                <?=$Unidade->readList()?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2 mt-4">
                                            <input type="hidden" value="<?=$E[0]['idEquipamento']?>" name="idEquipamento" id="idEquipamento" />
                                            <button type="submit" class="btn btn-lg btn-outline-success btn-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">   <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"></path></svg>
                                                Enviar Solicitação
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php
    require_once '../../View/Menu/Inferior.php';
}
