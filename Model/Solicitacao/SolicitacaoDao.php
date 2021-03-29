<?php
namespace Model\Solicitacao;

if (!isset($_SESSION)) {
    session_start();
}

class SolicitacaoDao {
    
    public function create(SolicitacaoClass $Solicitacao){
        try{
            \Model\Conexao\Conexao::getConexao()->beginTransaction();

            $sql = "INSERT INTO solicitacao ( Usuario_idUsuario, Unidade_idUnidade, dSolicitacao, Tipo, CodSolicitacao ) VALUES ( ?, ?, ?, ?, ? );";

            $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
            $stmt->bindValue( 1, $Solicitacao->getIdSolicitante() );
            $stmt->bindValue( 2, $Solicitacao->getIdUnidade() );
            $stmt->bindValue( 3, $Solicitacao->getDSolicitacao() );
            $stmt->bindValue( 4, $Solicitacao->getTipo() ); 
            $stmt->bindValue( 5, $this->createCodSo($Solicitacao->getIdUnidade()) ); 
            $stmt->execute();
            $RequestItem = new SolicitacaoClass();
            $RequestItem->setIdItemSolicitacao($Solicitacao->getIdItemSolicitacao());
            $RequestItem->setIdSolicitacao( \Model\Conexao\Conexao::getConexao()->lastInsertId() );
            
            if(!$this->createRequestItem($RequestItem)){
                \Model\Conexao\Conexao::getConexao()->rollBack(); return false; exit;
            }
            \Model\Conexao\Conexao::getConexao()->commit(); return true;
        } catch ( PDOException $ex ){
            \Model\Conexao\Conexao::getConexao()->rollBack(); return false;
        }
    }
    
    public function createCodSo($Unidade){
        try{
            $sql = "SELECT COUNT(s.idSolicitacao) AS Cont, u.idUnidade, r.idRegiao FROM solicitacao s INNER JOIN unidade u ON u.idUnidade = s.Unidade_idUnidade INNER JOIN regiao r ON r.idRegiao = u.Regiao_idRegiao WHERE s.Unidade_idUnidade = ?;";
            $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
            $stmt->bindParam( 1, $Unidade );
            $stmt->execute();
            $R = $stmt->fetch(\PDO::FETCH_OBJ);
            $Cont = $R->Cont+1;
            return "SO.".$R->idRegiao.".".$R->idUnidade.".".date("y").str_pad($Cont, 4, 0, STR_PAD_LEFT) ;
        } catch (PDOException $ex){
            return false;
        }

    }
    
    public function createRequestItem( SolicitacaoClass $Solicitacao ) {
            try{
                $sql = "INSERT INTO itemsolicitacao ( Solicitacao_idSolicitacao, Equipamento_idEquipamento ) VALUES ( ?, ? );";
                
                $LEquipamento = substr( $Solicitacao->getIdItemSolicitacao(), 1);
                $LEquipamento = explode(",", $LEquipamento);
                
                $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
            
                foreach ($LEquipamento as $idEquipamento){
                    $stmt->bindValue( 1, $Solicitacao->getIdSolicitacao() );
                    $stmt->bindValue( 2, $idEquipamento );
                    $stmt->execute();
                    $this->updateStatus( $idEquipamento, 'Reservado' );
                }
                
                return true;
            } catch ( PDOException $ex ) {
                return false;
            }
    }
    
