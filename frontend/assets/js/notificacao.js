const notificacao = document.getElementById('notificacao');
const fechar = document.getElementById('fecharNotificacao');

if (notificacao) {

    function removerNotificacao() {
        notificacao.classList.add('saindo');

        setTimeout(() => {
            notificacao.remove();
        }, 300);
    }

    // Fecha automaticamente após 3 segundos
    setTimeout(removerNotificacao, 3000);

    // Fecha ao clicar no X
    fechar.addEventListener('click', removerNotificacao);
}
