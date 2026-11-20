<header class="header">

    <div class="pesquisa-container">

        <form class="header-pesquisa" action="index.php" method="GET">

            <i data-lucide="search"></i>

            <input
                type="text"
                name="busca"
                id="campo-busca"
                placeholder="Pesquisar jogos..."
                aria-label="Pesquisar jogos"
                autocomplete="off"
                value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>"
            >

            <button type="submit">Pesquisar</button>

        </form>

        <div id="resultados-busca" class="resultados-busca"></div>

    </div>

    <div class="header-usuario">
        <span>
            Olá, <?= htmlspecialchars($_SESSION['usuario']) ?>
        </span>

        <div class="usuario-avatar">
            <i data-lucide="user-round"></i>
        </div>
    </div>

</header>