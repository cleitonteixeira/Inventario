<?php
use Model\Equipamento\EquipamentoClass;
use Model\Equipamento\EquipamentoDao;
    
if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    header("Location: ../../");
}else{
    require_once '../../vendor/autoload.php';

    require_once '../../View/Menu/Superior.php';

    $Equipamento = new EquipamentoClass();
    $E = new EquipamentoDao();
    
    if( filter_input(INPUT_POST, 'Equipamento') == 'Cadastro' ){
        $Equipamento->setNome(utf8_encode(filter_input(INPUT_POST, 'Nome')));
        $Equipamento->setIdUnidade(utf8_encode(filter_input(INPUT_POST, 'Unidade')));
        $Equipamento->setIdCategoria(utf8_encode(filter_input(INPUT_POST, 'Categoria')));
        $Equipamento->setSequencial(utf8_encode(filter_input(INPUT_POST, 'Sequencial')));
        $Equipamento->setDescricao(utf8_encode(filter_input(INPUT_POST, 'Descricao')));

        if($E->create($Equipamento)){
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="col-6 mr-auto">
                    <div class="alert alert-success" role="alert">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Equipamento Cadastrado</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Você será redirecionado em 5 segundos.</h6>
                                <a href="Cadastro.php" class="card-link">Click aqui para voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "<?=BASE?>View/Equipamento/Cadastro.php";
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
                                <h5 class="card-title">Falha no Cadastro</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Você será redirecionado em 5 segundos.</h6>
                                <a href="Cadastro.php" class="card-link">Click aqui para voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "<?=BASE?>View/Equipamento/Cadastro.php";
            }, 5000);
        </script>
<?php
        }
    }
    require_once '../../View/Menu/Inferior.php';
}