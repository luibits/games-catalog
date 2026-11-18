<?php
session_start();

require_once __DIR__ . '/../services/rawg.php';
require_once __DIR__ . '/../config/conexao.php';

// Verifica se a requisição foi enviada pelo método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../frontend/login.php');
    exit;
}

// Recebe os dados do formulário
$usuario = trim($_POST['usuario'] ?? '');
$senha = $_POST['senha'] ?? '';

// Verifica se os campos foram preenchidos
if (empty($usuario) || empty($senha)) {
    header('Location: ../../frontend/login.php?erro=campos');
    exit;
}

try {

    // Busca o usuário no banco de dados
    $sql = "SELECT id, usuario, senha FROM usuarios WHERE usuario = :usuario";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':usuario', $usuario);
    $stmt->execute();

    $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if (!$dadosUsuario || !password_verify($senha, $dadosUsuario['senha'])) {
        header('Location: ../../frontend/login.php?erro=credenciais');
        exit;
    }

    session_regenerate_id(true);

    $_SESSION['usuario_id'] = $dadosUsuario['id'];
    $_SESSION['usuario'] = $dadosUsuario['usuario'];

    $_SESSION['jogo_destaque'] = buscarJogoDestaque();

    // Redireciona para a página inicial
    header('Location: ../../frontend/index.php');
    exit;

} catch (PDOException $e) {

    error_log($e->getMessage());

    header('Location: ../../frontend/login.php?erro=servidor');
    exit;
}
