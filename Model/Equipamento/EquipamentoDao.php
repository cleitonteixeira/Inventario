<?php
namespace Model\Equipamento;

if (!isset($_SESSION)) {
    session_start();
}

class EquipamentoDao {
    
    public function create(EquipamentoClass $Equipamento) {
        try {
            \Model\Conexao\Conexao::getConexao()->beginTransaction();
            
            $sql = "INSERT INTO equipamento (Unidade_idUnidade, Categoria_idCategoria, Nome, Descricao, Sequencial) VALUES ( ?, ?, ?, ?, ?);";

            $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);

            $stmt->bindValue(1, $Equipamento->getIdUnidade());
            $stmt->bindValue(2, $Equipamento->getIdCategoria());
            $stmt->bindValue(3, $Equipamento->getNome());
            $stmt->bindValue(4, $Equipamento->getDescricao());
            $stmt->bindValue(5, $Equipamento->getSequencial());
            $stmt->execute();
            
            \Model\Conexao\Conexao::getConexao()->commit();

            return true;
        } catch (Exception $ex) {
            \Model\Conexao\Conexao::getConexao()->rollBack();
            return false;
        }
    }
    
    public function createSequencial($Categoria) {
        try {
            $sql = "SELECT COUNT(Nome) AS Quantidade FROM equipamento WHERE Categoria_idCategoria = ?";   
            
            $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
            
            $stmt->bindParam(1, $Categoria);
            $stmt->execute();
            
            $res = $stmt->fetch(\PDO::FETCH_OBJ);
            
            $Sequencial = $Categoria+9;
            
            $Sequencial .= str_pad($res->Quantidade+1, 4, 0, STR_PAD_LEFT);
            
            return $Sequencial;
            
        } catch (Exception $ex) {
            return '';
        }
    }
      public function read() {
        
        $Equipamento = '';    

        $sql = "SELECT c.Nome AS Categoria, r.Nome AS Regiao, COUNT(e.idEquipamento) AS Quant FROM equipamento e INNER JOIN categoria c ON c.idCategoria = e.Categoria_idCategoria INNER JOIN unidade u ON u.idUnidade = e.Unidade_idUnidade INNER JOIN regiao r ON u.Regiao_idRegiao = r.idRegiao GROUP BY u.Regiao_idRegiao, c.idCategoria;";

        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            
            $res = $stmt->fetchAll(\PDO::FETCH_OBJ);
            foreach ($res as $r){   
                $Equipamento .= '<li class="list-group-item d-flex justify-content-between align-items-center" title="'.utf8_decode($r->Categoria).'">'.utf8_decode($r->Categoria).'<span class="badge badge-primary badge-pill">'.$r->Quant.'</span></li>';
            }
            
        }else{
            $Equipamento .= '<li class="list-group-item" title="Sem Registros">Sem Registros</li>';
        }
        return $Equipamento;
    }
    
    public function readTableEquipamento( $pagina,$qnt_result_pg) {
        $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;
        $sql = "SELECT e.idEquipamento, e.Nome AS Equipamento, u.Nome AS Unidade,u.Codigo AS CodUnidade, c.Nome AS Categoria, e.Descricao, e.Sequencial, r.Nome AS Regiao, r.Codigo, e.Situacao FROM equipamento e INNER JOIN categoria c ON c.idCategoria = e.Categoria_idCategoria INNER JOIN unidade u ON u.idUnidade = e.Unidade_idUnidade INNER JOIN regiao r ON r.idRegiao = u.Regiao_idRegiao WHERE e.Unidade_idUnidade IN (SELECT Unidade_idUnidade FROM unidadeiuser WHERE Usuario_idUsuario = ?) LIMIT ?, ?";
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->bindParam(1, $_SESSION['idUser']);
        $stmt->bindParam(2, $inicio, \PDO::PARAM_INT);
        $stmt->bindParam(3, $qnt_result_pg, \PDO::PARAM_INT); 
        $stmt->execute();
        $TableClientes = '<table class="table table-hover table-bordered"><thead class="thead-light"><tr><th scope="col">Código</th><th scope="col">Equipamento</th><th scope="col">Unidade</th><th scope="col">Situação</th><th scope="col">Info</th></tr></thead><tbody>';
        while($res = $stmt->fetch(\PDO::FETCH_OBJ)){
            $TableClientes .= "<tr class='font-equipamento'><td >".$res->Codigo.".".$res->CodUnidade.".".$res->Sequencial."</td><td >".utf8_decode($res->Equipamento)."</td><td >".utf8_decode($res->Unidade)."</td><td >".utf8_decode($res->Situacao)."</td><td><button class='btn btn-sm btn-outline-info' onclick='buscaEquipamento(".$res->idEquipamento.")'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-folder2-open' viewBox='0 0 16 16'><path d='M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z'></path></svg></button></td></tr>";
        }
        $TableClientes .= '</tbody></table>';
	$sqlQ = "SELECT COUNT(idContrato) AS num_result FROM contrato WHERE Finalizado = 'N'";
	$stmtQ = \Model\Conexao\Conexao::getConexao()->prepare($sqlQ);
        $stmtQ->execute();
	$row_pg = $stmtQ->fetch(\PDO::FETCH_ASSOC);
	$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
	$max_links = 2;
	$TableClientes .= '<nav aria-label="paginacao"><ul class="pagination"><li class="page-item"><span class="page-link"><a href="#" onclick="ListarEquipamentos(1, '.$qnt_result_pg.')">Primeira</a> </span>';
	$TableClientes .= '</li>';
	for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
		if($pag_ant >= 1){
			$TableClientes .= "<li class='page-item'><a class='page-link' href='#' onclick='ListarEquipamentos($pag_ant, $qnt_result_pg)'>$pag_ant </a></li>";
		}
	}
	$TableClientes .= '<li class="page-item active"><span class="page-link">'.$pagina.'</span></li>';
	for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
		if($pag_dep <= $quantidade_pg){
			$TableClientes .= "<li class='page-item'><a class='page-link' href='#' onclick='ListarEquipamentos($pag_dep, $qnt_result_pg)'>$pag_dep</a></li>";
		}
	}
	$TableClientes .= '<li class="page-item"><span class="page-link"><a href="#" onclick="ListarEquipamentos('.$quantidade_pg.', '. $qnt_result_pg.')">Última</a></span></li></ul></nav>';
        return $TableClientes;
    }
    public function readEDetalhes($idEquipamento) {
        $sql = "SELECT e.Nome AS Equipamento, e.idEquipamento, u.Nome AS Unidade, r.Nome AS Regiao, r.Codigo AS CodRegiao, e.Sequencial, u.Codigo AS CodUnidade, e.Descricao, us.Nome AS Responsavel, e.Situacao, ca.Nome AS Categoria FROM equipamento e INNER JOIN unidade u ON u.idUnidade = e.Unidade_idUnidade INNER JOIN regiao r ON r.idRegiao = u.Regiao_idRegiao INNER JOIN categoria ca ON ca.idCategoria = e.Categoria_idCategoria INNER JOIN usuarios us ON us.idusuarios = u.Usuario_idUsuario WHERE idEquipamento = ?";
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->bindParam(1, $idEquipamento);
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_OBJ);
        $Dados = array();
        $Valores = [
          "idEquipamento" => utf8_decode($res->idEquipamento),
          "Equipamento" => utf8_decode($res->Equipamento),
          "Unidade" => utf8_decode($res->Unidade),
          "Regiao" => utf8_decode($res->Regiao),
          "CodRegiao" => utf8_decode($res->CodRegiao),
          "Sequencial" => utf8_decode($res->Sequencial),
          "CodUnidade" => utf8_decode($res->CodUnidade),
          "Descricao" => utf8_decode($res->Descricao),
          "Responsavel" => utf8_decode($res->Responsavel),
          "Situacao" => utf8_decode($res->Situacao),
          "Categoria" => utf8_decode($res->Categoria),];
        array_push($Dados, $Valores);
        return $Dados;
    }
}