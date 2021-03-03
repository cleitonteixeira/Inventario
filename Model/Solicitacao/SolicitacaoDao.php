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
}
