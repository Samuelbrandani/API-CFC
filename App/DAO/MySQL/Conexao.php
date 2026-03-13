<?php

namespace App\DAO\MySQL;

abstract class Conexao
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct($cfc)
    {
        $conn = $this->getTheConnection($cfc);
        $host = $conn["server"];
        $port = '3306';
        $user = $conn["username"];
        $pass = $conn["password"];
        $dbname = $conn["database_name"];

        $dsn = "mysql:host={$host};dbname={$dbname};port={$port};charset=UTF8";
        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }

    public function getTheConnection($cfc)
    {
        switch ($cfc) {
            case '954d52561cc1a99969e9bddd4b505500':
                // carlinhos
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft08",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft08",
                    'charset' => 'utf8',
                    'password' => "r7NjXF4e",
                );
                break;
            case '63dcd84a86311c8f3380333f2cfff150':
                // cfc oca
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "cfcoca",
                    'server' => "mysql.cfcoca.com.br",
                    'username' => "cfcoca",
                    'charset' => 'utf8',
                    'password' => "SFi5DvC7vFGU",
                );
                break;
            case 'fb71dd3b1c44868670030e74423f00e9':
                // são josé
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "cfcsaojose",
                    'server' => "mysql.cfcsaojose.com.br",
                    'username' => "cfcsaojose",
                    'charset' => 'utf8',
                    'password' => "Dk7bDzH63NsP",
                );
                break;
            case '41921958905125a3f0a9e13f1f73aa85':
                // base teste cfc
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft23",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft23",
                    'charset' => 'utf8',
                    'password' => "62542ff4d155010bd",
                );
                break;
            case '9dfc410edc32ead75621fa4339fd9a21':
                // cfc oca
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "cfcoca",
                    'server' => "mysql.cfcoca.com.br",
                    'username' => "cfcoca",
                    'charset' => 'utf8',
                    'password' => "SFi5DvC7vFGU",
                );
                break;
            case 'c5ec754e2b38be8baddc5ae742ae05da':
                // cfc fama
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft28",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft28",
                    'charset' => 'utf8',
                    'password' => "Kz16Iv6GBIgv",
                );
                break;
            case 'fab957f94d0cc57d0582253874c852da':
                // recar
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft33",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft33",
                    'charset' => 'utf8',
                    'password' => "OQZIgCa3Ql5U",
                );
                break;
            case '204c8d390e4f7c097a67320906cade91':
                // nova lider
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft34",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft34",
                    'charset' => 'utf8',
                    'password' => "SooEd7eGmdisDS",
                );
                break;
            case '306a423e923fe6a664a1a1e84b7aae96':
                // ipe
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft35",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft35",
                    'charset' => 'utf8',
                    'password' => "jqvAI8ON2hPu",
                );
                break;
            case 'c9247dfd6f15e86fd82d654d5d339b49':
                // lider
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft40",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft40",
                    'charset' => 'utf8',
                    'password' => "TNAnedzJ9jME",
                );
                break;
            case '1b7247218236e26b31c10c866150277f':
                // favorita
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft41",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft41",
                    'charset' => 'utf8',
                    'password' => "rISyi3DStBNm",
                );
                break;
            case '057eba8c3c369936cab725af777f4783':
                // dessimoni
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft44",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft44",
                    'charset' => 'utf8',
                    'password' => "YNghVA5v8KAZPAy9",
                );
                break;
            case 'e35d0770d6ea3da7466b0c2d7c3f2587':
                // nova direcao campanha
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft53",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft53",
                    'charset' => 'utf8',
                    'password' => "2WJn48OATKWpM1o",
                );
                break;
            case '91fe7767f794f016fb07bbb84337fdc8':
                // jcm
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft55",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft55",
                    'charset' => 'utf8',
                    'password' => "C6159AaFTrcD",
                );
                break;
            case '64139525ae9bffca210e4fbbe9e73ff9':
                // dinamica
                return array(
                    'database_type' => 'mysql',
                    'database_name' => "waysoft59",
                    'server' => "mysql.waysoft.net.br",
                    'username' => "waysoft59",
                    'charset' => 'utf8',
                    'password' => "51BsAtPzUAALCOVyjs",
                );
                break;
        }
    }
}
