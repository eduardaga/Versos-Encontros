<?php
include('conexao.php');

$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. PROTEÇÃO CONTRA ASPAS (real_escape_string)
    // Isso impede que títulos como "D'Avila" quebrem o sistema
    $titulo = $mysqli->real_escape_string($_POST['titulo']);
    $autor = $mysqli->real_escape_string($_POST['autor']);
    $ano = $mysqli->real_escape_string($_POST['ano']);
    $escola = $mysqli->real_escape_string($_POST['escola']);
    $resumo = $mysqli->real_escape_string($_POST['resumo']);
    
    // 2. VERIFICAÇÃO DE IMAGEM
    $arquivo = $_FILES['capa'];
    
    // Se o arquivo tiver erro (ex: tamanho muito grande), o PHP avisa
    if ($arquivo['error']) {
        $mensagem = "<p style='color:red'>Erro no arquivo. A imagem pode ser muito pesada (limite aprox. 2MB).</p>";
    } 
    else if($arquivo['name']) {
        $nome_arquivo = $arquivo['name'];
        $pasta_destino = "uploads/"; 
        $novo_nome = uniqid() . "_" . $nome_arquivo;
        $caminho_completo = $pasta_destino . $novo_nome;

        if(move_uploaded_file($arquivo['tmp_name'], $caminho_completo)) {
            
            // Tenta salvar no BANCO
            $sql = "INSERT INTO livro (titulo, autor, data_publicacao, escola_literaria, resumo, capa) 
                    VALUES ('$titulo', '$autor', '$ano', '$escola', '$resumo', '$caminho_completo')";

            if($mysqli->query($sql)) {
                $mensagem = "<p style='color:green; font-weight:bold;'>Livro cadastrado com sucesso!</p>";
            } else {
                // Mostra o erro exato do banco para sabermos o que houve
                $mensagem = "<p style='color:red'>Erro no Banco de Dados: " . $mysqli->error . "</p>";
            }
        } else {
            $mensagem = "<p style='color:red'>Erro ao salvar a imagem na pasta uploads.</p>";
        }
    } else {
        $mensagem = "<p style='color:red'>Por favor, selecione uma imagem.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Livro</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<header class="topo-site">
        <div class="logo-area">
            <a href="index.php">
                <img src="logo.png" alt="Versos e Encontros Logo">
            </a>
        </div>
        
    </header>

    <main class="cadastro-main">
        <div class="cadastro-container">
            <h2 style="text-align:center;">Cadastrar Novo Livro</h2>
            
            <?php if(isset($mensagem)) echo $mensagem; ?>

            <form method="POST" enctype="multipart/form-data" class="form-resenha" style="background:none; padding:0; box-shadow:none;">
                <label>Título do Livro:</label>
                <input type="text" name="titulo" required>

                <label>Autor:</label>
                <input type="text" name="autor" required>

                <label>Ano de Publicação:</label>
                <input type="text" name="ano" placeholder="Ex: 1899">

                <label>Escola Literária:</label>
                <input type="text" name="escola" placeholder="Ex: Realismo">

                <label>Resumo:</label>
                <textarea name="resumo" rows="5" required></textarea>

                <label>Capa do Livro (Imagem):</label>
                <input type="file" name="capa" accept="image/*" required style="padding: 10px; background: white;">

                <button type="submit" class="btn-padrao" style="width:100%">Cadastrar Livro</button>
            </form>
            
            <br>
            <div style="text-align:center; margin-top: 20px;">
                 <a href="index.php" style="color: #a33; font-weight: bold;">← Voltar para o Catálogo</a>
            </div>
        </div>
    </main>

    <footer>
    <div class="footer-container">
        
        <div class="footer-coluna footer-logo">
            <a href="index.php">
                <img src="logo_branco.png" alt="Versos e Encontros">
            </a>
        </div>

        <div class="footer-coluna footer-links">
            <h4>Saiba mais</h4>
            <ul>
                <li><a href="#">Quem somos</a></li>
                <li><a href="#">Termos de uso</a></li>
                <li><a href="#">Fale conosco</a></li>
                <li><a href="#">Central de ajuda</a></li>
            </ul>
        </div>

        <div class="footer-coluna footer-social">
            <h4>Siga nas redes sociais</h4>
            <div class="icones-social">
                <a href="#">📷</a> 
                <a href="#">📘</a> 
                <a href="#">▶️</a>
            </div>
        </div>

    </div>
</footer>

</body>
</html>