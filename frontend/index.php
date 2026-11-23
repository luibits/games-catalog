<?php
require_once __DIR__ . '/../backend/auth/verificar_login.php';
require_once __DIR__ . '/../backend/services/rawg.php';

$jogo = $_SESSION['jogo_destaque'] ?? null;

$termoBusca = trim($_GET['busca'] ?? '');

// Se houver uma pesquisa, busca na RAWG.
// Caso contrário, exibe os jogos em destaque.
if (!empty($termoBusca)) {
    $jogos = buscarJogosPorNome($termoBusca);
} else {
    $jogos = buscarJogosCatalogo(12);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/frontend/assets/favicon/favicon.ico" type="image/x-icon">

    <title>Checkpoint</title>

    <link rel="stylesheet" href="/frontend/assets/css/index.css">
    <link rel="stylesheet" href="/frontend/assets/css/header.css">
    <link rel="stylesheet" href="/frontend/assets/css/sidebar.css">
    <link rel="stylesheet" href="/frontend/assets/css/modal_confirmacao.css">

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

    <?php include __DIR__ . '/components/sidebar.php'; ?>

    <div class="conteudo-principal">

        <?php include __DIR__ . '/components/header.php'; ?>

        <main class="conteudo">

            <?php if (empty($termoBusca)): ?>
                <section class="banner-destaque" style="background-image: linear-gradient(90deg, rgba(16,16,20,.98), rgba(16,16,20,.4)), url('<?= htmlspecialchars($jogo['background_image'] ?? '') ?>')">

                    <?php if ($jogo): ?>

                        <div class="banner-conteudo">

                            <span class="banner-tag">
                                SEU PRÓXIMO FAVORITO ESTÁ AQUI
                            </span>

                            <h1>Descubra seu próximo jogo.</h1>

                            <p>
                                Que tal conhecer
                                <strong><?= htmlspecialchars($jogo['name']) ?></strong>?
                                Explore novos mundos e encontre sua próxima aventura.
                            </p>

                            <a href="#catalogo" class="btn-explorar">
                                <i data-lucide="compass"></i>
                                Explorar catálogo
                            </a>

                        </div>

                        <div class="banner-info">
                            <div class="banner-avaliacao">
                                <i data-lucide="star"></i>
                                <span>
                                    <?= number_format($jogo['rating'] ?? 0, 1, ',', '.') ?>/5
                                </span>
                            </div>

                            <div class="banner-generos">
                                <?php foreach ($jogo['genres'] ?? [] as $genero): ?>

                                    <span>
                                        <?= htmlspecialchars($genero['name']) ?>
                                    </span>

                                <?php endforeach; ?>
                            </div>
                        </div>


                    <?php else: ?>

                        <div class="banner-conteudo">
                            <h1>Descubra seu próximo jogo.</h1>
                            <p>Explore novos mundos e encontre sua próxima aventura.</p>
                        </div>

                    <?php endif; ?>

                </section>
            <?php endif; ?>


            <!-- Catálogo de jogos -->
            <section class="secao-catalogo" id="catalogo">
                <div class="catalogo-cabecalho">

                    <?php if (!empty($termoBusca)): ?>

                        <h2>Resultados da pesquisa</h2>

                        <p>
                            Resultados encontrados para:
                            <?= htmlspecialchars($termoBusca) ?>
                        </p>

                    <?php else: ?>

                        <h2>Jogos em destaque</h2>

                        <p>Descubra jogos que merecem sua atenção.</p>

                    <?php endif; ?>

                </div>

                <?php if (!empty($jogos)): ?>

                    <div class="catalogo-grid">

                        <?php foreach ($jogos as $jogoCatalogo): ?>

                            <?php include __DIR__ . '/components/card_jogo.php'; ?>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <p class="sem-resultados">
                        Nenhum jogo encontrado. Tente pesquisar por outro título.
                    </p>

                <?php endif; ?>

            </section>

        </main>

    </div>

    <?php include __DIR__ . '/components/modal_confirmacao.php'; ?>
   

    <script>
        lucide.createIcons();
    </script>
    <script src="assets/js/scroll.js"></script>
    <script src="assets/js/pesquisa.js"></script>
    <script src="/frontend/assets/js/modal_confirmacao.js?v=2"></script>

</body>

</html>