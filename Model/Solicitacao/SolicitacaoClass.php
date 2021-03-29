<?php
namespace Model\Solicitacao;

class SolicitacaoClass {
    private $idSolicitacao, $idItemSolicitacao, $idEquipamento, $idSolicitante, $idEstoque, $idUnidade, $Unidade, $Sequencial, $dSolicitacao, $Tipo, $dEnvio, $dConclusao, $Equipamento, $Categoria, $Solicitante, $Estoque, $Regiao, $dAceite, $CSolicitacao;
    function getIdItemSolicitacao() {
        return $this->idItemSolicitacao;
    }
    function getCSolicitacao() {
        return $this->CSolicitacao;
    }

    function setCSolicitacao($CSolicitacao): void {
        $this->CSolicitacao = $CSolicitacao;
    }

        function setIdItemSolicitacao($idItemSolicitacao): void {
        $this->idItemSolicitacao = $idItemSolicitacao;
    }

        function getDAceite() {
        return $this->dAceite;
    }

    function setDAceite($dAceite): void {
        $this->dAceite = $dAceite;
    }

        function getIdSolicitacao() {
        return $this->idSolicitacao;
    }

    function getIdEquipamento() {
        return $this->idEquipamento;
    }

    function getIdSolicitante() {
        return $this->idSolicitante;
    }

    function getIdEstoque() {
        return $this->idEstoque;
    }

    function getIdUnidade() {
        return $this->idUnidade;
    }

    function getUnidade() {
        return $this->Unidade;
    }

    function getSequencial() {
        return $this->Sequencial;
    }

    function getDSolicitacao() {
        return $this->dSolicitacao;
    }

    function getTipo() {
        return $this->Tipo;
    }

    function getDEnvio() {
        return $this->dEnvio;
    }

    function getDConclusao() {
        return $this->dConclusao;
    }

    function getEquipamento() {
        return $this->Equipamento;
    }

    function getCategoria() {
        return $this->Categoria;
    }

    function getSolicitante() {
        return $this->Solicitante;
    }

    function getEstoque() {
        return $this->Estoque;
    }

    function getRegiao() {
        return $this->Regiao;
    }

    function setIdSolicitacao($idSolicitacao): void {
        $this->idSolicitacao = $idSolicitacao;
    }

    function setIdEquipamento($idEquipamento): void {
        $this->idEquipamento = $idEquipamento;
    }

    function setIdSolicitante($idSolicitante): void {
        $this->idSolicitante = $idSolicitante;
    }

    function setIdEstoque($idEstoque): void {
        $this->idEstoque = $idEstoque;
    }

    function setIdUnidade($idUnidade): void {
        $this->idUnidade = $idUnidade;
    }

    function setUnidade($Unidade): void {
        $this->Unidade = $Unidade;
    }

    function setSequencial($Sequencial): void {
        $this->Sequencial = $Sequencial;
    }

    function setDSolicitacao($dSolicitacao): void {
        $this->dSolicitacao = $dSolicitacao;
    }

    function setTipo($Tipo): void {
        $this->Tipo = $Tipo;
    }

    function setDEnvio($dEnvio): void {
        $this->dEnvio = $dEnvio;
    }

    function setDConclusao($dConclusao): void {
        $this->dConclusao = $dConclusao;
    }

    function setEquipamento($Equipamento): void {
        $this->Equipamento = $Equipamento;
    }

    function setCategoria($Categoria): void {
        $this->Categoria = $Categoria;
    }

    function setSolicitante($Solicitante): void {
        $this->Solicitante = $Solicitante;
    }

    function setEstoque($Estoque): void {
        $this->Estoque = $Estoque;
    }

    function setRegiao($Regiao): void {
        $this->Regiao = $Regiao;
    }


}
