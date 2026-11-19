
const botaoExplorar = document.querySelector('.btn-explorar');
const catalogo = document.querySelector('#catalogo');

botaoExplorar.addEventListener('click', function (event) {
    event.preventDefault();

    const inicio = window.scrollY;
    const destino = catalogo.getBoundingClientRect().top + inicio;
    const duracao = 1500;
    let tempoInicial = null;

    function animarScroll(tempoAtual) {
        if (tempoInicial === null) tempoInicial = tempoAtual;

        const progresso = Math.min((tempoAtual - tempoInicial) / duracao, 1);

        // Suaviza o começo e o final do movimento
        const suavizacao = progresso < 0.5
            ? 4 * progresso * progresso * progresso
            : 1 - Math.pow(-2 * progresso + 2, 3) / 2;

        window.scrollTo(0, inicio + (destino - inicio) * suavizacao);

        if (progresso < 1) {
            requestAnimationFrame(animarScroll);
        }
    }

    requestAnimationFrame(animarScroll);
});
