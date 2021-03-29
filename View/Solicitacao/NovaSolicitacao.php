<?php
use Model\Unidade\UnidadeDao;
use Model\Equipamento\EquipamentoDao;

if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    header("Location: ../../index.php");
}else{
    require_once '../../vendor/autoload.php';
    require_once '../../View/Menu/Superior.php';
    $Unidade = new UnidadeDao();
    $Equipamento = new EquipamentoDao();
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header-inventario">
                            <h4 class="card-title mb-2">Solicitação de Equipamento(s)</h4>
                        </div>
                        <div class="card-body">
                            <form class="my-2" action="Salvar.php" enctype="multipart/form-data" method="post" data-toggle="validator">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label for="Unidade" class="col-sm-2 col-form-label">Unidade:</label>
                                            <div class="col-sm-10">
                                                <select class="selectpicker form-control dropdown" name="Unidade" id="Unidade" title="Selecione uma Unidade" data-size="5" data-live-search="true" required >
                                                    <?=$Unidade->readList()?>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <legend class="col-form-label col-sm-2 float-sm-left">Tipo:</legend>
                                            <div class="col-sm-10 mt-2">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="form-check-input" checked name="tipoRadio" type="radio" id="tipoCheckBox1" value="Solicitação">
                                                    <label class="form-check-label" for="tipoCheckBox1">Solicitação</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="form-check-input" name="tipoRadio" type="radio" id="tipoCheckBox2" value="Devolução">
                                                    <label class="form-check-label" for="tipoCheckBox2">Devolução</label>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mt-4">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-12 col-form-label text-center">
                                                <button class="btn btn-outline-info" onclick="listarEquipamento()" type="button" name="addEquipamento"><i class="bi bi-file-earmark-plus"></i> Adicionar Equipamento</button>
                                            </label>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <table class="table table-striped">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Sequencial</th>
                                                        <th>Equipamento</th>
                                                        <th>Categoria</th>
                                                        <th class="text-center">Confirmar</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody id="tableSolicitacaoEquipamento">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mt-4">
                                    <div class="col">
                                        <input type="hidden" name="idEquipamentosList" id="idEquipamentosList" required />
                                        <input type="hidden" name="Solicitacao" id="Solicitacao" value="Nova" />
                                        <button class="btn btn-outline-success btn-block"><i class="bi bi-check2-square"></i> Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="selectEquipamentoModal" tabindex="-1" aria-labelledby="selectEquipamentoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="selectEquipamentoModalLabel">Selecione o(s) Equipamento(s)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Sequencial</th>
                                    <th>Equipamento</th>
                                    <th>Categoria</th>
                                    <th>Adicionar</th>
                                </tr>
                            </thead>
                            <tbody id="table-equipamento">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="selectEquipamentoModalError" tabindex="-1" aria-labelledby="selectEquipamentoModalErrorLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Selecione a Unidade primeiro depois clique em adicionar equipamentos.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    require_once '../../View/Menu/Inferior.php';
}