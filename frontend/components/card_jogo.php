<a href="jogo.php?id=<?= urlencode($jogoCatalogo['id']) ?>" class="link-card-jogo">
    
    <article class="card-jogo">

        <div class="card-jogo-capa">

            <?php if (!empty($jogoCatalogo['background_image'])): ?>

                <img
                    src="<?= htmlspecialchars($jogoCatalogo['background_image']) ?>"
                    alt="<?= htmlspecialchars($jogoCatalogo['name'] ?? 'Capa do jogo') ?>">

            <?php else: ?>

                <div class="capa-indisponivel">
                    <i data-lucide="gamepad-2"></i>
                </div>

            <?php endif; ?>

        </div>

        <div class="card-jogo-info">

            <h3>
                <?= htmlspecialchars($jogoCatalogo['name'] ?? 'Jogo sem nome') ?>
            </h3>

            <div class="card-jogo-detalhes">

                <span class="card-jogo-nota">
                    <i data-lucide="star"></i>
                    <?= number_format($jogoCatalogo['rating'] ?? 0, 1, ',', '.') ?>
                </span>

                <span class="card-jogo-genero">
                    <?= htmlspecialchars($jogoCatalogo['genres'][0]['name'] ?? 'Sem gênero') ?>
                </span>

            </div>

        </div>

    </article>
</a>