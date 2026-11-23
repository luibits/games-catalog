<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/frontend/assets/favicon/favicon.ico" type="image/x-icon">

    <title>Criar conta</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS próprio -->
    <link rel="stylesheet" href="/frontend/assets/css/cadastro.css">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

    <main class="container px-3">

        <?php
        $mensagem = '';
        $icone = '';

        if (isset($_GET['sucesso'])) {
            $mensagem = 'Conta criada com sucesso! Seja bem-vindo(a)!';
            $icone = 'check-circle';
        } elseif (isset($_GET['erro'])) {

            switch ($_GET['erro']) {
                case 'existente':
                    $mensagem = 'Este nome de usuário já está cadastrado!';
                    break;

                default:
                    $mensagem = 'Não foi possível realizar o cadastro.';
            }

            $icone = 'alert-circle';
        }
        ?>

        <?php if (!empty($mensagem)): ?>
            <div class="toast-notificacao" id="notificacao">

                <i data-lucide="<?= $icone ?>"></i>

                <span><?= htmlspecialchars($mensagem) ?></span>

                <button type="button" id="fecharNotificacao" aria-label="Fechar">
                    &times;
                </button>

            </div>
        <?php endif; ?>

        <div class="cadastro-card mx-auto">

            <div class="text-center mb-4">
                <i data-lucide="gamepad-2"></i>

                <h1 class="h3 fw-bold mt-2">Checkpoint</h1>

                <p class="text-muted-custom mb-0">
                    Crie sua conta e comece sua jornada gamer.
                </p>
            </div>

            <form action="../backend/auth/registrar.php" method="POST">

                <div class="mb-3">
                    <label for="usuario" class="form-label">
                        Nome de usuário
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="usuario"
                        name="usuario"
                        placeholder="Escolha seu nome de usuário"
                        minlength="3"
                        maxlength="50"
                        required>
                </div>

                <div class="mb-4">
                    <label for="senha" class="form-label">
                        Senha
                    </label>

                    <input
                        type="password"
                        class="form-control"
                        id="senha"
                        name="senha"
                        placeholder="Crie uma senha"
                        minlength="8"
                        maxlength="255"
                        required>

                    <div class="form-text text-muted-custom">
                        Utilize pelo menos 8 caracteres.
                    </div>
                </div>

                <button type="submit" class="btn btn-checkpoint w-100">
                    Criar minha conta
                    <i data-lucide="arrow-right" class="ms-1"></i>
                </button>

            </form>

            <div class="text-center mt-4">
                <small class="text-muted-custom">
                    Organize e avalie seus jogos favoritos. <br>
                    Você já tem uma conta? <a href="login.php">Acesse aqui.</a> 
                </small>
            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        lucide.createIcons();
    </script>
    <script src="/frontend/assets/js/notificacao.js"></script>
</body>

</html>