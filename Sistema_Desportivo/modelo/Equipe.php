<?php
class Equipe {

  private $idEquipe;
  private $nome;
  private $idTecnico;
  private $numeroEquipe;

  public function __construct($idEquipe, $nome, $idTecnico) {
    $this->idEquipe = $idEquipe;
    $this->nome = $nome;
    $this->idTecnico = $idTecnico;
    $this -> numeroEquipe = $numeroEquipe;

  }

  public function getIdEquipe() {
    return $this->idEquipe;
  }

  public function setIdEquipe($idEquipe) {
    $this->idEquipe = $idEquipe;
  }

  public function getNome() {
    return $this->nome;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }

  public function getIdTecnico() {
    return $this->idTecnico;
  }

  public function setIdTecnico($idTecnico) {
    $this->idTecnico = $idTecnico;
  }


  public function getNumeroEquipe(){
  return $this-> numeroEquipe;
}

public function setNumeroEquipe($numeroEquipe) {
  $this->numeroEquipe = $numeroEquipe;
  }
}
?>