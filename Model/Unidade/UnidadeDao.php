<?php
namespace Model\Unidade;

class UnidadeDao {
    
    public function getUnidadeL() {
        $select = '<select required class="selectpicker form-control dropdown" required name="Unidade" id="Unidade" title="Selecione um Unidade" data-size="5" data-live-search="true" >';

        $sql = 'SELECT * FROM unidadefornecimento em';
        $stm = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stm->execute();
        $rs = $stm->fetchAll(\PDO::FETCH_OBJ);
        foreach($rs as $r){
            $select .= '<optgroup label="'.utf8_decode($r->Nome).'" >';
            $sql = 'SELECT un.idUnidadeFaturamento, cd.Nome FROM unidadefaturamento un  INNER JOIN cadastro cd ON cd.idCadastro = un.Cadastro_idCadastro WHERE un.Fornecimento_idFornecimento = ? AND un.idUnidadeFaturamento IN (SELECT Unidade_idUnidade FROM unidadefuser WHERE Usuario_idUsuario = ?) AND Ativa = "S" ORDER BY cd.Nome';
            $stm = \Model\Conexao\Conexao::getConexao()->prepare($sql);
            $stm->bindParam(1, $r->idUnidadeFornecimento);
            $stm->bindParam(2, $_SESSION['idUser']);
            $stm->execute();
            while($row = $stm->fetch(\PDO::FETCH_OBJ)){
                $select .= '<option value="'.$row->idUnidadeFaturamento.'">'.utf8_decode($row->Nome).'</option>';
            }
            $select .= '</optgroup>';
        }
        $select .= '</select>';
        
        return $select;
    }
    public function getUnidadeN($idUnidade) {

        $sql = 'SELECT Nome FROM unidadefaturamento INNER JOIN cadastro ON idCadastro = Cadastro_idCadastro WHERE idUnidadeFaturamento = ?;';
        $stm = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stm->bindParam(1, $idUnidade);
        $stm->execute();
        $rs = $stm->fetch(\PDO::FETCH_OBJ);
        
        return $rs->Nome;
    }
    
}
