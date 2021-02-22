<?php
namespace Model\Unidade;

class UnidadeDao {
    
    public function readList() {
        
        $sql = 'SELECT u.idUnidade, u.Nome AS Unidade, us.Nome AS Responsavel FROM unidade u INNER JOIN usuarios us ON us.idusuarios = u.Usuario_idUsuario';
        
        $stm = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stm->execute();
        $select = '';
        
        while($row = $stm->fetch(\PDO::FETCH_OBJ)){
            $select .= '<option data-subtext="Responsável: '.utf8_decode($row->Responsavel).'" data-token="'.utf8_decode($row->Unidade).'" value="'.$row->idUnidade.'">'.utf8_decode($row->Unidade).'</option>';
        }
        
        return $select;
    }
    public function create(UnidadeClass $Unidade) {
         try {
            \Model\Conexao\Conexao::getConexao()->beginTransaction();
            
            $sql = "INSERT INTO unidade (Usuario_idUsuario, Regiao_idRegiao, Nome) VALUES ( ?, ?, ? );";

            $stm = \Model\Conexao\Conexao::getConexao()->prepare($sql);
            $stm->bindValue( 1, $Unidade->getIdUsuario() );
            $stm->bindValue( 2, $Unidade->getIdRegiao() );
            $stm->bindValue( 3, $Unidade->getNome() );
            $stm->execute(); 
         \Model\Conexao\Conexao::getConexao()->commit();

            return true;
        } catch (Exception $ex) {
            \Model\Conexao\Conexao::getConexao()->rollBack();
            return false;
        }
    }
    public function read() {
        
        $Unidade = '';    

        $sql = 'SELECT u.idUnidade, u.Nome AS Unidade, us.Nome AS Responsavel FROM unidade u INNER JOIN usuarios us ON us.idusuarios = u.Usuario_idUsuario';


        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            
            $res = $stmt->fetchAll(\PDO::FETCH_OBJ);
            foreach ($res as $r){   
                $Unidade .= '<li class="list-group-item" title="Responsável: '.utf8_decode($r->Responsavel).'">'.$r->idUnidade." - ".utf8_decode($r->Unidade).'</li>';
            }
            
        }else{
            $Unidade .= '<li class="list-group-item" title="Sem Registros">Sem Registros</li>';
        }
        return $Unidade;
    }
}
