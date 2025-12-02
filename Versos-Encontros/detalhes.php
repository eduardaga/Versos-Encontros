<?php
include('conexao.php');

if(isset($_GET['id_livro'])) { $id_livro = $_GET['id_livro']; } else { die("ID faltando!"); }
$sql_livro = "SELECT * FROM livro WHERE id_livro = $id_livro";
$query_livro = $mysqli->query($sql_livro);
$livro = $query_livro->fetch_assoc();
if(!$livro) { die("Livro não encontrado!"); }
$sql_resenhas = "SELECT * FROM resenha WHERE id_livro = $id_livro ORDER BY id_resenha DESC";
$query_resenhas = $mysqli->query($sql_resenhas);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $livro['titulo']; ?> - Detalhes</title>
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

    <section class="banner-principal">
        <h1>VERSOS E ENCONTROS</h1>
        <p>Descubra novas histórias conosco!</p>
    </section>

    <main class="detalhes-main">
        <div class="detalhes-container">
            
            <div class="area-livro">
                <div class="capa-grande">
                    <img src="<?php echo $livro['capa']; ?>" alt="Capa de <?php echo $livro['titulo']; ?>">
                </div>
                <div class="info-livro">
                    <h1><?php echo $livro['titulo']; ?></h1>
                    <p class="resumo-texto"><?php echo nl2br($livro['resumo']); ?></p>
                    
                    <div class="dados-tecnicos">
                        <p><strong>Autor:</strong> <?php echo $livro['autor']; ?></p>
                        <p><strong>Ano de Publicação:</strong> <?php echo $livro['data_publicacao']; ?></p>
                        <p><strong>Escola Literária:</strong> <?php echo $livro['escola_literaria']; ?></p>
                    </div>
                </div>
            </div>

            <div class="area-interacao">
                
                <div class="coluna-resenhas">
                    <h2>Últimas Avaliações</h2>
                    
                    <?php if($query_resenhas->num_rows == 0): ?>
                        <p style="color: #777; font-style: italic;">Este livro ainda não foi avaliado. Seja o primeiro!</p>
                    <?php else: ?>
                        <?php while($resenha = $query_resenhas->fetch_assoc()): ?>
                            <div class="resenha-item">
                                <div class="resenha-autor">
                                    <?php echo $resenha['nome_aluno']; ?>
                                    <span class="resenha-turma"><?php echo $resenha['turma_aluno']; ?></span>
                                </div>
                                <div class="resenha-conteudo">
                                    "<?php echo nl2br($resenha['texto_resenha']); ?>"
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <div class="coluna-form">
                    <h2>Deixe sua opinião também!</h2>
                    
                    <form action="salvar_resenha.php" method="POST" class="form-resenha">
                        <input type="hidden" name="id_livro" value="<?php echo $livro['id_livro']; ?>">
                        
                        <input type="text" name="nome" placeholder="Digite o seu nome" required>
                        
                        <select name="turma" required>
                            <option value="" disabled selected>Qual a sua turma?</option>
                            <option value="1A">1A</option> <option value="1B">1B</option>
                            <option value="2A">2A</option> <option value="2B">2B</option>
                            <option value="3A">3A</option> <option value="3B">3B</option>
                        </select>

                        <textarea name="resenha" rows="6" placeholder="Deixe aqui o que você achou dessa obra..." required></textarea>
                        
                        <button type="submit" class="btn-padrao" style="width: 100%;">Enviar resenha</button>
                    </form>
                </div>

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