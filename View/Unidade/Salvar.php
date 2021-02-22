<?php
use Model\Unidade\UnidadeClass;
use Model\Unidade\UnidadeDao;
    
if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    header("Location: ../../");
}else{
    require_once '../../vendor/autoload.php';

    require_once '../../View/Menu/Superior.php';

    $Unidade = new UnidadeClass();
    $E = new UnidadeDao();

    if( filter_input(INPUT_POST, 'Unidade') == 'Cadastro' ){
        $Unidade->setIdUsuario(utf8_encode(filter_input(INPUT_POST, 'Usuario')));
        $Unidade->setNome(utf8_encode(filter_input(INPUT_POST, 'Nome')));
        $Unidade->setIdRegiao(utf8_encode(filter_input(INPUT_POST, 'Regiao')));
        if($E->create($Unidade)){
?>
        <!-- CONTEUDO SITE -->
        <div class="container">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                <div class="col-6 mr-auto">
                    <div class="alert alert-success" role="alert">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Unidade Cadastrada</h5>
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
                window.location.href = "<?=BASE?>View/Unidade/Cadastro.php";
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
                window.location.href = "<?=BASE?>View/Unidade/Cadastro.php";
            }, 5000);
        </script>
<?php
        }
    }
    require_once '../../View/Menu/Inferior.php';
}