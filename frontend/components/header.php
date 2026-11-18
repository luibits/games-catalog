
<header class="header">

    <div class="header-pesquisa">
        <i data-lucide="search"></i>
        <input
            type="text"
            placeholder="Pesquisar jogos..."
            aria-label="Pesquisar jogos"
        >
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
