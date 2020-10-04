<?php

abstract class PlayFactory
{
  /**
   */
  public function checkValor($valor)
  {
    try {
      if ($this->isValid($valor)) {
        return $valor;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  /**
   */
  public function filterQuantidadeDezena()
  {
    return array("options" => array("min_range" => 6, "max_range" => 10));
  }

  /**
   */
  private function isValid($valor)
  {
    if ($valor === false || $valor === NULL) {
      throw new Exception("___>>>>>>> Parâmetro Inválido ___ <<<<< [Excecao de MIN 6 e MAX 10 dezenas disparada]");
    }

    return $valor;
  }
}
