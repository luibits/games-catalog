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

// Recebe os dados do formulário
$usuarioId = $_SESSION['usuario_id'];
$jogoId = filter_input(INPUT_POST, 'jogo_id', FILTER_VALIDATE_INT);
$nota = $_POST['nota'] ?? null;
$comentario = trim($_POST['comentario'] ?? '');

// Verifica os dados
if (!$jogoId || !is_numeric($nota) || !in_array((float) $nota, [0.5, 1.0, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0, 4.5, 5.0], true)) {
    header('Location: ../../frontend/index.php');
    exit;
}

// Cria o Controller e salva a avaliação
$controller = new AvaliacaoController($pdo);

$resultado = $controller->salvar(
    $usuarioId,
    $jogoId,
    $nota,
    $comentario
);

if ($resultado) {
    header("Location: ../../frontend/jogo.php?id=" . $jogoId . "&avaliacao=sucesso");
    exit;
}

header("Location: ../../frontend/jogo.php?id=" . $jogoId . "&avaliacao=erro");
exit;

