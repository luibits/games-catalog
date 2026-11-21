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


function buscarJogosPorNome($termo) {

    $apiKey = getenv('RAWG_API_KEY');

    $url = 'https://api.rawg.io/api/games?' . http_build_query([
        'key' => $apiKey,
        'search' => $termo,
        'page_size' => 12
    ]);

    $resposta = @file_get_contents($url);

    if ($resposta === false) {
        return [];
    }

    $dados = json_decode($resposta, true);

    return $dados['results'] ?? [];
}


function buscarJogoPorId($id) {

    $apiKey = getenv('RAWG_API_KEY');

    // Verifica se o ID é válido
    if (!filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
        return null;
    }

    // Monta a URL da API
    $url = 'https://api.rawg.io/api/games/' . $id . '?' . http_build_query([
        'key' => $apiKey
    ]);

    // Faz a requisição
    $resposta = @file_get_contents($url);

    if ($resposta === false) {
        return null;
    }

    // Converte o JSON em array PHP
    $dados = json_decode($resposta, true);

    if (!is_array($dados) || isset($dados['detail'])) {
        return null;
    }

    return $dados;
}
