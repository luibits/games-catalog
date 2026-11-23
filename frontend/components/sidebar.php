
<?php

$paginaAtualSidebar = basename($_SERVER['PHP_SELF']);
$secaoAtualSidebar = $_GET['pagina'] ?? '';

$explorarAtivo = in_array($paginaAtualSidebar, ['index.php', 'jogo.php']);
?>

<aside class="sidebar">

    <a href="/frontend/index.php" class="sidebar-logo">
        <i data-lucide="gamepad-directional"></i>
        <span>Checkpoint</span>
    </a>

    <nav class="sidebar-menu">

        <a href="/frontend/index.php"
           aria-label="Explorar catálogo"
           class="sidebar-link <?= $explorarAtivo ? 'ativo' : '' ?>">
            <i data-lucide="compass"></i>
            <span>Explorar catálogo</span>
        </a>

        <a href="/frontend/manutencao.php?pagina=biblioteca"
           aria-label="Minha biblioteca"
           class="sidebar-link <?= $secaoAtualSidebar === 'biblioteca' ? 'ativo' : '' ?>">
            <i data-lucide="library"></i>
            <span>Minha biblioteca</span>
        </a>

        <a href="/frontend/manutencao.php?pagina=desejos"
           aria-label="Lista de desejos"
           class="sidebar-link <?= $secaoAtualSidebar === 'desejos' ? 'ativo' : '' ?>">
            <i data-lucide="heart"></i>
            <span>Lista de desejos</span>
        </a>

        <a href="/frontend/manutencao.php?pagina=perfil"
           aria-label="Meu perfil"
           class="sidebar-link <?= $secaoAtualSidebar === 'perfil' ? 'ativo' : '' ?>">
            <i data-lucide="user-round"></i>
            <span>Meu perfil</span>
        </a>

    </nav>

    <div class="sidebar-footer">
        <a href="/backend/auth/logout.php" class="sidebar-link" id="botaoSair" aria-label="Sair">
            <i data-lucide="log-out"></i>
            <span>Sair</span>
        </a>
    </div>

</aside>
