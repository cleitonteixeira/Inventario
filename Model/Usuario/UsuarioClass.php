<?php

namespace Model\Usuario;

class UsuarioClass{
    private $idUsuario, $NomeUsuario, $Login, $Senha, $Ativo, $Acesso, $Email, $PrimeiroAcesso, $Admin;
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNomeUsuario() {
        return $this->NomeUsuario;
    }

    function getLogin() {
        return $this->Login;
    }

    function getSenha() {
        return $this->Senha;
    }

    function getAtivo() {
        return $this->Ativo;
    }

    function getAcesso() {
        return $this->Acesso;
    }

    function getEmail() {
        return $this->Email;
    }

    function getPrimeiroAcesso() {
        return $this->PrimeiroAcesso;
    }

    function getAdmin() {
        return $this->Admin;
    }

    function setIdUsuario($idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    function setNomeUsuario($NomeUsuario): void {
        $this->NomeUsuario = $NomeUsuario;
    }

    function setLogin($Login): void {
        $this->Login = $Login;
    }

    function setSenha($Senha): void {
        $this->Senha = $Senha;
    }

    function setAtivo($Ativo): void {
        $this->Ativo = $Ativo;
    }

    function setAcesso($Acesso): void {
        $this->Acesso = $Acesso;
    }

    function setEmail($Email): void {
        $this->Email = $Email;
    }

    function setPrimeiroAcesso($PrimeiroAcesso): void {
        $this->PrimeiroAcesso = $PrimeiroAcesso;
    }

    function setAdmin($Admin): void {
        $this->Admin = $Admin;
    }


    
}