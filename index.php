<?php
if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    include ("login.php");
}else{
    require_once 'vendor/autoload.php';
    
    require_once 'View/Menu/Superior.php';

?>
        <!-- CONTEUDO SITE -->
        <div class="container">

            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row my-2">
                
            </div>

        </div>
        
        
        
        
<?php
    require_once 'View/Menu/Inferior.php';
}