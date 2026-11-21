<?php

session_start();

require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../controllers/AvaliacaoController.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../frontend/login.php');
    exit;
}

// Aceita somente requisições POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../frontend/index.php');
    exit;
}

$usuarioId = $_SESSION['usuario_id'];
$jogoId = filter_input(INPUT_POST, 'jogo_id', FILTER_VALIDATE_INT);

if (!$jogoId || $jogoId <= 0) {
    header('Location: ../../frontend/index.php');
    exit;
}

$controller = new AvaliacaoController($pdo);
$excluiu = $controller->excluir($usuarioId, $jogoId);

if ($excluiu) {
    header('Location: ../../frontend/jogo.php?id=' . $jogoId . '&avaliacao=excluida');
} else {
    header('Location: ../../frontend/jogo.php?id=' . $jogoId . '&avaliacao=erro');
}

exit;
