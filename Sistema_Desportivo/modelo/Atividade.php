<?php

class Atividade {
  private $idAtividade;
  private $nome;
  private $descricao;
  private $idEquipe;

  public function __construct($idAtividade, $nome, $idEquipe) {
    $this->idAtividade = $idAtividade;
    $this->nome = $nome;
    $this->idEquipe = $idEquipe;
    $this->descricao = $descricao;
  }

  public function getIdAtividade() {
    return $this->idAtividade;
  }

  public function setIdAtividade($idAtividade) {
    $this->idAtividade = $idAtividade;
  }

  public function getNome() {
    return $this->nome;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }

  public function getIdEquipe() {
    return $this->idEquipe;
  }

  public function setIdEquipe($idEquipe) {
    $this->idEquipe = $idEquipe;
  }

  public function setDescricao($descricao){
    $this -> descricao = $descricao;
  }

  public function getDescriçao(){
    return $this->descricao; 
  } 

}
?>