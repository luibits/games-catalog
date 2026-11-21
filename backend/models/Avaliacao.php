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


    public function buscarPorJogo($jogoId)
    {
        $sql = "SELECT
                avaliacoes.nota,
                avaliacoes.comentario,
                avaliacoes.data_avaliacao,
                usuarios.usuario
            FROM avaliacoes
            INNER JOIN usuarios
                ON avaliacoes.usuario_id = usuarios.id
            WHERE avaliacoes.jogo_id = :jogo_id
            ORDER BY avaliacoes.data_avaliacao DESC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':jogo_id' => $jogoId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buscarPorUsuarioEJogo($usuarioId, $jogoId)
    {
        $sql = "SELECT nota, comentario
            FROM avaliacoes
            WHERE usuario_id = :usuario_id
            AND jogo_id = :jogo_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':jogo_id' => $jogoId
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
