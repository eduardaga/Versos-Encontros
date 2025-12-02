<?php
include('conexao.php');

// Verifica se os dados vieram do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Recebe os dados
    $id_livro = $_POST['id_livro'];
    $nome = $_POST['nome'];
    $turma = $_POST['turma'];
    $resenha = $_POST['resenha'];

    // 2. Proteção básica contra aspas (ex: D'Avila) para não quebrar o SQL
    $nome = $mysqli->real_escape_string($nome);
    $resenha = $mysqli->real_escape_string($resenha);

    // 3. Monta o SQL de Inserção
    $sql_inserir = "INSERT INTO resenha (id_livro, nome_aluno, turma_aluno, texto_resenha, data_envio) 
                    VALUES ('$id_livro', '$nome', '$turma', '$resenha', NOW())";

    // 4. Executa no Banco
    if ($mysqli->query($sql_inserir)) {
        // SUCESSO!
        // Redireciona o usuário de volta para a página do livro automaticamente
        header("Location: detalhes.php?id_livro=$id_livro");
        exit; // Encerra o script para garantir o redirecionamento
    } else {
        // Se der erro, mostra na tela
        echo "Erro ao salvar resenha: " . $mysqli->error;
        echo "<br><a href='detalhes.php?id_livro=$id_livro'>Voltar</a>";
    }
} else {
    // Se alguém tentar abrir esse arquivo direto sem enviar formulário, manda para o início
    header("Location: index.php");
}
?>