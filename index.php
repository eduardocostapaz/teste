<?php

/**
 */
require_once "class/play.php";

/**
 */
//$play = new Play(10, 4000);
// $play = new Play(10, 40000);
$play = new Play(6, 4);
$play->gerarJogos();
$play->gerarSorteio();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">

<head>
  <title>Play</title>

  <link rel="stylesheet" href="css/style.css" />
</head>

<body>

  <table>
    <th>
      Sorteio
    </th>
    <tr>
      <td>
        <?php $play->imprimeSorteio() ?>
      </td>
    </tr>
  </table>

  <table>
    <th colspan="6">
      Quantidades Dezenas Sorteadas
    </th>
    <tr>
      <?php
      $play->imprimeQtdDezenasSorteadas();
      ?>
    </tr>
  </table>

  <table>
    <th colspan="6">
      Jogos Realizados (<?php echo count($play->__get("jogos")) ?>)
    </th>
    <tr>
      <?php

      $array = $play->__get("jogos");

      for ($i = 0; $i < count($array); $i++) {
        $play->imprimeJogos($i);
      }

      ?>
    </tr>
  </table>

  <table>
    <th>
      Foi Premiado?
    </th>
    <tr>
      <td class="premiado">
        <?php $play->confereJogos() ?>
      </td>
    </tr>
  </table>

</body>

</html>

<?php

// echo "==== DUMP ==== </br>";
// echo "______>>>> JOGOS REALIZADOS";
// var_dump($play->__get("jogos"));

// echo "______>>>> RESULTADO SORTEIO";
// var_dump($play->__get("resultado"));

?>