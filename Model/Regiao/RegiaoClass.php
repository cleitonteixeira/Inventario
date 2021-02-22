<?php

namespace Model\Regiao;

class RegiaoClass {
    private $idRegiao, $Nome, $Codigo;
    
    function getIdRegiao() {
        return $this->idRegiao;
    }

    function getNome() {
        return $this->Nome;
    }

    function getCodigo() {
        return $this->Codigo;
    }

    function setIdRegiao($idRegiao): void {
        $this->idRegiao = $idRegiao;
    }

    function setNome($Nome): void {
        $this->Nome = $Nome;
    }

    function setCodigo($Codigo): void {
        $this->Codigo = $Codigo;
    }



}
