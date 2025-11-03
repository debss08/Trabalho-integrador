<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $sql = "INSERT INTO livros (titulo, autor, id_categoria, disponivel)
            VALUES ('$titulo', '$autor', '$categoria', TRUE)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Livro cadastrado com sucesso!'); window.location.href='../html/biblio.html';</script>";
    } else {
        echo "Erro: " . $conn->error;
    }
    $conn->close();
}
?>
