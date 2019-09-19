<?php

/**
 *
 * Calculo de Bhaskara em POO
 *
 * @author     João Márcio Ap. Tavares (https://github.com/SirProxy/)
 * @copyright  2019 João Márcio Ap. Tavares
 * @license    https://www.php.net/license/3_01.txt  PHP License 3.01
 */

 class Bhaskara
 {
     protected $a, $b, $c, $delta, $x1, $x2;

     public function __construct($a, $b, $c)
     {
        if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
            $this->a = $a;
            $this->b = $b;
            $this->c = $c;
        }
     }

     public function setA($a)
     {
         if (is_numeric($a)) {
             $this->a = $a;
         }
     }

     public function setB($b)
     {
         if (is_numeric($b)) {
             $this->b = $b;
         }
     }

     public function setC($c)
     {
         if (is_numeric($c)) {
             $this->c = $c;
         }
     }

     public function getA()
     {
         return $this->a;
     }

     public function getB()
     {
         return $this->b;
     }

     public function getC()
     {
         return $this->c;
     }

     public function calcularDelta()
     {
        $this->delta = ($this->getB()*$this->getB())-((4*$this->getA())*$this->getC());
        return $this->delta;
     }

     public function calcularX() {
        $this->x1 = (-$this->getB() + sqrt($this->calcularDelta())) / (2 * $this->getA());
        $this->x2 = (-$this->getB() - sqrt($this->calcularDelta())) / (2 * $this->getA());
        return "O valor de x' = " . $this->x1 . "<br> O valor de x'' = " . $this->x2;
     }

 }
