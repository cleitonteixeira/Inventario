<?php

namespace Model\Conexao;

/*************************************************************************************************************  
 * @author William F. Leite                                                                                   *  
 * Data: 20/06/2014                                                                                           *  
 * Descrição: Classe elaborada com o objetivo de auxlilar nas operações CRUDs em diversos SGBDS, possui       *  
 * funcionalidades para construir instruções de INSERT, UPDATE E DELETE onde as mesmas podem ser executadas   *  
 * nos principais SGBDs, exemplo SQL Server, MySQL e Firebird. Instruções SELECT são recebidas integralmente  *  
 * via parâmetro.                                                                                             *  
 *************************************************************************************************************/  


/*
 * Constantes de parâmetros para configuração da conexão
 */
define('SGBD', 'mysql');
define('HOST', 'mysql.nutribemrefeicoescoletivas.com.br');
define('DBNAME', 'nutribemrefeic02');
define('CHARSET', 'utf8');
define('USER', 'nutribem02_add1');
define('PASSWORD', 'Nutr1b3m@1318');

class Conexao {
    
    private static $instance;
    
    public static function getConexao() {
        
        $opcoes = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
        if(!isset(self::$instance)){
            self::$instance = new \PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . ";", USER, PASSWORD, $opcoes);
        }
        return self::$instance;
    }
}
