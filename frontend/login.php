<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/frontend/assets/favicon/favicon.ico" type="image/x-icon">

    <title>Entrar</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS próprio -->
    <link rel="stylesheet" href="/frontend/assets/css/login.css">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

    <main class="container px-3">

        <?php
        $mensagem = '';
        $icone = '';

        if (isset($_GET['erro'])) {

            switch ($_GET['erro']) {

                case 'campos':
                    $mensagem = 'Preencha todos os campos!';
                    break;

                case 'credenciais':
                    $mensagem = 'Usuário ou senha incorretos!';
                    break;

                case 'servidor':
                    $mensagem = 'Erro interno. Tente novamente!';
                    break;

                default:
                    $mensagem = 'Não foi possível realizar o login.';
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

        <div class="login-card mx-auto">

            <div class="text-center mb-4">

                <i data-lucide="gamepad-2"></i>

                <h1 class="h3 fw-bold mt-2">Checkpoint</h1>

                <p class="text-muted-custom mb-0">
                    Que bom ter você de volta!
                </p>

            </div>

            <form action="../backend/auth/login.php" method="POST">

                <div class="mb-3">

                    <label for="usuario" class="form-label">
                        Nome de usuário
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="usuario"
                        name="usuario"
                        placeholder="Digite seu nome de usuário"
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
                        placeholder="Digite sua senha"
                        required>

                </div>

                <button type="submit" class="btn btn-checkpoint w-100">
                    Entrar
                    <i data-lucide="arrow-right" class="ms-1"></i>
                </button>

            </form>

            <div class="text-center mt-4">

                <small class="text-muted-custom">
                    Ainda não tem uma conta?
                    <a href="cadastro.php">Criar conta</a>
                </small>

            </div>

        </div>

    </main>

    <script>lucide.createIcons();</script>
    <script src="/frontend//assets/js/notificacao.js"></script>
    <script src="assets/js/scroll.js"></script>

</body>

</html>