
<?php

$apiKeys = require __DIR__ . '/../config/api_keys.php';

function obterChaveYoutube() {

    global $apiKeys;

    return getenv('YOUTUBE_API_KEY') ?: ($apiKeys['YOUTUBE_API_KEY'] ?? '');
}

function buscarTrailerJogo($nomeJogo) {

    $apiKey = obterChaveYoutube();

    if (empty($apiKey)) {
        return null;
    }

    $url = 'https://www.googleapis.com/youtube/v3/search?' . http_build_query([
        'key' => $apiKey,
        'part' => 'snippet',
        'q' => $nomeJogo . ' official trailer',
        'type' => 'video',
        'videoEmbeddable' => 'true',
        'maxResults' => 1
    ]);

    $resposta = @file_get_contents($url);

    if ($resposta === false) {
        return null;
    }

    $dados = json_decode($resposta, true);

    if (empty($dados['items'][0])) {
        return null;
    }

    $video = $dados['items'][0];

    return [
        'id' => $video['id']['videoId'],
        'titulo' => $video['snippet']['title'],
        'thumbnail' => $video['snippet']['thumbnails']['high']['url']
    ];
}
