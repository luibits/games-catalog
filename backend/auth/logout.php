<?php

// Inicia a sessão atual
session_start();

// Remove todas as variáveis da sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona para a tela de login
header('Location: ../../frontend/login.php');
exit;
