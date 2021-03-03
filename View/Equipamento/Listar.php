<?php
use Model\Regiao\RegiaoDao;
use Model\Equipamento\EquipamentoDao;

if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    header("Location: ../../");
}else{
    require_once '../../vendor/autoload.php';

    require_once '../../View/Menu/Superior.php';
    $Regiao = new RegiaoDao();
    $Equipamento = new EquipamentoDao();
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header card-header-inventario">
                            <h4 class="card-title mb-0">Lista Equipamento</h4>
                        </div>
                        <div class="card-body">
                            <form class="mr-auto">
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="sCodigo" placeholder="Pesquisar por código..."/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <span id="TableEquipamentos"></span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                     <div class="card">
                        <div class="card-header card-header-inventario">
                            <h5 class="card-title mb-2">Código Região</h5>
                        </div>
                         <div class="card-body">
                             <ul class="list-group list-group-flush font-regiao-list">
                                <?=$Regiao->readListL()?>
                            </ul>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalEquipamento" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Detalhes Equipamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mSequencial" class="col-form-label">Sequencial:</label>
                                            <input type="text" readonly class="form-control" id="mSequencial" value="3.5.100001">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mEquipamento" class="col-form-label">Equipamento:</label>
                                            <input type="text" readonly class="form-control" id="mEquipamento" value="3.5.100001">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mCategoria" class="col-form-label">Categoria:</label>
                                            <input type="text" readonly class="form-control" id="mCategoria" value="3.5.100001">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mSituacao" class="col-form-label">Situação:</label>
                                            <input type="text" readonly class="form-control" id="mSituacao" value="3.5.100001">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mDescricao">Descrição:</label>
                                            <textarea class="form-control" id="mDescricao" readonly ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mResponsavel" class="col-form-label">Responsável:</label>
                                            <input type="text" readonly class="form-control" id="mResponsavel" value="3.5.100001">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            <label for="mUnidade" class="col-form-label">Unidade/Região:</label>
                                            <input type="text" readonly class="form-control" id="mUnidade" value="3.5.100001">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row my-2">
                                
                                <div class="col-md-6"><form action="Solicitacao.php" method="post"><input type="hidden" name="tSolicita" value="Devolucao"><input type="hidden" name="dEquipamento" id="dEquipamento" ><button type="submit" class="btn btn-outline-danger btn-block">Devolver</button></form></div>
                                
                                <div class="col-md-6"><form action="Solicitacao.php" method="post"><input type="hidden" name="tSolicita" value="Solicitacao"><input type="hidden" name="sEquipamento" id="sEquipamento" ><button type="submit" class="btn btn-outline-success btn-block">Solicitar</button></form></div>
                                
                            </div>
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