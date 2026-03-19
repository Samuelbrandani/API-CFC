<?php

namespace App\DAO;

class DAOFactory
{
    private static $connections = [
        '954d52561cc1a99969e9bddd4b505500' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft08',
            'username'      => 'waysoft08',
            'password'      => 'r7NjXF4e',
            // carlinhos
        ],
        '63dcd84a86311c8f3380333f2cfff150' => [
            'driver'        => 'firebird',
            'server'        => '189.126.106.249',
            'port'          => '3050',
            'database_name' => '/home/firebird/1230/OCACAXAMBU.FDB',
            'username'      => 'SYSDBA',
            'password'      => 'qcmgIsGNmfcyLXkMPh3Bw',
            // cfc oca
        ],
        '9dfc410edc32ead75621fa4339fd9a21' => [
            'driver'        => 'firebird',
            'server'        => '189.126.106.249',
            'port'          => '3050',
            'database_name' => '/home/firebird/1230/OCACAXAMBU.FDB',
            'username'      => 'SYSDBA',
            'password'      => 'qcmgIsGNmfcyLXkMPh3Bw',
            // cfc oca
        ],
        'fb71dd3b1c44868670030e74423f00e9' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.cfcsaojose.com.br',
            'database_name' => 'cfcsaojose',
            'username'      => 'cfcsaojose',
            'password'      => 'Dk7bDzH63NsP',
            // são josé
        ],
        '41921958905125a3f0a9e13f1f73aa85' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft23',
            'username'      => 'waysoft23',
            'password'      => '62542ff4d155010bd',
            // base teste cfc
        ],
        'c5ec754e2b38be8baddc5ae742ae05da' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft28',
            'username'      => 'waysoft28',
            'password'      => 'Kz16Iv6GBIgv',
            // cfc fama
        ],
        'fab957f94d0cc57d0582253874c852da' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft33',
            'username'      => 'waysoft33',
            'password'      => 'OQZIgCa3Ql5U',
            // recar
        ],
        '204c8d390e4f7c097a67320906cade91' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft34',
            'username'      => 'waysoft34',
            'password'      => 'SooEd7eGmdisDS',
            // nova lider
        ],
        '306a423e923fe6a664a1a1e84b7aae96' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft35',
            'username'      => 'waysoft35',
            'password'      => 'jqvAI8ON2hPu',
            // ipe
        ],
        'c9247dfd6f15e86fd82d654d5d339b49' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft40',
            'username'      => 'waysoft40',
            'password'      => 'TNAnedzJ9jME',
            // lider
        ],
        '1b7247218236e26b31c10c866150277f' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft41',
            'username'      => 'waysoft41',
            'password'      => 'rISyi3DStBNm',
            // favorita
        ],
        '057eba8c3c369936cab725af777f4783' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft44',
            'username'      => 'waysoft44',
            'password'      => 'YNghVA5v8KAZPAy9',
            // dessimoni
        ],
        'e35d0770d6ea3da7466b0c2d7c3f2587' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft53',
            'username'      => 'waysoft53',
            'password'      => '2WJn48OATKWpM1o',
            // nova direcao campanha
        ],
        '91fe7767f794f016fb07bbb84337fdc8' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft55',
            'username'      => 'waysoft55',
            'password'      => 'C6159AaFTrcD',
            // jcm
        ],
        '64139525ae9bffca210e4fbbe9e73ff9' => [
            'driver'        => 'mysql',
            'server'        => 'mysql.waysoft.net.br',
            'database_name' => 'waysoft59',
            'username'      => 'waysoft59',
            'password'      => '51BsAtPzUAALCOVyjs',
            // dinamica
        ],
    ];

    private static function getConfig(string $cfc): array
    {
        return self::$connections[$cfc] ?? [];
    }

    private static function isFirebird(array $config): bool
    {
        return ($config['driver'] ?? '') === 'firebird';
    }

    public static function createLoginDAO(string $cfc)
    {
        $config = self::getConfig($cfc);
        if (self::isFirebird($config)) {
            return new \App\DAO\Firebird\LoginDAO($config);
        }
        return new \App\DAO\MySQL\LoginDAO($config);
    }

    public static function createAlunoDAO(string $cfc)
    {
        $config = self::getConfig($cfc);
        if (self::isFirebird($config)) {
            return new \App\DAO\Firebird\AlunoDAO($config);
        }
        return new \App\DAO\MySQL\AlunoDAO($config);
    }

    public static function createInstrutorDAO(string $cfc)
    {
        $config = self::getConfig($cfc);
        if (self::isFirebird($config)) {
            return new \App\DAO\Firebird\InstrutorDAO($config);
        }
        return new \App\DAO\MySQL\InstrutorDAO($config);
    }

    public static function createOneSignalDAO(string $cfc)
    {
        $config = self::getConfig($cfc);
        if (self::isFirebird($config)) {
            return new \App\DAO\Firebird\OneSignalDAO($config);
        }
        return new \App\DAO\MySQL\OneSignalDAO($config);
    }

    public static function createContatoDAO(string $cfc)
    {
        $config = self::getConfig($cfc);
        if (self::isFirebird($config)) {
            return new \App\DAO\Firebird\ContatoDAO($config);
        }
        return new \App\DAO\MySQL\ContatoDAO($config);
    }

    public static function createConfigDAO(string $cfc)
    {
        $config = self::getConfig($cfc);
        if (self::isFirebird($config)) {
            return new \App\DAO\Firebird\ConfigDAO($config);
        }
        return new \App\DAO\MySQL\ConfigDAO($config);
    }
}
