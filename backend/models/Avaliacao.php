<?php

require_once __DIR__ . '/../config/conexao.php';

class Avaliacao
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function salvar($usuarioId, $jogoId, $nota, $comentario)
    {

        $sql = "INSERT INTO avaliacoes
            (usuario_id, jogo_id, nota, comentario)
            VALUES
            (:usuario_id, :jogo_id, :nota, :comentario)

            ON DUPLICATE KEY UPDATE
                nota = VALUES(nota),
                comentario = VALUES(comentario),
                data_avaliacao = CURRENT_TIMESTAMP";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':jogo_id' => $jogoId,
            ':nota' => $nota,
            ':comentario' => $comentario
        ]);
    }
}
