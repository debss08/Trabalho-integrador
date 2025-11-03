<?php
// processa_cadastro.php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/cadastro.html');
    exit();
}

$nome = trim($_POST['nome'] ?? '');
$cargo = trim($_POST['cargo'] ?? '');
$matricula = trim($_POST['matricula'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($nome === '' || $cargo === '' || $matricula === '' || $senha === '') {
    echo paginaErro("Por favor preencha todos os campos.", "../html/cadastro.html");
    exit();
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

// define nivel por cargo (ajuste conforme quiser)
$nivel = (in_array(strtolower($cargo), ['administrador', 'admin'])) ? 'admin' : 'usuario';

$sql = "INSERT INTO usuarios (nome, cargo, matricula, senha_hash, nivel) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo paginaErro("Erro na preparação da consulta: " . htmlspecialchars($conn->error), "../html/cadastro.html");
    exit();
}

$stmt->bind_param("sssss", $nome, $cargo, $matricula, $hash, $nivel);

if ($stmt->execute()) {
    // cadastro OK -> mostrar página customizada com botão para login
    echo paginaSucesso($nome);
    $stmt->close();
    $conn->close();
    exit();
} else {
    // checar se é erro de duplicação de matrícula (código MySQL 1062)
    if ($conn->errno === 1062) {
        echo paginaErro("Matrícula já cadastrada. Tente outra matrícula ou faça login.", "../html/login.html");
    } else {
        echo paginaErro("Erro ao cadastrar: " . htmlspecialchars($conn->error), "../html/cadastro.html");
    }
}

$stmt->close();
$conn->close();
exit();

/* ===========================
   Funções que geram páginas
   =========================== */

function paginaSucesso(string $nome): string {
    $nomeEsc = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
    return <<<HTML
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Cadastro realizado</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../css/global.css">
  <style>
    /* estilos mínimos caso não queria depender totalmente do CSS */
    body { font-family: Arial, sans-serif; display:flex; align-items:center; justify-content:center; min-height:100vh; background:#f3f7fb; margin:0; }
    .card { background:#fff; padding:28px; border-radius:10px; box-shadow:0 6px 18px rgba(0,0,0,0.08); text-align:center; max-width:420px; width:90%; }
    .card h1 { margin:0 0 8px; font-size:20px; }
    .card p { color:#444; margin:8px 0 18px; }
    .btn { display:inline-block; padding:10px 18px; border-radius:8px; text-decoration:none; background:#2b6df6; color:#fff; }
    .muted { display:block; margin-top:12px; color:#666; font-size:14px; }
  </style>
</head>
<body>
  <div class="card" role="status">
    <h1>Cadastro realizado com sucesso!</h1>
    <p>Bem-vindo(a), <strong>{$nomeEsc}</strong>. Sua conta foi criada.</p>
    <a class="btn" href="../html/login.html">Ir para o Login</a>
    <span class="muted">Se preferir, feche esta janela ou volte à página inicial.</span>
  </div>
</body>
</html>
HTML;
}

function paginaErro(string $mensagem, string $linkVoltar): string {
    $msgEsc = htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8');
    $linkEsc = htmlspecialchars($linkVoltar, ENT_QUOTES, 'UTF-8');
    return <<<HTML
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Erro no cadastro</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../css/global.css">
  <style>
    body { font-family: Arial, sans-serif; display:flex; align-items:center; justify-content:center; min-height:100vh; background:#fff6f6; margin:0; }
    .card { background:#fff; padding:22px; border-radius:10px; box-shadow:0 6px 18px rgba(0,0,0,0.06); text-align:center; max-width:480px; width:90%; }
    .error { color:#b00020; margin-bottom:12px; font-weight:600; }
    .btn { display:inline-block; padding:10px 16px; border-radius:8px; text-decoration:none; background:#e0e0e0; color:#111; }
  </style>
</head>
<body>
  <div class="card" role="alert">
    <div class="error">{$msgEsc}</div>
    <a class="btn" href="{$linkEsc}">Voltar</a>
  </div>
</body>
</html>
HTML;
}
