<?php

namespace App\DAO\Firebird;

class LoginDAO extends Conexao
{
    public function __construct($cfc)
    {
        parent::__construct($cfc);
    }

    public function loginAluno($COD_ALUNO, $SENHA)
    {
        $sql = "SELECT COD_ALUNO, NOME_ALUNO, SENHA FROM aluno WHERE COD_ALUNO = :COD_ALUNO AND SENHA = :SENHA";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "COD_ALUNO" => $COD_ALUNO,
            "SENHA" => $SENHA
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loginInstrutor($COD_INSTRUTOR, $SENHA)
    {
        $sql = "SELECT * FROM instrutor WHERE COD_INSTRUTOR = :COD_INSTRUTOR AND SENHA = :SENHA";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "COD_INSTRUTOR" => $COD_INSTRUTOR,
            "SENHA" => $SENHA
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
