
const modal = document.getElementById('modalConfirmacao');

if (modal) {

    const titulo = document.getElementById('modalTitulo');
    const mensagem = document.getElementById('modalMensagem');
    const icone = document.getElementById('modalIcone');

    const botaoCancelar = document.getElementById('cancelarModal');
    const botaoConfirmar = document.getElementById('confirmarModal');
    const botaoFechar = document.getElementById('fecharModal');

    let acaoConfirmada = null;

    // Abre o modal com as informações desejadas
    window.abrirModalConfirmacao = function (
        textoTitulo,
        textoMensagem,
        textoBotao = 'Confirmar'
    ) {

        titulo.textContent = textoTitulo;
        mensagem.textContent = textoMensagem;
        botaoConfirmar.textContent = textoBotao;

        modal.classList.add('ativo');

        lucide.createIcons();

        return new Promise((resolve) => {
            acaoConfirmada = resolve;
        });
    };

    // Fecha o modal e retorna o resultado
    function fecharModal(resultado) {

        modal.classList.remove('ativo');

        if (acaoConfirmada) {
            acaoConfirmada(resultado);
            acaoConfirmada = null;
        }
    }

    botaoCancelar.addEventListener('click', () => {
        fecharModal(false);
    });

    botaoFechar.addEventListener('click', () => {
        fecharModal(false);
    });

    botaoConfirmar.addEventListener('click', () => {
        fecharModal(true);
    });

    // Fecha ao clicar fora da caixa
    modal.addEventListener('click', (evento) => {
        if (evento.target === modal) {
            fecharModal(false);
        }
    });

    // Fecha ao pressionar ESC
    document.addEventListener('keydown', (evento) => {
        if (evento.key === 'Escape' && modal.classList.contains('ativo')) {
            fecharModal(false);
        }
    });
}


const formularioAvaliacao = document.querySelector('.jogo-avaliacao form');

if (formularioAvaliacao) {

    formularioAvaliacao.addEventListener('submit', async (evento) => {

        // Só pede confirmação quando já existe uma avaliação
        if (formularioAvaliacao.dataset.editar !== 'true') {
            return;
        }

        evento.preventDefault();

        const confirmou = await abrirModalConfirmacao(
            'Atualizar avaliação',
            'Tem certeza de que deseja atualizar sua avaliação deste jogo?',
            'Sim'
        );

        if (confirmou) {
            formularioAvaliacao.submit();
        }
    });

    // Confirmação antes de sair da conta
    const botaoSair = document.getElementById('botaoSair');

    if (botaoSair) {
        botaoSair.addEventListener('click', async (evento) => {
            evento.preventDefault();

            const confirmou = await abrirModalConfirmacao(
                'Sair do Checkpoint',
                'Tem certeza de que deseja sair do Checkpoint?',
                'Sair'
            );

            if (confirmou) {
                window.location.href = botaoSair.href;
            }
        });
    }

    // Confirmação antes de excluir a avaliação
    const formularioExcluir = document.getElementById('formExcluirAvaliacao');

    if (formularioExcluir) {
        formularioExcluir.addEventListener('submit', async (evento) => {
            evento.preventDefault();

            const confirmou = await abrirModalConfirmacao(
                'Excluir avaliação',
                'Tem certeza de que deseja excluir sua avaliação? Essa ação não poderá ser desfeita.',
                'Excluir'
            );

            if (confirmou) {
                formularioExcluir.submit();
            }
        });
    }
}

