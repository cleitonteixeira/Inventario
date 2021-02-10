<?php
use Model\Cliente\ClienteDao;

require_once '../vendor/autoload.php';

$Cliente = new ClienteDao();

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
echo $Cliente->buscaClientes($pagina, $qnt_result_pg);
