<?php

/**
 *
 * Conexão com o Banco de Dados MySQL em POO
 *
 * @author     João Márcio Ap. Tavares (https://github.com/SirProxy/)
 * @copyright  2019 João Márcio Ap. Tavares
 * @license    https://www.php.net/license/3_01.txt  PHP License 3.01
 */

class Conexao
{
    // Metodo para a construção do Banco de Dados
    public function __construct() {}

    // Strings que contem as informações da conexão
    private static $tipoBD = "mysql";
    private static $host = "localhost";
    private static $port = "3306";
    private static $user = "root";
    private static $password = "";
    private static $db = "mysql";

    // Metodos para a exibição das variaveis desejadas
    private function getBancoTipo(){
        return self::$tipoBD;
    }
    private function getHost(){
        return self::$host;
    }
    private function getPorta(){
        return self::$port;
    }
    private function getUser(){
        return self::$user;
    }
    private function getPassword(){
        return self::$password;
    }
    private function getDB(){
        return self::$db;
    }

    // Metodo para a conexao com o Banco de Dados
    public function conectar(){
        try
        {
            // Inicia a conexao com o banco de dados
            $this->conexao = new PDO($this->getBancoTipo().":host=".$this->getHost().";port=".$this->getPorta().";dbname=".$this->getDB(), $this->getUser(), $this->getPassword());
        }
        catch (PDOException $i)
        {
            // Se não conseguir conectar retorna essa mensagem contendo o erro
            die("Não foi possivel conectar o Banco de dados: <b><code>" . $i->getMessage() . "</code></b> <br> Contate um admistrador do sistema!");
        }

        return ($this->conexao);
    }

    // Metodo para desconectar do banco de dados
    public function desconectar(){
        $this->conexao = null;
    }

    /*Método que destroi a conexão com banco de dados e remove da memória todas as variáveis setadas*/
    public function __destruct() {
        $this->desconectar();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

}
