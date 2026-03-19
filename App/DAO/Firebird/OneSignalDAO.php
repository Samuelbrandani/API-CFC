<?php

namespace App\DAO\Firebird;

class OneSignalDAO extends FirebirdConnection
{
    public function __construct(array $config)
    {
        parent::__construct($config);
    }

    public function insertPlayerId($player_id, $COD_ALUNO)
    {
        // Replace GEN_ID(gen_onesignal, 1) with the actual generator name in your database.
        $statement = $this->pdo->prepare(
            'INSERT INTO onesignal (id, player_id, cod_aluno) VALUES (GEN_ID(gen_onesignal, 1), :player_id, :COD_ALUNO)'
        );
        $statement->execute([
            "player_id" => $player_id,
            "COD_ALUNO" => $COD_ALUNO
        ]);
        return true;
    }

    public function checkPlayerId($player_id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM onesignal WHERE player_id = :player_id');
        $statement->execute([
            "player_id" => $player_id
        ]);
        if (count($statement->fetchAll(\PDO::FETCH_ASSOC)) == 0) return true;
        return false;
    }

    public function getNotification($data)
    {
        $sql = "SELECT * FROM VIEW_ONESIGNAL WHERE DATA = '$data'";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
