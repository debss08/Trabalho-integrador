<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de biblioteca</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/global.js"></script>
</head>
<body class="fundoAzul">
    <aside>
        <button id="opennavBar">
            <i class="fa-solid fa-angles-left" id="abrirMenu"></i>
            <i class="fa-solid fa-angles-right" id="fecharMenu" style="display: none;"></i>
        </button>
        <nav id="navBar">
            <div class="infosUser-menu flexRow">
                <i class="fa-regular fa-user"></i>
                <div class="flexColumn">
                    <p class="bolder">Nome do funcionário</p>
                    <p>Cargo do funcionário</p>
                </div>
            </div>
            <ul class="navBar-list">
                <li>
                    <a href="../html/inicio.html" class="navBar-itemList">
                        <i class="fa-solid fa-house"></i>
                        <p>Início</p>
                    </a>
                </li>
                <li>
                    <a href="../html/emprestimos.html" class="navBar-itemList">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>Empréstimos</p>
                    </a>
                </li>
                <li>
                    <a href="../html/biblio.html" class="navBar-itemList">
                        <i class="fa-solid fa-book"></i>
                        <p>Acervo</p>
                    </a>
                </li>
            </ul>
            <a class="logout flexRow" type="button" href="login.html">
                <i class="fa-solid fa-right-from-bracket"></i>
                <p>Logout</p>
            </a>
        </nav>

    </aside>
    <main id="content">
        <div class="container textWelcome">
            <h1 class="tituloPrincipal">Bem vindo(a), <span data-span="nomeUsuario">Débora Martins de Oliveira</span>!</h1>
            <p class="descricao">Você está acessando o Sistema de gerenciamento da biblioteca :)</p>
        </div>

        <!--Ações rápidas-->
        <div class="destaque">
            <h1>O que quer fazer hoje?</h1>
        </div>

        <div class="mainActions-container">
            <div class="mainAction">
                <a href="../html/novoLivro.html" class="icon-mainAction">
                    <i class="fa-solid fa-book-open"></i>
                </a>
                <h2>Cadastrar um lovo livro</h2>
                <a href="../html/novoLivro.html">
                <button type="button" class="btn btn-mainAction">
                    Acessar
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                </a>
            </div>
            <div class="mainAction">
                <a href="../html/novaVenda.html" class="icon-mainAction">
                    <i class="fa-solid fa-tags"></i>
                </a>
                <h2>Fazer uma nova venda</h2>
                <a href="../html/novaVenda.html">
                <button type="button" class="btn btn-mainAction">
                    Acessar
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                </a>
            </div>
            <div class="mainAction">
                <a href="../html/biblio.html" class="icon-mainAction">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
                <h2>Consultar o acervo</h2>
                <a href="../html/biblio.html" >
                <button type="button" class="btn btn-mainAction">
                    Acessar
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                </a>
            </div>
        </div>
    </main>
</body>
</html>