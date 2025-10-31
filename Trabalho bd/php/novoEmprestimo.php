<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_livro = $_POST['id_livro'];
    $id_aluno = $_POST['id_aluno'];
    $data_retirada = $_POST['data_retirada'];
    $data_devolucao = $_POST['data_devolucao'];

    $sql = "INSERT INTO emprestimos (id_livro, id_aluno, data_retirada, data_devolucao)
            VALUES ('$id_livro', '$id_aluno', '$data_retirada', '$data_devolucao')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Empréstimo registrado com sucesso!'); window.location.href='../html/vendas.html';</script>";
    } else {
        echo "Erro: " . $conn->error;
    }

    $conn->close();
}
?>
