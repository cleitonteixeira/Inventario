<?php
use Model\Solicitacao\SolicitacaoDao;
use Dompdf\Dompdf;

if (!isset($_SESSION)) { session_start();}
if(!isset($_SESSION['idUser'])){
    header("Location:</strong> ../../index.php");
}else{
    require_once '../../vendor/autoload.php';
    $Solicitacao = new SolicitacaoDao();    
    $dSolicitaca = $Solicitacao->readSolicitacao(filter_input(INPUT_GET, 'id'));
    
    $DomPDF = new Dompdf();
    
    ob_start();
    require_once '../../View/Menu/SuperiorPdf.php';   
?>
        <!-- CONTEUDO SITE -->
        <div class="container my-3">
            <!-- CONTEUDO SITE USUÁRIO -->
            <div class="row mb-4">
                
                <blockquote class="blockquote text-center">
                    <p class="mb-0"><strong><u>Requisição de Equipamento</u></strong></p>
                    <footer class="blockquote-footer"><small>Nutribem Refeições Coletivas - Rev. 01.2021</small></footer>
                </blockquote>
                
                <img class="img-fluid float-right" src="<?=BASE;?>images/Nutribem.png" width="150px" />

            </div>
            
            <div class="row pdf-solicitacao mb-1">
                <table class="table table-borderless table-header-pdf">
                    <tr class="mb-2">
                        <th>Solicitação:</th>
                        <th>Unidade:</th>
                        <th>Região:</th>
                        <th>Data SL:</th>
                    </tr>
                    <tr>
                        <td><?=$dSolicitaca->CodSolicitacao;?></td>
                        <td><?=$dSolicitaca->Unidade;?></td>
                        <td><?=$dSolicitaca->Regiao;?></td>
                        <td><?=date("d/m/Y", strtotime($dSolicitaca->dSolicitacao));?></td>
                    </tr>
                    <tr class="mb-2">
                        <th>Requisitante-Responsável:</th>
                        <th>Entrega:</th>
                        <th>Data AC:</th>
                        <th>Status:</th>
                    </tr>
                    <tr>
                        <td><?=$dSolicitaca->Solicitante;?></td>
                        <td><?=date("d/m/Y", strtotime($dSolicitaca->dEnvio));?></td>
                        <td><?=date("d/m/Y", strtotime($dSolicitaca->dAceite));?></td>
                        <td><?=utf8_decode($dSolicitaca->Status);?></td>

                    </tr>
                </table>
            </div>
            <div class="row pdf-solicitacao mb-1">
                <p class="text-justify">Lista de equipamento requisitados, favor conferir todos os itens recebidos com um <strong>X</strong> na frente de cada item.</p>
            </div>
            <div class="row pdf-solicitacao mb-1">
                <table class="table table-bordered table-striped text-center">
                    <thead class="thead-light">
                        <tr class="text-dark">
                            <th>Sequencial</th>
                            <th>Equipamento / Material</th>
                            <th>UN</th>
                            <th>Quant.</th>
                            <th>Recebido</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <div class="row">
                <p class="footer text-right pdf-solicitacao">Copyright &copy; Nutribem <?=date("Y");?></p>
            </div>
        </div>
<?php
    require_once '../../View/Menu/Inferior.php';

    $html = ob_get_clean();
    
    $DomPDF->loadHtml($html);
    
    $options = $DomPDF->getOptions();
    $options->setDefaultFont('Arial');
    $options->set('isRemoteEnabled', TRUE);
    
    $DomPDF->setOptions($options);
    
    $DomPDF->getCss("../../node_modules/bootstrap/compiler/bootstrap.css");
    $DomPDF->render();
    
    $DomPDF->stream(
            "Solicitação de Equipamento ".'TESTE'." .pdf",
            array(
                "Attachment" => false
            )
    );
}