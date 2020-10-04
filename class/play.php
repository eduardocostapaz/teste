<?PHP

/**
 */
require_once "factory/playFactory.php";

/**
 */
class Play extends PlayFactory
{
    private $quantidadeDezenas;
    private $resultado;
    private $totalJogos;
    private $jogos;

    /**
     */
    function __construct($quantidadeDezenas, $totalJogos)
    {
        if ($this->checkValor(filter_var($quantidadeDezenas, FILTER_VALIDATE_INT, $this->filterQuantidadeDezena()))) {
            $this->quantidadeDezenas = $quantidadeDezenas;
        }

        $this->totalJogos = $totalJogos;
    }

    /**
     */
    private function setQuantidadeDezenas($quantidadeDezenas)
    {
        $this->quantidadeDezenas = $quantidadeDezenas;
    }

    /**
     */
    private function getQuantidadeDezenas()
    {
        return $this->quantidadeDezenas;
    }

    /**
     */
    private function setResultado($resultado)
    {
        $this->resultado = $resultado;
    }

    /**
     */
    private function getResultado()
    {
        return $this->resultado;
    }

    /**
     */
    private function setTotalJogos($totalJogos)
    {
        $this->totalJogos = $totalJogos;
    }

    /**
     */
    private function getTotalJogos()
    {
        return $this->totalJogos;
    }

    /**
     */
    private function setJogos($jogos)
    {
        $this->jogos = $jogos;
    }

    /**
     */
    private function getJogos()
    {
        return $this->jogos;
    }

    /**
     */
    public function __set($name, $value)
    {
        switch ($name) {
            case "quantidadeDezenas":
                return $this->setQuantidadeDezenas($value);
            case "resultado":
                return $this->setResultado($value);
            case "totalJogos":
                return $this->setTotalJogos($value);
            case "jogos":
                return $this->setJogos($value);
        }
    }

    /**
     */
    public function __get($name)
    {
        switch ($name) {
            case "quantidadeDezenas":
                return $this->getQuantidadeDezenas();
            case "resultado":
                return $this->getResultado();
            case "totalJogos":
                return $this->getTotalJogos();
            case "jogos":
                return $this->getJogos();
        }
    }

    /**
     */
    private function gerarDezenas($length)
    {
        $array = [];

        for ($row = 1; $row <= $length; $row++) {
            $valor =  rand(1, 60);
            (!in_array($valor, $array) ? array_push($array, $valor) : $row--);
        }

        sort($array);

        return $array;
    }

    /**
     */
    public function gerarJogos()
    {
        $totalJogos = $this->getTotalJogos();
        $arrayMuldimensional = [];

        for ($row = 0; $row < $totalJogos; $row++) {
            array_push($arrayMuldimensional, $this->gerarDezenas($this->getQuantidadeDezenas()));
        }

        $this->setJogos($arrayMuldimensional);
    }

    /**
     */
    public function gerarSorteio()
    {
        $array = [];

        for ($row = 1; $row <= 6; $row++) {
            $valor =  rand(1, 60);
            (!in_array($valor, $array) ? array_push($array, $valor) : $row--);
        }

        sort($array);

        $this->setResultado($array);
    }

    /**
     */
    private function confereDezenasSorteadas()
    {
        $jogos = $this->getJogos();
        $resultado = $this->getResultado();
        $array = [];

        foreach ($jogos as $key => $value) {
            array_push($array, (array_intersect($value, $resultado)
                ? count(array_intersect($value, $resultado)) : "Não sorteou dezena"));
        }

        return $array;
    }

    /**
     */
    public function confereJogos()
    {
        $jogos = $this->getJogos();
        $resultado = $this->getResultado();
        $premiado = 0;

        foreach ($jogos as $key => $value) {
            if ($value == $resultado)
                $premiado++;
        }

        echo ($premiado == 0 ? "Não" : "Sim => " . $premiado . " vezes");
    }

    /**
     */
    public function imprimeJogos($position)
    {
        $jogos = $this->getJogos();
        $ultimoElemento = end($jogos[$position]);
        $dezenas = "";

        foreach ($jogos[$position] as $key => $value) {
            $dezenas .= $value . ($ultimoElemento == $value ? "" : " - ");
        }

        echo "<td>" . $dezenas . "</td>";
    }

    /**
     */
    public function imprimeQtdDezenasSorteadas()
    {
        $sorteadas = $this->confereDezenasSorteadas();

        foreach ($sorteadas as $key => $value) {
            echo "<td>" . $value . "</td>";
        }
    }

    /**
     */
    public function imprimeSorteio()
    {
        $resultado = $this->getResultado();
        $ultimoElemento = end($resultado);

        foreach ($resultado as $key => $value) {
            echo $value . ($ultimoElemento == $value ? "" : " - ");
        }
    }
}
