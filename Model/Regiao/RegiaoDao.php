<?php
namespace Model\Regiao;

if(!isset($_SESSION)){
    session_start();
}

class RegiaoDao {
    
    public function readList() {
        
        $sql = 'SELECT * FROM regiao';
        
        $stm = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stm->execute();
        
        while($row = $stm->fetch(\PDO::FETCH_OBJ)){
            $select .= '<option data-token="'.utf8_decode($row->Nome).'" value="'.$row->idRegiao.'">'.$row->Codigo." - ".utf8_decode($row->Nome).'</option>';
        }
        
        return $select;
    }
    public function create(RegiaoClass $Regiao) {
         try {
            \Model\Conexao\Conexao::getConexao()->beginTransaction();
            
            $sql = "INSERT INTO regiao (Nome, Codigo) VALUES ( ?, ? );";

            $stm = \Model\Conexao\Conexao::getConexao()->prepare($sql);
            $stm->bindValue( 1, $Regiao->getNome() );
            $stm->bindValue( 2, $Regiao->getCodigo() );
            $stm->execute(); 
            \Model\Conexao\Conexao::getConexao()->commit();

            return true;
        } catch (Exception $ex) {
            \Model\Conexao\Conexao::getConexao()->rollBack();
            return false;
        }
    }
    public function readCodigo() {
        
        $sql = 'SELECT MAX(Codigo) AS Codigo FROM regiao';
        
        $stm = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stm->execute();
        
        $Codigo = '';
        
        if($stm->rowCount() > 0){
            
            $res = $stm->fetch(\PDO::FETCH_OBJ);
            
            $Codigo = $res->Codigo+1;
        }else{
            $Codigo = 10;
        }
            
        return $Codigo;
    }
    public function read() {
        
        $Regiao = '';    

        $sql = "SELECT * FROM regiao;";

        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            
            $res = $stmt->fetchAll(\PDO::FETCH_OBJ);
            foreach ($res as $r){   
                $Regiao .= '<li class="list-group-item" title="'.utf8_decode($r->Nome).'">'.$r->Codigo." - ".utf8_decode($r->Nome).'</li>';
            }
            
        }else{
            $Regiao .= '<li class="list-group-item" title="Sem Registros">Sem Registros</li>';
        }
        return $Regiao;
    }
    public function readListL() {
        
        $Regiao = '';    

        $sql = "SELECT * FROM regiao;";

        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            
            $res = $stmt->fetchAll(\PDO::FETCH_OBJ);
            foreach ($res as $r){   
                $Regiao .= '<li class="list-group-item" title="'.utf8_decode($r->Nome).'">'.$r->Codigo." ".utf8_decode($r->Nome).'</li>';
            }
            
        }else{
            $Regiao .= '<li class="list-group-item" title="Sem Registros">Sem Registros</li>';
        }
        return $Regiao;
    }
}
