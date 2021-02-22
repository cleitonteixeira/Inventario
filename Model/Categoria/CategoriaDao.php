<?php
namespace Model\Categoria;

if (!isset($_SESSION)) {
    session_start();
}

class CategoriaDao {
    
    public function create(CategoriaClass $Categoria) {
        try {
            \Model\Conexao\Conexao::getConexao()->beginTransaction();
            
            $sql = "INSERT INTO categoria ( Nome, Descricao ) VALUES ( ?, ? );";

            $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);

            $stmt->bindValue(1, $Categoria->getCategoria());
            $stmt->bindValue(2, $Categoria->getDescricao());
            $stmt->execute();
            
            \Model\Conexao\Conexao::getConexao()->commit();

            return true;
        } catch (Exception $ex) {
            \Model\Conexao\Conexao::getConexao()->rollBack();
            return false;
        }
    }
    public function read() {
        
        $Categoria = '';    

        $sql = "SELECT * FROM categoria;";

        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            
            $res = $stmt->fetchAll(\PDO::FETCH_OBJ);
            foreach ($res as $r){   
                $Categoria .= '<li class="list-group-item" title="'.utf8_decode($r->Descricao).'">'.utf8_decode($r->Nome).'</li>';
            }
            
        }else{
            $Categoria .= '<li class="list-group-item" title="Sem Registros">Sem Registros</li>';
        }
        return $Categoria;
    }
    public function readList() {
        
        $Categoria = '';    

        $sql = "SELECT * FROM categoria;";

        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            
            $res = $stmt->fetchAll(\PDO::FETCH_OBJ);
            foreach ($res as $r){   
                $Categoria .= '<option value="'.$r->idCategoria.'" data-token="'.utf8_decode($r->Nome).'">'.utf8_decode($r->Nome).'</option>';
            }
            
        }else{
            $Categoria = '<option value="">SEM REGISTRO</option>';
        }
        return $Categoria;
    }
}
