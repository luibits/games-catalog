
<?php

function buscarTrailerJogo($nomeJogo) {

    $apiKey = getenv('YOUTUBE_API_KEY');

    // Verifica se a chave está configurada
    if (empty($apiKey)) {
        return null;
    }

    // Monta a URL da pesquisa
    $url = 'https://www.googleapis.com/youtube/v3/search?' . http_build_query([
        'key' => $apiKey,
        'part' => 'snippet',
        'q' => $nomeJogo . ' official trailer',
        'type' => 'video',
        'videoEmbeddable' => 'true',
        'maxResults' => 1
    ]);

    // Consulta a API
    $resposta = @file_get_contents($url);

    if ($resposta === false) {
        return null;
    }

    // Converte a resposta JSON
    $dados = json_decode($resposta, true);

    if (empty($dados['items'][0])) {
        return null;
    }

    $video = $dados['items'][0];

    // Retorna os dados do trailer
    return [
        'id' => $video['id']['videoId'],
        'titulo' => $video['snippet']['title'],
        'thumbnail' => $video['snippet']['thumbnails']['high']['url']
    ];
}
