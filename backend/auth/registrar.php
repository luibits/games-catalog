<?
require_once __DIR__ . '/../config/conexao.php';

// Verifica se o formulário foi enviado pelo método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../frontend/cadastro.php');
    exit;
}

// Recebe os dados do formulário
$usuario = trim($_POST['usuario'] ?? '');
$senha = $_POST['senha'] ?? '';

// Valida os campos
if (empty($usuario) || empty($senha)) {
    header('Location: ../../frontend/cadastro.php?erro=campos');
    exit;
}

if (strlen($usuario) < 3 || strlen($usuario) > 50) {
    header('Location: ../../frontend/cadastro.php?erro=usuario');
    exit;
}

if (strlen($senha) < 8) {
    header('Location: ../../frontend/cadastro.php?erro=senha');
    exit;
}

try {

    // Verifica se o usuário já existe
    $sql = "SELECT id FROM usuarios WHERE usuario = :usuario";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':usuario', $usuario);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header('Location: ../../frontend/cadastro.php?erro=existente');
        exit;
    }

    // Protege a senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o novo usuário
    $sql = "INSERT INTO usuarios (usuario, senha)
            VALUES (:usuario, :senha)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':usuario', $usuario);
    $stmt->bindValue(':senha', $senhaHash);

    $stmt->execute();

    header('Location: ../../frontend/cadastro.php?sucesso=1');
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    die('Não foi possível realizar o cadastro.');
}
