<?php
namespace Model\Equipamento;

class EquipamentoClass {
    
    private $idEquipamento, $idUnidade, $idCategoria, $idUser, $Unidade, $Usuario, $Nome, $Descricao, $Sequencial, $Ativo;
    
    function getIdEquipamento() {
        return $this->idEquipamento;
    }

    function getIdUnidade() {
        return $this->idUnidade;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getIdUser() {
        return $this->idUser;
    }

    function getUnidade() {
        return $this->Unidade;
    }

    function getUsuario() {
        return $this->Usuario;
    }

    function getNome() {
        return $this->Nome;
    }

    function getDescricao() {
        return $this->Descricao;
    }

    function getSequencial() {
        return $this->Sequencial;
    }

    function getAtivo() {
        return $this->Ativo;
    }

    function setIdEquipamento($idEquipamento): void {
        $this->idEquipamento = $idEquipamento;
    }

    function setIdUnidade($idUnidade): void {
        $this->idUnidade = $idUnidade;
    }

    function setIdCategoria($idCategoria): void {
        $this->idCategoria = $idCategoria;
    }

    function setIdUser($idUser): void {
        $this->idUser = $idUser;
    }

    function setUnidade($Unidade): void {
        $this->Unidade = $Unidade;
    }

    function setUsuario($Usuario): void {
        $this->Usuario = $Usuario;
    }

    function setNome($Nome): void {
        $this->Nome = $Nome;
    }

    function setDescricao($Descricao): void {
        $this->Descricao = $Descricao;
    }

    function setSequencial($Sequencial): void {
        $this->Sequencial = $Sequencial;
    }

    function setAtivo($Ativo): void {
        $this->Ativo = $Ativo;
    }


    
}
