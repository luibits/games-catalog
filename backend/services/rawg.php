
<?php

$apiKeys = require __DIR__ . '/../config/api_keys.php';

function obterChaveRawg() {

    global $apiKeys;

    return getenv('RAWG_API_KEY') ?: ($apiKeys['RAWG_API_KEY'] ?? '');
}

function buscarJogosDestaque() {

    $apiKey = obterChaveRawg();

    $url = 'https://api.rawg.io/api/games?' . http_build_query([
        'key' => $apiKey,
        'page_size' => 20,
        'ordering' => '-added'
    ]);

    $resposta = @file_get_contents($url);

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

    $apiKey = obterChaveRawg();

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

    $apiKey = obterChaveRawg();

    if (!filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
        return null;
    }

    $url = 'https://api.rawg.io/api/games/' . $id . '?' . http_build_query([
        'key' => $apiKey
    ]);

    $resposta = @file_get_contents($url);

    if ($resposta === false) {
        return null;
    }

    $dados = json_decode($resposta, true);

    if (!is_array($dados) || isset($dados['detail'])) {
        return null;
    }

    return $dados;
}
