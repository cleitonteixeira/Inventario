<?php
use Model\Categoria\CategoriaDao;
use Model\Unidade\UnidadeDao;
use Model\Equipamento\EquipamentoDao;

if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    include ("login.php");
}else{
    require_once '../../vendor/autoload.php';

    require_once '../../View/Menu/Superior.php';
    $Categoria = new CategoriaDao();
    $Unidade = new UnidadeDao();
    $Equipamento = new EquipamentoDao();
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="col-8 mr-auto">
                    <div class="card">
                        <div class="card-header card-header-inventario">
                            <h4 class="card-title mb-2">Cadastro Equipamento</h4>
                        </div>
                        <div class="card-body">
                            <form class="my-2" action="Salvar.php" enctype="multipart/form-data" method="post" data-toggle="validator">
                                <div class="form-group row">
                                    <label for="Nome" class="col-sm-3 col-form-label">Equipamento:</label>
                                    <div class="col-sm-9 ml-0">
                                        <input type="text" class="form-control" name="Nome" id="Nome" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Unidade" class="col-sm-3 col-form-label">Unidade:</label>
                                    <div class="col-sm-9 ml-0">
                                        <select required class="selectpicker form-control dropdown" name="Unidade" id="Unidade" title="Selecione uma Unidade" data-size="5" data-live-search="true" required >
                                            <?=$Unidade->readList()?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Categoria" class="col-sm-3 col-form-label">Categoria:</label>
                                    <div class="col-sm-9 ml-0">
                                        <select required class="selectpicker form-control dropdown" name="Categoria" id="Categoria" title="Selecione uma Categoria" data-size="5" data-live-search="true" required >
                                            <?=$Categoria->readList()?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Sequencial" class="col-sm-3 col-form-label">Sequencial:</label>
                                    <div class="col-sm-6 ml-0">
                                        <input type="text" readonly="" class="form-control" name="Sequencial" id="Sequencial" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-sm-3 ml-0">
                                        <button id="gSequencial" type="button" class="btn btn-info">Gerar Sequencial</button>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Descricao" class="col-sm-3 col-form-label">Descrição:</label>
                                    <div class="col-sm-9 ml-0">
                                        <textarea class="form-control" name="Descricao" id="Descricao" required=""></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="hidden" name="Equipamento" value="Cadastro" />
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4 ml-auto">
                    <div class="card">
                        <div class="card-header card-header-inventario">
                            <h4 class="card-title mb-2">Equipamentos por Categoria</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?=$Equipamento->read()?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ECategoria" aria-labelledby="eCategoriaModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eCategoriaModal">Erro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Prineiro selecione a <strong>Categoria</strong> depois clique para gerar o <strong>Sequencial</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
<?php
    require_once '../../View/Menu/Inferior.php';
}