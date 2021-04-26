<?php

/**
 * Classe para transformar Números Romanos em números decimais
 * 
 * @author João Márcio Tavares (https://github.com/sirproxy)
 * @copyright João Márcio Tavares 2021
 */

class Romanos {

    /**
     * @param string
     * @return int
     * 
     * @author João Márcio Tavares (https://github.com/sirproxy)
     */
    protected function traduzirNumero(string $numeroRomano) : int {

        // Transformar número romano em caixa alta
        $numeroRomano = mb_strtoupper($numeroRomano);

        // Número que será retornado
        $resultado = 0;

        // Selecionando o valor do número romano
        switch ($numeroRomano) {
            case 'I': $resultado = 1;    break;
            case 'V': $resultado = 5;    break;
            case 'X': $resultado = 10;   break;
            case 'L': $resultado = 50;   break;
            case 'C': $resultado = 100;  break;
            case 'D': $resultado = 500;  break;
            case 'M': $resultado = 1000; break;
            default:  $resultado = 0;    break;
        }

        return $resultado;

    }

    /**
     * @param string
     * @return int
     * 
     * @author João Márcio Tavares (https://github.com/sirproxy)
     */
    public function converterRomanoDecimal(string $numeroRomano) : int {

        // Transformando número romano em array
        $arrayNumeroRomano = str_split($numeroRomano);
        // Contar a quantidade de elementos no arrat 
        $totalNumeros = count($arrayNumeroRomano);
        // Inicia a variavel $total com 0
        $total = 0;

        // Percorrer todos os elementos do array
        for ($i = 0; $i < $totalNumeros; $i++) { 

            // Verificar se o próximo item do array está vazio
            if (!empty($arrayNumeroRomano[$i + 1])) {

                $atual =   $this->traduzirNumero($arrayNumeroRomano[$i]);
                $proximo = $this->traduzirNumero($arrayNumeroRomano[$i + 1]);
                $subtotal = 0;

                if ($atual < $proximo) {
                    // Se o número atual for menor que o próximo número, subtrair o atual do próximo e somar ao subtotal
                    $subtotal = $proximo - $atual;
                    // Pular o próximo elemento do array
                    $i++;
                } else {
                    // Se o número atual for maior ou igual ao próximo número apenas somar o número atual
                    $subtotal = $atual;
                }
                
            } else {
                // Se o próximo número for vazio apenas somar o valor do atual
                $subtotal = $this->traduzirNumero($arrayNumeroRomano[$i]);
            }

            // Soma o subtotal ao número total
            $total += $subtotal;
        }

        return $total;
    }

}
