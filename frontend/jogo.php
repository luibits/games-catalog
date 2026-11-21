<?php

require_once __DIR__ . '/../backend/auth/verificar_login.php';
require_once __DIR__ . '/../backend/services/rawg.php';
require_once __DIR__ . '/../backend/services/youtube.php';

// Recebe o ID enviado pela URL
$idJogo = $_GET['id'] ?? null;

// Busca os detalhes do jogo na RAWG
$jogo = $idJogo ? buscarJogoPorId($idJogo) : null;
$trailer = $jogo ? buscarTrailerJogo($jogo['name']) : null;

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $jogo ? htmlspecialchars($jogo['name']) : 'Jogo não encontrado' ?> | Checkpoint
    </title>

    <link rel="stylesheet" href="/frontend/assets/css/index.css">
    <link rel="stylesheet" href="/frontend/assets/css/header.css">
    <link rel="stylesheet" href="/frontend/assets/css/sidebar.css">
    <link rel="stylesheet" href="/frontend/assets/css/jogo.css">

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

    <?php include __DIR__ . '/components/sidebar.php'; ?>

    <div class="conteudo-principal">

        <?php include __DIR__ . '/components/header.php'; ?>

        <main class="conteudo">

            <?php if ($jogo): ?>

                <?php
                $descricao = $jogo['description'] ?? '';

                if (preg_match('/<p[^>]*>(.*?)<\/p>/is', $descricao, $resultado)) {
                    $descricao = strip_tags($resultado[1]);
                } else {
                    $descricao = $jogo['description_raw'] ?? 'Description unavailable.';
                }
                ?>

                <section class="detalhes-jogo">

                    <div class="jogo-banner">
                        <img
                            src="<?= htmlspecialchars($jogo['background_image'] ?? '') ?>"
                            alt="<?= htmlspecialchars($jogo['name']) ?>">
                    </div>

                    <div class="jogo-conteudo">

                        <div class="jogo-cabecalho">
                            <div>
                                <span class="jogo-tag">DETALHES DO JOGO</span>
                                <h1><?= htmlspecialchars($jogo['name']) ?></h1>
                            </div>

                            <div class="jogo-nota">
                                <i data-lucide="star"></i>
                                <strong><?= number_format($jogo['rating'] ?? 0, 1, ',', '.') ?></strong>
                                <span>/ 5</span>
                            </div>
                        </div>

                        <div class="jogo-generos">
                            <?php foreach ($jogo['genres'] ?? [] as $genero): ?>
                                <span><?= htmlspecialchars($genero['name']) ?></span>
                            <?php endforeach; ?>
                        </div>

                        <div class="jogo-metadados">

                            <div class="metadado">
                                <i data-lucide="calendar-days"></i>
                                <div>
                                    <span>Lançamento</span>
                                    <strong><?= htmlspecialchars($jogo['released'] ?? 'Não informado') ?></strong>
                                </div>
                            </div>

                            <div class="metadado">
                                <i data-lucide="code"></i>
                                <div>
                                    <span>Desenvolvedora</span>
                                    <strong>
                                        <?= htmlspecialchars(implode(', ', array_column($jogo['developers'] ?? [], 'name')) ?: 'Não informado') ?>
                                    </strong>
                                </div>
                            </div>

                            <div class="metadado">
                                <i data-lucide="building-2"></i>
                                <div>
                                    <span>Publicadora</span>
                                    <strong>
                                        <?= htmlspecialchars(implode(', ', array_column($jogo['publishers'] ?? [], 'name')) ?: 'Não informado') ?>
                                    </strong>
                                </div>
                            </div>

                        </div>

                        <section class="jogo-plataformas">
                            <h2>Disponível para</h2>

                            <div class="lista-plataformas">
                                <?php foreach ($jogo['platforms'] ?? [] as $item): ?>
                                    <span>
                                        <?= htmlspecialchars($item['platform']['name'] ?? '') ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>

                            <section class="jogo-descricao">
                                <h2>Sobre o game</h2>

                                <p>
                                    <?= htmlspecialchars($descricao) ?>
                                </p>
                            </section>
                        </section>

                        <section class="jogo-trailer">

                            <h2>Trailer oficial</h2>

                            <?php if ($trailer): ?>

                                <div class="trailer-video">
                                    <iframe
                                        src="https://www.youtube.com/embed/<?= htmlspecialchars($trailer['id']) ?>"
                                        title="<?= htmlspecialchars($trailer['titulo']) ?>"
                                        frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                </div>

                            <?php else: ?>

                                <p>Trailer não disponível para este jogo.</p>

                            <?php endif; ?>

                        </section>


                        <section class="jogo-avaliacao">

                            <h2>Avalie este jogo</h2>

                            <form action="../backend/routes/salvar_avaliacao.php" method="POST">

                                <input
                                    type="hidden"
                                    name="jogo_id"
                                    value="<?= htmlspecialchars($jogo['id']) ?>">

                                <div class="campo-avaliacao">
                                    <label for="nota">Sua nota</label>

                                    <select name="nota" id="nota" required>
                                        <option value="">Selecione uma nota</option>
                                        <option value="0.5">0,5</option>
                                        <option value="1">1,0</option>
                                        <option value="1.5">1,5</option>
                                        <option value="2">2,0</option>
                                        <option value="2.5">2,5</option>
                                        <option value="3">3,0</option>
                                        <option value="3.5">3,5</option>
                                        <option value="4">4,0</option>
                                        <option value="4.5">4,5</option>
                                        <option value="5">5,0</option>
                                    </select>
                                </div>

                                <div class="campo-avaliacao">
                                    <label for="comentario">Comentário (opcional)</label>

                                    <textarea
                                        name="comentario"
                                        id="comentario"
                                        placeholder="O que você achou deste jogo?"
                                        rows="4"></textarea>
                                </div>

                                <button type="submit">Enviar avaliação</button>

                            </form>

                        </section>


                    </div>

                </section>

            <?php else: ?>

                <h1>Jogo não encontrado.</h1>
                <p>Não foi possível localizar esse jogo.</p>

            <?php endif; ?>



        </main>

    </div>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>