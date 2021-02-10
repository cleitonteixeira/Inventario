<?php
namespace View\Equipamento;

$c = new \Model\Conexao\Conexao();

class EquipamentoDao {
    
    public function create(EquipamentoClass $Equipamento) {
        
        $sql = "INSERT INTO equipamento (Unidade_idUnidade, Categoria_idCategoria, Nome, Descricao, Sequencial) VALUES ( ?, ?, ?, ?, ?);";
        
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        
        $stmt->bindValue(1, $Equipamento->getIdUnidade());
        $stmt->bindValue(2, $Equipamento->getIdCategoria());
        $stmt->bindValue(3, $Equipamento->getNome());
        $stmt->bindValue(4, $Equipamento->getDescricao());
        $stmt->bindValue(5, $Equipamento->getSequencial());
        
        
    }
    
}
