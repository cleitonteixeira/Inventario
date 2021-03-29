<?php
if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    header("Location: ../../index.php");
}else{
    require_once '../../vendor/autoload.php';

    require_once '../../View/Menu/Superior.php';
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header-inventario">
                            <h4 class="card-title mb-0">Lista de Requisições</h4>
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
                            <span id="TableSolicitacao"></span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
<?php
    require_once '../../View/Menu/Inferior.php';
}