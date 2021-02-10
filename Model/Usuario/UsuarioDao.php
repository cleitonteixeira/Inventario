<?php
namespace Model\Usuario;

if (!isset($_SESSION)) {
    session_start();
}

class UsuarioDao{
        
    public function cadastrar(UsuarioClass $u){
        $sql = "INSERT INTO usuarios ( Nome, Login, Email, Senha ) VALUES ( ?, ?, ?, ? );";
        
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        
        $stmt->bindParam(1, $u->getNomeUsuario());
        $stmt->bindParam(2, $u->getLogin());
        $stmt->bindParam(3, $u->getEmail());
        $stmt->bindParam(4, $u->getSenha());
        
        $stmt->execute();
    }
    
    public function logar (UsuarioClass $u){
        $sql = "SELECT idusuarios, Nome, Email, Acesso FROM usuarios WHERE Login = ? AND Senha = ? AND Ativo = 0";
        
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        
        $stmt->bindValue(1, $u->getLogin());
        $stmt->bindValue(2, $u->getSenha());
        
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            $res = $stmt->fetch(\PDO::FETCH_OBJ);
            
            $_SESSION['idUser'] = $res->idusuarios;
            $_SESSION['Nome'] = $res->Nome;
            $_SESSION['Email'] = $res->Email;
            $_SESSION['Acesso'] = $res->Acesso;
            
            return true;
        }else{
            return false;
        }
    }
    
    public function getPrazo(){
        $sql = "SELECT Prazo FROM PrazoLancamento WHERE Usuario_idUsuario = ? LIMIT 1";
        
        $stmt = \Model\Conexao\Conexao::getConexao()->prepare($sql);
        $stmt->bindParam(1, $_SESSION['idUser']);
        $stmt->execute();
        
        $res = $stmt->fetch(\PDO::FETCH_OBJ);
        
        return $res->Prazo;
    }
    
    public function Logout() {
        session_start(); // Inicia a sessão
	session_destroy(); // Destrói a sessão limpando todos os valores salvos
    }
    
    public function cript($login,$senha){
        // VEJA QUE PRIMEIRO EU VOU GERAR UM SALT JÁ ENCRIPTADO EM MD5
        $salt = md5($login);
        //PRIMEIRA ENCRIPTAÇÃO ENCRIPTANDO COM crypt
        $codifica = \crypt($senha,$salt);
        // SEGUNDA ENCRIPTAÇÃO COM sha512 (128 bits)
        $codifica = \hash('sha512',$codifica);
        //AGORA RETORNO O VALOR FINAL ENCRIPTADO
        return $codifica; 
    }
}