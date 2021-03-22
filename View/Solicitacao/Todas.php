<?php
use Model\Categoria\CategoriaDao;
use Model\Unidade\UnidadeDao;
use Model\Equipamento\EquipamentoDao;

if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    header("Location: ../../index.php");
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
                
            </div>
        </div>
<?php
    require_once '../../View/Menu/Inferior.php';
}