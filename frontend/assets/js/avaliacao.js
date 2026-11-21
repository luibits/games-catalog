
const estrelas = document.querySelector('#estrelas');
const campoNota = document.querySelector('#nota');

const botoes = estrelas.querySelectorAll('button');

// Atualiza o preenchimento das estrelas
function atualizarEstrelas(nota) {

    botoes.forEach((botao, indice) => {

        const valorEstrela = indice + 1;

        let preenchimento = nota - (valorEstrela - 1);

        preenchimento = Math.max(0, Math.min(1, preenchimento));

        botao.style.backgroundImage = `linear-gradient(
            to right,
            var(--purple-primary) ${preenchimento * 100}%,
            #514b60 ${preenchimento * 100}%
        )`;

        botao.style.backgroundClip = 'text';
        botao.style.webkitBackgroundClip = 'text';
        botao.style.webkitTextFillColor = 'transparent';
    });
}

// Eventos das estrelas
botoes.forEach((botao) => {

    botao.addEventListener('pointermove', (evento) => {

        const largura = botao.getBoundingClientRect().width;
        const posicao = evento.clientX - botao.getBoundingClientRect().left;

        const valor = Number(botao.dataset.nota);

        const nota = posicao < largura / 2
            ? valor - 0.5
            : valor;

        atualizarEstrelas(nota);
    });

    botao.addEventListener('click', (evento) => {

        const largura = botao.getBoundingClientRect().width;
        const posicao = evento.clientX - botao.getBoundingClientRect().left;

        const valor = Number(botao.dataset.nota);

        const nota = posicao < largura / 2
            ? valor - 0.5
            : valor;

        campoNota.value = nota;

        atualizarEstrelas(nota);
    });
});

// Restaura a nota selecionada ao retirar o mouse
estrelas.addEventListener('pointerleave', () => {
    atualizarEstrelas(Number(campoNota.value) || 0);
});

// Carrega a nota já salva, caso exista
atualizarEstrelas(Number(campoNota.value) || 0);
