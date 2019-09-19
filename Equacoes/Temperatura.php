<?php

/**
 *
 * Conversão de Temperatura em POO
 *
 * @author     João Márcio Ap. Tavares (https://github.com/SirProxy/)
 * @copyright  2019 João Márcio Ap. Tavares
 * @license    https://www.php.net/license/3_01.txt  PHP License 3.01
 */

class Temperatura
{
    protected $temperatura;
    
    public function __construct($temperatura) {
        if (is_numeric($temperatura)) {
            $this->temperatura = $temperatura;
        }
    }

    // Função para definir a temperatura que deseja converter fora do construct
    public function setTemperatura($temperatura)
    {
        if (is_numeric($temperatura)) {
            $this->temperatura = $temperatura;
        }
    }

    // Retornar temperatura definida
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    // Convertendo de graus Fahrenheit para Celsius
    public function FahrenheitForCelsius()
    {
        $value = ($this->getTemperatura() - 32) * 5/9;
        return $value . "°C";
    }

    // Convertendo de graus Celsius para Fahrenheit
    public function CelsiusForFahrenheit()
    {
        $value = ($this->getTemperatura() * 9/5) + 32;
        return $value . "°F";
    }

    // Convertendo de graus Celsius para Kelvin
    public function CelsiusForKelvin()
    {
        $value = $this->getTemperatura() + 273.15;
        return $value . " K";
    }

    // Convertendo de graus Fahrenheit para Kelvin
    public function FahrenheitForKelvin()
    {
        $value = ($this->getTemperatura() - 32) * 5/9 + 273.15;
        return $value . " k";
    }

    // Convertendo de graus Kelvin para Fahrenheit
    public function KelvinForFahrenheit()
    {
        $value = ($this->getTemperatura() - 273.15) * 9/5 + 32;
        return $value . "°F";
    }

    // Convertendo de graus Kelvin para Celsius
    public function KelvinForCelsius()
    {
        $value = ($this->getTemperatura() - 273.15);
        return $value . "°C";
    }

}
