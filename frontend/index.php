<?php
require_once __DIR__ . '/../backend/auth/verificar_login.php';

$jogo = $_SESSION['jogo_destaque'] ?? null;
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

                        <a href="#" class="btn-explorar">
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

        </main>

    </div>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>