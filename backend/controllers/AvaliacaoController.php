<?php

require_once __DIR__ . '/../models/Avaliacao.php';

class AvaliacaoController
{

    private $avaliacao;

    public function __construct($pdo)
    {
        $this->avaliacao = new Avaliacao($pdo);
    }

    public function salvar($usuarioId, $jogoId, $nota, $comentario)
    {

        if (!is_numeric($nota) || $nota < 0.5 || $nota > 5) {
            return false;
        }

        if ($jogoId <= 0) {
            return false;
        }

        return $this->avaliacao->salvar(
            $usuarioId,
            $jogoId,
            $nota,
            $comentario
        );
    }

    public function buscarPorJogo($jogoId)
    {
        return $this->avaliacao->buscarPorJogo($jogoId);
    }
}
