<?php
require_once __DIR__ . '/../backend/auth/verificar_login.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkpoint</title>

    <link rel="stylesheet" href="/frontend/assets/css/index.css">
    <link rel="stylesheet" href="/frontend/assets/css/header.css">
    <link rel="stylesheet" href="/frontend/assets/css/sidebar.css">

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

    <?php include __DIR__ . '/components/sidebar.php'; ?>

    <div class="conteudo-principal">

        <?php include __DIR__ . '/components/header.php'; ?>

        <main class="conteudo">
            <h1>Bem-vindo ao Checkpoint!</h1>
        </main>

    </div>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>