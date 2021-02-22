<?php
use Model\Categoria\CategoriaDao;

if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    include ("login.php");
}else{
    require_once '../../vendor/autoload.php';

    require_once '../../View/Menu/Superior.php';
    
    $C = new CategoriaDao();
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="col-8 mr-auto">
                    <div class="card">
                        <div class="card-header card-header-inventario">
                            <h4 class="card-title mb-2">Cadastro Categoria</h4>
                        </div>
                        <div class="card-body">
                            <form class="my-2" action="Salvar.php" enctype="multipart/form-data" method="post" data-toggle="validator">
                                <div class="form-group row">
                                    <label for="Equipamento" class="col-sm-2 col-form-label">Categoria:</label>
                                    <div class="col-sm-8 ml-0">
                                        <input type="text" class="form-control" name="Categoria" id="Categoria" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Descricao" class="col-sm-2 col-form-label">Descrição:</label>
                                    <div class="col-sm-8 ml-0">
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
                <div class="col-4">
                    <div class="card">
                        <div class="card-header card-header-inventario">
                            <h4 class="card-title mb-2">Categorias Cadastradas</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?=$C->read();?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php
    require_once '../../View/Menu/Inferior.php';
}