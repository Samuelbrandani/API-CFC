<?php

namespace App\DAO\MySQL;

use App\Models\EmailModel;

class ContatoDAO extends MysqlConnection
{
    public function __construct(array $config)
    {
        parent::__construct($config);
    }

    public function insertContatoPeloSite(EmailModel $data)
    {
        $nome = $data->getNome();
        $email = $data->getEmail();
        $telefone = $data->getTelefone();
        $mensagem = $data->getMensagem();
        $dt = $data->getDt();
        $tipo = $data->getTipo();
        $retorno = $data->getRetorno();
        try {
            $sql = "INSERT INTO `contato_site`(`id`, `nome`, `email`, `telefone`, `mensagem`, `dt`, `tipo`, `retorno`) 
            VALUES (null, :nome, :email, :telefone, :mensagem, :dt, :tipo, :retorno)";
            $statement = $this->pdo
                ->prepare($sql);
            if ($statement->execute(
                [
                    'nome' => $nome,
                    'email' => $email,
                    'telefone' => $telefone,
                    'mensagem' => $mensagem,
                    'mensagem' => $mensagem,
                    'dt' => $dt,
                    'tipo' => $tipo,
                    'retorno' => $retorno,
                ]
            ));
            return true;
        } catch (PDOException $x) {
            return false;
        }
    }
}
