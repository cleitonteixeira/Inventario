<?php
namespace Model\Solicitacao;

if (!isset($_SESSION)) {
    session_start();
}

class SolicitacaoDao {
    
    public function create(SolicitacaoClass $Solicitacao){
        try{
            \Model\Conexao\Conexao::getConexao()->beginTransaction();

            $sql = "INSERT INTO solicitacao (Equipamento_idEquipamento, Usuario_idUsuario, Unidade_idUnidade, dSolicitacao, Tipo) VALUES ( ?, ?, ?, ?, ? );";

            $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
            $stmt->bindValue( 1, $Solicitacao->getIdEquipamento() );
            $stmt->bindValue( 2, $Solicitacao->getIdSolicitante() );
            $stmt->bindValue( 3, $Solicitacao->getIdUnidade() );
            $stmt->bindValue( 4, $Solicitacao->getDSolicitacao() );
            $stmt->bindValue( 5, $Solicitacao->getTipo() ); 
            $stmt->execute();
            
            $this->updateStatus( $Solicitacao->getIdEquipamento(), 'Reservado' );
            
            \Model\Conexao\Conexao::getConexao()->commit();
            return true;
        } catch (PDOException $ex){
            \Model\Conexao\Conexao::getConexao()->rollBack();
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
        $sql = "SELECT s.idSolicitacao, s.CodSolicitacao, s.Tipo, u.Nome AS Solicitante, un.Nome AS Unidade, e.Nome AS Equipamento, e.Sequencial, une.Nome AS UnidadeAtual  FROM solicitacao s INNER JOIN usuarios u ON u.idusuarios = s.Usuario_idUsuario INNER JOIN unidade un ON un.idUnidade = s.Unidade_idUnidade INNER JOIN equipamento e ON e.idEquipamento = s.Equipamento_idEquipamento INNER JOIN unidade une ON une.idUnidade = e.Unidade_idUnidade WHERE s.Status = 'Nova' LIMIT ?, ?";
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->bindParam(1, $inicio, \PDO::PARAM_INT);
        $stmt->bindParam(2, $qnt_result_pg, \PDO::PARAM_INT); 
        $stmt->execute();
        $TableSolicitacao = '<table class="table table-hover table-bordered"><thead class="thead-light"><tr><th scope="col">ID</th><th scope="col">Equipamento</th><th scope="col">Destino</th><th scope="col">Local Atual</th><th scope="col">Solicitante</th><th scope="col">Tipo</th><th scope="col">Detalhes</th></tr></thead><tbody>';
        while($res = $stmt->fetch(\PDO::FETCH_OBJ)){
            $TableSolicitacao .= "<tr class='font-equipamento'><td >". $res->CodSolicitacao ."</td><td >".$res->Sequencial." - ".utf8_decode($res->Equipamento)."</td><td >".utf8_decode($res->Unidade)."</td><td >".utf8_decode($res->UnidadeAtual)."</td><td >".utf8_decode($res->Solicitante)."</td><td >".utf8_decode($res->Tipo)."</td><td><a class='btn btn-sm btn-outline-info' href='Detalhes.php?id=". $res->idSolicitacao ."'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-folder2-open' viewBox='0 0 16 16'><path d='M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z'></path></svg></button></td></tr>";
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
    
    public function readSolicitacao($IDSolicita) {
        $sql = "SELECT s.idSolicitacao, s.CodSolicitacao, s.Tipo, e.Situacao, u.Nome AS Solicitante, un.Nome AS Unidade, e.Descricao, e.Nome AS Equipamento, e.Sequencial, ca.Nome AS Categoria, une.idUnidade, une.Regiao_idRegiao, une.Nome AS UnidadeAtual  FROM solicitacao s INNER JOIN usuarios u ON u.idusuarios = s.Usuario_idUsuario INNER JOIN unidade un ON un.idUnidade = s.Unidade_idUnidade INNER JOIN equipamento e ON e.idEquipamento = s.Equipamento_idEquipamento INNER JOIN unidade une ON une.idUnidade = e.Unidade_idUnidade INNER JOIN categoria ca ON ca.idCategoria = e.Categoria_idCategoria WHERE s.Status = 'Nova' AND s.idSolicitacao = ?";
        
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->bindParam( 1, $IDSolicita );
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_OBJ);
        
    }
    
    public function update(SolicitacaoClass $Soli) {
        try{
            \Model\Conexao\Conexao::getConexao()->beginTransaction();


            $sql = "UPTADE TABLE solicitacao SET Estoque_idEstoque = ?, dEnvio = ?, dAceite = ?, Status = 'Andamento' WHERE idSolicitacao = ?;";

            $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
            $stmt->bindValue( 1, $Soli->getIdEstoque() );
            $stmt->bindValue( 2, $Soli->getDEnvio() );
            $stmt->bindValue( 3, $Soli->getDAceite() );
            $stmt->bindValue( 4, $Soli->getIdSolicitacao() );

            \Model\Conexao\Conexao::getConexao()->commit();
            return true;
        } catch (PDOException $e){
            \Model\Conexao\Conexao::getConexao()->rollBack();
            return false;
        }
    }
    
}
