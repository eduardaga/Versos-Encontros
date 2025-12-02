<?php
include('conexao.php');
$sql_code = "SELECT * FROM livro";
$sql_query = $mysqli->query($sql_code) or die("Falha: " . $mysqli->error);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Versos e Encontros - Início</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<header class="topo-site">
        <div class="logo-area">
            <a href="index.php">
                <img src="logo.png" alt="Versos e Encontros Logo">
            </a>
        </div>
        
        <div class="botao-area">
            <a href="cadastrar_livro.php" class="btn-professor">
                + Área do Professor
            </a>
        </div>
    </header>

    <section class="banner-principal">
        <h1>VERSOS E ENCONTROS</h1>
        <p>Descubra novas histórias conosco!</p>
    </section>

    <main class="catalogo-container">
        <h2 class="titulo-secao">Comece por aqui</h2>
        
        <div class="lista-livros">
            <?php while($livro = $sql_query->fetch_assoc()) { ?>
                
                <div class="card-livro">
                    <a href="detalhes.php?id_livro=<?php echo $livro['id_livro']; ?>">
                        <img src="<?php echo $livro['capa']; ?>" alt="Capa de <?php echo $livro['titulo']; ?>">
                        <h3><?php echo $livro['titulo']; ?></h3>
                        <p><?php echo $livro['autor']; ?></p>
                    </a>
                </div>

            <?php } ?>
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