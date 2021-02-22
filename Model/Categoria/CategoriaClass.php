<?php
namespace Model\Categoria;

class CategoriaClass {
    
    private $idCategoria, $Categoria, $Descricao;
    
    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getCategoria() {
        return $this->Categoria;
    }

    function getDescricao() {
        return $this->Descricao;
    }

    function setIdCategoria($idCategoria): void {
        $this->idCategoria = $idCategoria;
    }

    function setCategoria($Categoria): void {
        $this->Categoria = $Categoria;
    }

    function setDescricao($Descricao): void {
        $this->Descricao = $Descricao;
    }


    
}
