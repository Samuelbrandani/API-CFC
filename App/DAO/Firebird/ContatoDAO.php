<?php

namespace App\DAO\Firebird;

use App\Models\EmailModel;

class ContatoDAO extends Conexao
{
    public function __construct($cfc)
    {
        parent::__construct($cfc);
    }

    public function insertContatoPeloSite(EmailModel $data)
    {
        $nome      = $data->getNome();
        $email     = $data->getEmail();
        $telefone  = $data->getTelefone();
        $mensagem  = $data->getMensagem();
        $dt        = $data->getDt();
        $tipo      = $data->getTipo();
        $retorno   = $data->getRetorno();

        try {
            // Firebird uses sequences/generators for auto-increment.
            // Replace GEN_ID(gen_contato_site, 1) with the actual generator name in your database.
            $sql = "INSERT INTO contato_site (id, nome, email, telefone, mensagem, dt, tipo, retorno)
                    VALUES (GEN_ID(gen_contato_site, 1), :nome, :email, :telefone, :mensagem, :dt, :tipo, :retorno)";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'nome'      => $nome,
                'email'     => $email,
                'telefone'  => $telefone,
                'mensagem'  => $mensagem,
                'dt'        => $dt,
                'tipo'      => $tipo,
                'retorno'   => $retorno,
            ]);
            return true;
        } catch (\PDOException $x) {
            return false;
        }
    }
}
