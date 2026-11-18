
<?php

require_once __DIR__ . '/../backend/services/rawg.php';

$jogos = buscarJogosDestaque();

foreach ($jogos as $jogo) {

    echo '<h2>' . htmlspecialchars($jogo['name']) . '</h2>';

    echo '<p>Nota: ' . $jogo['rating'] . '</p>';

    echo '<p>Lançamento: ' . $jogo['released'] . '</p>';

    echo '<img src="' . htmlspecialchars($jogo['background_image']) . '" width="300">';
    
    echo '<hr>';
}
