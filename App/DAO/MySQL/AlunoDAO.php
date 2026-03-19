<?php

namespace App\DAO\MySQL;

class AlunoDAO extends MysqlConnection
{
    public function __construct(array $config)
    {
        parent::__construct($config);
    }
    public function aulasAluno($COD_ALUNO)
    {
        $sql = "SELECT ID, COD_ALUNO, VEICULO, NUMERO_AULA, DATA, HORA, OBS, INSTRUTOR FROM marc_aula_direcao WHERE COD_ALUNO = :COD_ALUNO ORDER BY `marc_aula_direcao`.`NUMERO_AULA` DESC";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "COD_ALUNO" => $COD_ALUNO
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function examesAluno($COD_ALUNO)
    {
        $SQL_LEGISLACAO = "SELECT * FROM resultado_exames WHERE COD_ALUNO = :COD_ALUNO AND CATEG_EXAME = 'LEGISLACAO'";
        $SQL_DIRECAO = "SELECT * FROM resultado_exames WHERE COD_ALUNO = :COD_ALUNO AND CATEG_EXAME = 'DIRECAO'";
        $statement_legislacao = $this->pdo->prepare($SQL_LEGISLACAO);
        $statement_legislacao->execute(["COD_ALUNO" => $COD_ALUNO]);
        $statement_direcao = $this->pdo->prepare($SQL_DIRECAO);
        $statement_direcao->execute(["COD_ALUNO" => $COD_ALUNO]);
        $LEGISLACAO_RESULT = $statement_legislacao->fetchAll(\PDO::FETCH_ASSOC);
        $DIRECAO_RESULT = $statement_direcao->fetchAll(\PDO::FETCH_ASSOC);

        return array('LEGISLACAO' => $LEGISLACAO_RESULT, 'DIRECAO' => $DIRECAO_RESULT);
    }


    public function exameLegislacao($COD_ALUNO)
    {
        $SQL_LEGISLACAO = "SELECT * FROM resultado_exames WHERE COD_ALUNO = :COD_ALUNO AND CATEG_EXAME = 'LEGISLACAO'";
        $statement_legislacao = $this->pdo->prepare($SQL_LEGISLACAO);
        $statement_legislacao->execute(["COD_ALUNO" => $COD_ALUNO]);
        $LEGISLACAO_RESULT = $statement_legislacao->fetchAll(\PDO::FETCH_ASSOC);
        return $LEGISLACAO_RESULT;
    }

    public function exameDirecao($COD_ALUNO)
    {
        $SQL_DIRECAO = "SELECT * FROM resultado_exames WHERE COD_ALUNO = :COD_ALUNO AND CATEG_EXAME = 'DIRECAO'";
        $statement_direcao = $this->pdo->prepare($SQL_DIRECAO);
        $statement_direcao->execute(["COD_ALUNO" => $COD_ALUNO]);
        $DIRECAO_RESULT = $statement_direcao->fetchAll(\PDO::FETCH_ASSOC);
        return $DIRECAO_RESULT;
    }


    public function financeiroAluno($COD_ALUNO)
    {
        $sql = "SELECT * FROM financa_aluno WHERE COD_ALUNO = :COD_ALUNO";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "COD_ALUNO" => $COD_ALUNO
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function financeiroAlunoTodos($COD_ALUNO)
    {
        $sql = "SELECT * FROM financa_aluno WHERE COD_ALUNO = :COD_ALUNO";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "COD_ALUNO" => $COD_ALUNO
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function financeiroAlunoAPagar($COD_ALUNO)
    {
        $sql = "SELECT * FROM financa_aluno WHERE COD_ALUNO = :COD_ALUNO AND STATUS_PAGAMENTO = 'N'";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "COD_ALUNO" => $COD_ALUNO
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function financeiroAlunoPagos($COD_ALUNO)
    {
        $sql = "SELECT * FROM financa_aluno WHERE COD_ALUNO = :COD_ALUNO AND STATUS_PAGAMENTO = 'S'";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "COD_ALUNO" => $COD_ALUNO
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
