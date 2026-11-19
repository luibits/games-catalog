<?php

function buscarJogosDestaque() {

    $apiKey = getenv('RAWG_API_KEY');

    $url = 'https://api.rawg.io/api/games?' . http_build_query([
        'key' => $apiKey,
        'page_size' => 20,
        'ordering' => '-added'
    ]);

    $resposta = file_get_contents($url);

    if ($resposta === false) {
        return [];
    }

    $dados = json_decode($resposta, true);

    return $dados['results'] ?? [];
}

function buscarJogoDestaque() {

    $jogos = buscarJogosDestaque();

    if (empty($jogos)) {
        return null;
    }

    return $jogos[array_rand($jogos)];
}

function buscarJogosCatalogo($quantidade = 12) {

    $jogos = buscarJogosDestaque();

    if (empty($jogos)) {
        return [];
    }

    shuffle($jogos);

    return array_slice($jogos, 0, $quantidade);
}