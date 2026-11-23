<?php

require_once __DIR__ . '/../backend/auth/verificar_login.php';

$paginas = [
    'biblioteca' => 'Minha biblioteca',
    'desejos' => 'Lista de desejos',
    'perfil' => 'Meu perfil'
];

$pagina = $_GET['pagina'] ?? 'biblioteca';
$tituloPagina = $paginas[$pagina] ?? 'Página em manutenção';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/frontend/assets/favicon/favicon.ico" type="image/x-icon">

    <title><?= htmlspecialchars($tituloPagina) ?></title>

    <link rel="stylesheet" href="/frontend/assets/css/index.css">
    <link rel="stylesheet" href="/frontend/assets/css/header.css">
    <link rel="stylesheet" href="/frontend/assets/css/sidebar.css">
    <link rel="stylesheet" href="/frontend/assets/css/modal_confirmacao.css">
    <link rel="stylesheet" href="/frontend/assets/css/manutencao.css">

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

    <?php include __DIR__ . '/components/sidebar.php'; ?>

    <div class="conteudo-principal">

        <?php include __DIR__ . '/components/header.php'; ?>

        <main class="conteudo manutencao-container">

            <section class="manutencao-card">

                <div class="manutencao-icone">
                    <i data-lucide="construction"></i>
                </div>

                <span class="manutencao-tag">EM DESENVOLVIMENTO</span>

                <h1>Página em manutenção</h1>

                <p>
                    Estamos trabalhando para trazer
                    <strong><?= htmlspecialchars($tituloPagina) ?></strong>
                    para você.
                </p>

                <p class="manutencao-descricao">
                    Essa funcionalidade estará disponível em breve.
                    Agradecemos pela compreensão!
                </p>

                <a href="/frontend/index.php" class="botao-voltar">
                    <i data-lucide="arrow-left"></i>
                    Voltar ao início
                </a>

            </section>

        </main>

    </div>

    <?php include __DIR__ . '/components/modal_confirmacao.php'; ?>

    <script>
        lucide.createIcons();
    </script>
    <script src="/frontend/assets/js/pesquisa.js"></script>
    <script src="/frontend/assets/js/modal_confirmacao.js?v=2"></script>

</body>
</html>
