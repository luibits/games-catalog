<?php
   
    //Carregar as configurações e a conexão antes de tudo.
    require_once __DIR__ . '/../backend/config/conexao.php';
    require_once __DIR__ . '/../backend/auth/verificar_login.php';

    // Ativamos erros para sabermos se algo falha no banco
    ini_set('display_errors', 1);
    error_reporting(E_ALL);


    // Verifica se existe um usuário conectado
    $logado = isset($_SESSION['usuario_id']) || isset($_SESSION['usuario']);


    $nomeUsuario = 'Gamer';


    if ($logado) {
        $nomeUsuario = $_SESSION['usuario_nome']
            ?? $_SESSION['nome']
            ?? 'Gamer';
    }
?>


<!DOCTYPE html>
<html lang="pt-BR">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Checkpoint | Catálogo de jogos</title>


    <link rel="stylesheet" href="css/style.css">
</head>


<body>


    <!-- MENU LATERAL -->
    <aside class="sidebar">


        <a class="brand" href="index.php">
            <span class="brand-mark">🕹️</span>
            Check<span>point</span>
        </a>


        <p class="nav-heading">MENU PRINCIPAL</p>


        <nav class="navigation">


            <a class="nav-link active" href="#jogos">
                <span>▦</span> Jogos
            </a>


            <a class="nav-link" href="#usuarios">
                <span>♙</span> Usuários
            </a>


            <a class="nav-link" href="#favoritos">
                <span>♥</span> Favoritos
            </a>


        </nav>


        <div class="sidebar-bottom">


            <div class="sidebar-mini">◆</div>


            <p>
                Seu espaço para descobrir,<br>
                avaliar e compartilhar jogos.
            </p>


        </div>


    </aside>




    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">


        <!-- CABEÇALHO -->
        <header class="topbar">


            <div>


                <p class="eyebrow">SUA BIBLIOTECA GAMER</p>


                <h1>Explore seu próximo jogo.</h1>


                <p class="subtitle">
                    Avalie, acompanhe e compartilhe suas experiências.
                </p>


            </div>


            <div class="user-chip">


                <div class="user-avatar">
                    <?= $logado ? 'G' : '?' ?>
                </div>


                <span>
                    <?= htmlspecialchars($nomeUsuario, ENT_QUOTES, 'UTF-8') ?>
                </span>


                <?php if ($logado): ?>


                    <a href="logout.php">Sair</a>


                <?php else: ?>


                    <a href="login.php">Entrar</a>


                <?php endif; ?>


            </div>


        </header>




        <!-- DESTAQUE PRINCIPAL -->
        <section class="hero">


            <div class="hero-copy">


                <span class="hero-tag">
                    BEM-VINDO AO CHECKPOINT
                </span>


                <h2>
                    Todo jogo tem uma história.<br>
                    <span>Conte a sua.</span>
                </h2>


                <p>
                    Monte sua biblioteca, registre o que está jogando
                    e descubra opiniões de outros jogadores.
                </p>


                <a href="#jogos" class="primary-button">
                    Explorar catálogo <span>→</span>
                </a>


            </div>


            <div class="hero-art" aria-hidden="true">


                <div class="orb orb-one"></div>
                <div class="orb orb-two"></div>


                <div class="gamepad">🎮</div>


            </div>


        </section>




        <!-- ESTATÍSTICAS -->
        <section class="stats-grid">


            <article class="stat-card">


                <span class="stat-icon">▣</span>


                <div>
                    <strong id="totalGames">6</strong>
                    <small>Jogos no catálogo</small>
                </div>


            </article>


            <article class="stat-card">


                <span class="stat-icon">♥</span>


                <div>
                    <strong id="favoriteCount">0</strong>
                    <small>Seus favoritos</small>
                </div>


            </article>


            <article class="stat-card">


                <span class="stat-icon">✎</span>


                <div>
                    <strong id="reviewCount">0</strong>
                    <small>Avaliações feitas</small>
                </div>


            </article>


        </section>




        <!-- CATÁLOGO -->
        <section id="jogos" class="catalog-section">


            <div class="section-heading">


                <div>
                    <p class="eyebrow">DESCUBRA</p>
                    <h2>Catálogo de jogos</h2>
                </div>


                <button class="outline-button" id="addGameBtn">
                    ＋ Adicionar jogo
                </button>


            </div>




            <!-- FILTROS -->
            <div class="filters">


                <label class="search-box">


                    <span>⌕</span>


                    <input
                        id="searchInput"
                        type="search"
                        placeholder="Buscar jogo..."
                    >


                </label>




                <select id="statusFilter" aria-label="Filtrar por status">


                    <option value="all">Todos os status</option>
                    <option value="played">Já joguei</option>
                    <option value="playing">Estou jogando</option>
                    <option value="want">Quero jogar</option>


                </select>




                <select id="sortFilter" aria-label="Ordenar jogos">


                    <option value="default">Mais populares</option>
                    <option value="name">Nome (A–Z)</option>
                    <option value="rating">Melhor avaliados</option>


                </select>


            </div>




            <!-- JOGOS CARREGADOS PELO JAVASCRIPT -->
            <div id="gamesGrid" class="games-grid"></div>


            <p id="emptyMessage" class="empty-message" hidden>
                Nenhum jogo encontrado. Tente mudar sua busca ou filtro.
            </p>


        </section>




        <!-- FAVORITOS -->
        <section id="favoritos" class="lower-section">


            <div class="section-heading">


                <div>
                    <p class="eyebrow">SUA LISTA</p>
                    <h2>Jogos favoritos</h2>
                </div>


            </div>


            <div id="favoritesList" class="favorites-list">


                <p class="muted">
                    Clique no coração de um jogo para adicioná-lo aos favoritos.
                </p>


            </div>


        </section>




        <!-- USUÁRIOS -->
        <section id="usuarios" class="lower-section users-section">


            <div class="section-heading">


                <div>
                    <p class="eyebrow">COMUNIDADE</p>
                    <h2>Usuários</h2>
                </div>


            </div>




            <div class="user-card">


                <div class="user-avatar">
                    <?= $logado ? 'G' : '?' ?>
                </div>


                <div>


                    <strong>
                        <?= htmlspecialchars($nomeUsuario, ENT_QUOTES, 'UTF-8') ?>
                    </strong>


                    <p>
                        <?= $logado
                            ? 'Membro da comunidade Checkpoint'
                            : 'Visitante · conheça nossa comunidade'
                        ?>
                    </p>


                </div>


                <span class="online-dot"></span>


            </div>


        </section>




        <!-- RODAPÉ -->
        <footer>
            © 2026 Checkpoint - Feito para quem ama jogar.
        </footer>


    </main>




    <!-- MODAL DE AVALIAÇÃO -->
    <div class="modal-backdrop" id="reviewModal" hidden>


        <section class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">


            <button class="close-modal" data-close aria-label="Fechar">
                ×
            </button>


            <p class="eyebrow">SUA OPINIÃO</p>


            <h2 id="modalTitle">Avaliar jogo</h2>


            <form id="reviewForm">


                <input type="hidden" id="reviewGameId">


                <label>
                    Seu status


                    <select id="reviewStatus">


                        <option value="played">Já joguei</option>
                        <option value="playing">Estou jogando</option>
                        <option value="want">Quero jogar</option>


                    </select>
                </label>




                <label>
                    Sua nota


                    <select id="reviewRating">


                        <option value="5">★★★★★ — 5</option>
                        <option value="4">★★★★☆ — 4</option>
                        <option value="3">★★★☆☆ — 3</option>
                        <option value="2">★★☆☆☆ — 2</option>
                        <option value="1">★☆☆☆☆ — 1</option>


                    </select>
                </label>




                <label>
                    Comentário


                    <textarea
                        id="reviewComment"
                        rows="4"
                        placeholder="O que você achou desse jogo?"
                    ></textarea>


                </label>




                <button class="primary-button full-button" type="submit">
                    Salvar avaliação
                </button>


            </form>


        </section>


    </div>




    <!-- MODAL DE ADICIONAR JOGO -->
    <div class="modal-backdrop" id="addModal" hidden>


        <section class="modal" role="dialog" aria-modal="true" aria-labelledby="addTitle">


            <button class="close-modal" data-close aria-label="Fechar">
                ×
            </button>


            <p class="eyebrow">NOVO ITEM</p>


            <h2 id="addTitle">Adicionar jogo</h2>


            <form id="addForm">


                <label>
                    Nome do jogo


                    <input
                        id="newGameName"
                        required
                        placeholder="Ex.: Hollow Knight"
                    >
                </label>




                <label>
                    Categoria


                    <input
                        id="newGameGenre"
                        required
                        placeholder="Ex.: Aventura"
                    >
                </label>




                <label>
                    Imagem (URL)


                    <input
                        id="newGameImage"
                        placeholder="https://..."
                    >
                </label>




                <button class="primary-button full-button" type="submit">
                    Adicionar ao catálogo
                </button>


            </form>


        </section>


    </div>



</body>


</html>
