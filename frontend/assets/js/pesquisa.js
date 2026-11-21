
const campoBusca = document.querySelector('#campo-busca');
const resultadosBusca = document.querySelector('#resultados-busca');

let temporizador;

campoBusca.addEventListener('input', function () {

    clearTimeout(temporizador);

    const termo = campoBusca.value.trim();

    if (termo.length < 2) {
        resultadosBusca.style.display = 'none';
        resultadosBusca.innerHTML = '';
        return;
    }

    temporizador = setTimeout(async function () {

        try {
            const resposta = await fetch(
                `../backend/routes/buscar_jogos.php?busca=${encodeURIComponent(termo)}`
            );

            const jogos = await resposta.json();

            resultadosBusca.innerHTML = '';

            if (jogos.length === 0) {
                resultadosBusca.innerHTML = '<p class="sem-resultados">Nenhum jogo encontrado.</p>';
            } else {

                jogos.forEach(function (jogo) {
                    const item = document.createElement('a');
                    item.classList.add('resultado-item');
                    item.href = `/frontend/jogo.php?id=${encodeURIComponent(jogo.id)}`;

                    // Capa do jogo
                    const imagem = document.createElement('img');
                    imagem.src = jogo.imagem || '';
                    imagem.alt = '';

                    // Nome do jogo
                    const nome = document.createElement('span');
                    nome.classList.add('resultado-nome');
                    nome.textContent = jogo.nome;

                    // Avaliação do jogo
                    const avaliacao = document.createElement('div');
                    avaliacao.classList.add('resultado-avaliacao');

                    avaliacao.innerHTML = `
        <i data-lucide="star"></i>
        <span>${Number(jogo.nota || 0).toFixed(1).replace('.', ',')}</span>
    `;

                    item.appendChild(imagem);
                    item.appendChild(nome);
                    item.appendChild(avaliacao);

                    resultadosBusca.appendChild(item);
                });

                lucide.createIcons();

            }

            resultadosBusca.style.display = 'block';

        } catch (erro) {
            console.error('Erro ao pesquisar jogos:', erro);
        }

    }, 400);

});
