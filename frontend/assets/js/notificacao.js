
function configurarNotificacao(notificacao) {
    const fechar = notificacao.querySelector('#fecharNotificacao');

    function removerNotificacao() {
        if (notificacao.classList.contains('saindo')) return;

        notificacao.classList.add('saindo');

        setTimeout(() => {
            notificacao.remove();
        }, 300);
    }

    const temporizador = setTimeout(removerNotificacao, 3000);

    if (fechar) {
        fechar.addEventListener('click', () => {
            clearTimeout(temporizador);
            removerNotificacao();
        });
    }
}

// Função global para criar notificações
window.mostrarNotificacao = function (mensagem, tipo = 'sucesso') {
    const notificacao = document.createElement('div');

    const icones = {
        sucesso: 'check-circle',
        erro: 'alert-circle',
        aviso: 'alert-triangle'
    };

    notificacao.className = `toast-notificacao ${tipo}`;

    notificacao.innerHTML = `
        <i data-lucide="${icones[tipo] || icones.sucesso}"></i>
        <span></span>
        <button type="button" aria-label="Fechar">&times;</button>
    `;

    notificacao.querySelector('span').textContent = mensagem;
    notificacao.querySelector('button').id = 'fecharNotificacao';

    document.body.appendChild(notificacao);

    if (window.lucide) {
        lucide.createIcons();
    }

    configurarNotificacao(notificacao);
};

// Configura notificações que já vieram renderizadas pelo PHP
const notificacaoExistente = document.getElementById('notificacao');

if (notificacaoExistente) {
    configurarNotificacao(notificacaoExistente);
}
