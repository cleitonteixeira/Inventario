<?php

namespace Model\Unidade;

class UnidadeClass {
    private $idUnidade, $idUsuario, $Usuario, $idRegiao, $Regiao, $Nome;
    
    function getIdUnidade() {
        return $this->idUnidade;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getUsuario() {
        return $this->Usuario;
    }

    function getIdRegiao() {
        return $this->idRegiao;
    }

    function getRegiao() {
        return $this->Regiao;
    }

    function getNome() {
        return $this->Nome;
    }

    function setIdUnidade($idUnidade): void {
        $this->idUnidade = $idUnidade;
    }

    function setIdUsuario($idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    function setUsuario($Usuario): void {
        $this->Usuario = $Usuario;
    }

    function setIdRegiao($idRegiao): void {
        $this->idRegiao = $idRegiao;
    }

    function setRegiao($Regiao): void {
        $this->Regiao = $Regiao;
    }

    function setNome($Nome): void {
        $this->Nome = $Nome;
    }


}