    public function updateStatus( $idEquipamento, $Situacao ) {
        try{
            $sql = "UPDATE equipamento SET Situacao = ? WHERE idEquipamento = ?;";

            $stmt = \Model\Conexao\Conexao::getConexao()->prepare( $sql );
            $stmt->bindValue( 1, $Situacao );
            $stmt->bindValue( 2, $idEquipamento );
            $stmt->execute();
            return true;
        } catch ( PDOException $e ){
            return false;
        }
    }
    public function readTableNew( $pagina,$qnt_result_pg) {
        $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;
        $sql = "SELECT s.idSolicitacao, s.CodSolicitacao, s.Tipo, u.Nome AS Solicitante, un.Nome AS Unidade FROM solicitacao s INNER JOIN usuarios u ON u.idusuarios = s.Usuario_idUsuario INNER JOIN unidade un ON un.idUnidade = s.Unidade_idUnidade WHERE s.Status = 'Nova' LIMIT ?, ?";
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->bindParam(1, $inicio, \PDO::PARAM_INT);
        $stmt->bindParam(2, $qnt_result_pg, \PDO::PARAM_INT); 
        $stmt->execute();
        $TableSolicitacao = '<table class="table table-hover table-bordered"><thead class="thead-light"><tr><th scope="col">ID</th><th scope="col">Destino</th><th scope="col">Solicitante</th><th scope="col">Tipo</th><th scope="col">Detalhes</th></tr></thead><tbody>';
        while($res = $stmt->fetch(\PDO::FETCH_OBJ)){
            $TableSolicitacao .= "<tr class='font-solicitacao'><td >". $res->CodSolicitacao ."</td><td >".utf8_decode($res->Unidade)."</td><td >".utf8_decode($res->Solicitante)."</td><td >".utf8_decode($res->Tipo)."</td><td><a class='btn btn-sm btn-outline-info' href='Detalhes.php?id=". $res->idSolicitacao ."'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-folder2-open' viewBox='0 0 16 16'><path d='M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z'></path></svg></button></td></tr>";
        }
        $TableSolicitacao .= '</tbody></table>';
	$sqlQ = "SELECT COUNT(idSolicitacao) AS num_result FROM solicitacao WHERE Status = 'Nova'";
	$stmtQ = \Model\Conexao\Conexao::getConexao()->prepare($sqlQ);
        $stmtQ->execute();
	$row_pg = $stmtQ->fetch(\PDO::FETCH_ASSOC);
	$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
	$max_links = 2;
	$TableSolicitacao .= '<nav aria-label="paginacao"><ul class="pagination"><li class="page-item"><span class="page-link"><a href="#" onclick="ListarEquipamentos(1, '.$qnt_result_pg.')">Primeira</a> </span>';
	$TableSolicitacao .= '</li>';
	for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
		if($pag_ant >= 1){
			$TableSolicitacao .= "<li class='page-item'><a class='page-link' href='#' onclick='listarSolicitacao($pag_ant, $qnt_result_pg)'>$pag_ant </a></li>";
		}
	}
	$TableSolicitacao .= '<li class="page-item active"><span class="page-link">'.$pagina.'</span></li>';
	for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
		if($pag_dep <= $quantidade_pg){
			$TableSolicitacao .= "<li class='page-item'><a class='page-link' href='#' onclick='listarSolicitacao($pag_dep, $qnt_result_pg)'>$pag_dep</a></li>";
		}
	}
	$TableSolicitacao .= '<li class="page-item"><span class="page-link"><a href="#" onclick="listarSolicitacao('.$quantidade_pg.', '. $qnt_result_pg.')">Última</a></span></li></ul></nav>';
        return $TableSolicitacao;
    }
    public function readTableProgress( $pagina,$qnt_result_pg) { $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;
        
        $sql = "SELECT s.idSolicitacao, s.CodSolicitacao, s.Tipo, u.Nome AS Solicitante, un.Nome AS Unidade, usue.Nome as Responsavel, s.dEnvio FROM solicitacao s INNER JOIN usuarios u ON u.idusuarios = s.Usuario_idUsuario INNER JOIN unidade un ON un.idUnidade = s.Unidade_idUnidade INNER JOIN usuarios usue ON usue.idusuarios = s.Estoque_idEstoque  WHERE s.Status = 'Andamento' LIMIT ?, ?";
        
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);$stmt->bindParam(1, $inicio, \PDO::PARAM_INT);$stmt->bindParam(2, $qnt_result_pg, \PDO::PARAM_INT);$stmt->execute();
       
        
        $TableSolicitacao = '<table class="table table-hover table-bordered"><thead class="thead-light"><tr><th scope="col">ID</th><th scope="col">Destino</th><th scope="col">Data Envio</th><th scope="col">Solicitante</th><th scope="col">Responsável</th><th scope="col">Tipo</th><th scope="col">Detalhes</th></tr></thead><tbody>';
        while($res = $stmt->fetch(\PDO::FETCH_OBJ)){
            
            $ctl = $this->geraCss($res->idSolicitacao);

            $TableSolicitacao .= "<tr class='font-solicitacao '><td class='".$ctl."'>". $res->CodSolicitacao ."</td><td >".utf8_decode($res->Unidade)."</td><td class='".$ctl."'>".date("d/m/Y", strtotime(utf8_decode($res->dEnvio)))."</td><td >".utf8_decode($res->Solicitante)."</td><td >".utf8_decode($res->Responsavel)."</td><td >".utf8_decode($res->Tipo)."</td><td><a class='btn btn-sm btn-outline-info' href='Detalhes.php?id=". $res->idSolicitacao ."'><i class='bi bi-folder'></i></a><a class='btn btn-sm btn-outline-info ml-1'><i class='bi bi-file-text'></i></a></td></tr>";
        }
        $TableSolicitacao .= '</tbody></table>';
	
        $sqlQ = "SELECT COUNT(idSolicitacao) AS num_result FROM solicitacao WHERE Status = 'Nova'";$stmtQ = \Model\Conexao\Conexao::getConexao()->prepare($sqlQ);$stmtQ->execute();$row_pg = $stmtQ->fetch(\PDO::FETCH_ASSOC);$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg); $max_links = 2;
	
        $TableSolicitacao .= '<nav aria-label="paginacao"><ul class="pagination"><li class="page-item"><span class="page-link"><a href="#" onclick="ListarEquipamentos(1, '.$qnt_result_pg.')">Primeira</a> </span></li>';
	for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
		if($pag_ant >= 1){
			$TableSolicitacao .= "<li class='page-item'><a class='page-link' href='#' onclick='listarSolicitacao($pag_ant, $qnt_result_pg)'>$pag_ant </a></li>";
		}
	}
	$TableSolicitacao .= '<li class="page-item active"><span class="page-link">'.$pagina.'</span></li>';
	for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) { if($pag_dep <= $quantidade_pg){ $TableSolicitacao .= "<li class='page-item'><a class='page-link' href='#' onclick='listarSolicitacao($pag_dep, $qnt_result_pg)'>$pag_dep</a></li>"; } }$TableSolicitacao .= '<li class="page-item"><span class="page-link"><a href="#" onclick="listarSolicitacao('.$quantidade_pg.', '. $qnt_result_pg.')">Última</a></span></li></ul></nav>';
        return $TableSolicitacao;
    }
    
    public function readSolicitacao( $IDSolicita ) {
        $x = $this->readNew($IDSolicita);
        if( $x === "Nova" ){
            
            $sql = "SELECT s.idSolicitacao, s.dSolicitacao, s.Status, s.CodSolicitacao, s.Tipo, u.Nome AS Solicitante, un.Nome AS Unidade FROM solicitacao s INNER JOIN usuarios u ON u.idusuarios = s.Usuario_idUsuario INNER JOIN unidade un ON un.idUnidade = s.Unidade_idUnidade WHERE s.idSolicitacao = ?";

        }else{
            
            $sql = "SELECT re.Nome AS Regiao, s.dEnvio, s.dAceite, s.idSolicitacao, s.dSolicitacao, s.Status, s.CodSolicitacao, s.Tipo, u.Nome AS Solicitante, un.Nome AS Unidade FROM solicitacao s INNER JOIN usuarios u ON u.idusuarios = s.Usuario_idUsuario INNER JOIN unidade un ON un.idUnidade = s.Unidade_idUnidade WHERE s.idSolicitacao = ?";

        }
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->bindParam( 1, $IDSolicita );
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_OBJ);
        
    }
    
    public function readNew($idSolicitacao){
        $sql = "SELECT Status FROM solicitacao WHERE idSolicitacao = ? LIMIT 1;";
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->bindParam( 1, $idSolicitacao );
        $stmt->execute();
        $r = $stmt->fetch(\PDO::FETCH_OBJ);
        return $r->Status;
    }
    
    public function update(SolicitacaoClass $Soli) {
        try{
            \Model\Conexao\Conexao::getConexao()->beginTransaction();


            $sql = "UPDATE solicitacao SET Estoque_idEstoque = ?, dEnvio = ?, dAceite = ?, Status = 'Andamento' WHERE idSolicitacao = ?;";

            $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
            $stmt->bindValue( 1, $Soli->getIdEstoque() );
            $stmt->bindValue( 2, $Soli->getDEnvio() );
            $stmt->bindValue( 3, $Soli->getDAceite() );
            $stmt->bindValue( 4, $Soli->getIdSolicitacao() );
            $stmt->execute();
            \Model\Conexao\Conexao::getConexao()->commit();
            return true;
        } catch (PDOException $e){
            \Model\Conexao\Conexao::getConexao()->rollBack();
            return false;
        }
    }
    
    public function geraCss( $idSolicitacao ) {
        $sql = "SELECT dEnvio FROM solicitacao WHERE idSolicitacao = ?;";
        $stm = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stm->bindParam( 1, $idSolicitacao );
        $stm->execute();
        $res = $stm->fetch(\PDO::FETCH_OBJ);
        $DataDespacho = strtotime( $res->dEnvio );
        $diferenca = $DataDespacho - strtotime( date("Y-m-d") );
        $dias = (int)floor( $diferenca / ( 60 * 60 * 24 ) );
        if($dias > 7){
            return "bg-success  text-white";
        }elseif ($dias < 7 && $dias > 2) {
            return "bg-warning  text-dark";
        }else{
            return "bg-danger  text-white";
        }
    }
    
}
