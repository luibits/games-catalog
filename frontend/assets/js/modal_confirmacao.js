
const modal = document.getElementById('modalConfirmacao');

if (modal) {

    const titulo = document.getElementById('modalTitulo');
    const mensagem = document.getElementById('modalMensagem');

    const botaoCancelar = document.getElementById('cancelarModal');
    const botaoConfirmar = document.getElementById('confirmarModal');
    const botaoFechar = document.getElementById('fecharModal');

    let acaoConfirmada = null;

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

    function fecharModal(resultado) {
        modal.classList.remove('ativo');

        if (acaoConfirmada) {
            acaoConfirmada(resultado);
            acaoConfirmada = null;
        }
    }

    botaoCancelar.addEventListener('click', () => fecharModal(false));
    botaoFechar.addEventListener('click', () => fecharModal(false));
    botaoConfirmar.addEventListener('click', () => fecharModal(true));

    modal.addEventListener('click', (evento) => {
        if (evento.target === modal) {
            fecharModal(false);
        }
    });

    document.addEventListener('keydown', (evento) => {
        if (evento.key === 'Escape' && modal.classList.contains('ativo')) {
            fecharModal(false);
        }
    });
}

// CONFIRMAÇÃO DE ATUALIZAÇÃO
const formularioAvaliacao = document.querySelector('.jogo-avaliacao form');

if (formularioAvaliacao) {
    formularioAvaliacao.addEventListener('submit', async (evento) => {

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
}

// CONFIRMAÇÃO DE SAÍDA
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

// CONFIRMAÇÃO DE EXCLUSÃO
const botaoExcluir = document.getElementById('botaoExcluirAvaliacao');
const formularioExcluir = document.getElementById('formExcluirAvaliacao');

if (botaoExcluir && formularioExcluir) {
    botaoExcluir.addEventListener('click', async () => {

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
