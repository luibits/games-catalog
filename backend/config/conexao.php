<?php

$hostAtual = $_SERVER['HTTP_HOST'] ?? '';
$hostAtual = explode(':', $hostAtual)[0];

// Verifica se está rodando localmente
if (
    $hostAtual === 'localhost' ||
    $hostAtual === '127.0.0.1'
) {
    require_once __DIR__ . '/conexao.local.php';
} else {
    require_once __DIR__ . '/conexao.producao.php';
}
