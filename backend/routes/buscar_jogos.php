<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../services/rawg.php';

$termoBusca = trim($_GET['busca'] ?? '');

if (strlen($termoBusca) < 2) {
    echo json_encode([]);
    exit;
}

$jogos = buscarJogosPorNome($termoBusca);

$resultados = [];

foreach ($jogos as $jogo) {
    $resultados[] = [
        'id' => $jogo['id'] ?? null,
        'nome' => $jogo['name'] ?? 'Jogo sem nome',
        'imagem' => $jogo['background_image'] ?? null,
        'nota' => $jogo['rating'] ?? 0
    ];
}

echo json_encode($resultados, JSON_UNESCAPED_UNICODE);
