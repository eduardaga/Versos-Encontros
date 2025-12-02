-- 1. Criação do Banco (se ainda não existir)
CREATE DATABASE IF NOT EXISTS versoseencontros;
USE versoseencontros;

CREATE TABLE livro (
    id_livro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    data_publicacao VARCHAR(4), -- Pode ser apenas o ano (ex: "1899")
    escola_literaria VARCHAR(50),
    resumo TEXT, -- TEXT suporta textos longos
    capa VARCHAR(255) -- Aqui salvaremos o nome do arquivo (ex: "domcasmurro.jpg")
);

-- 3. Tabela para as Resenhas
-- O id_livro conecta essa resenha ao livro correto
CREATE TABLE resenha (
    id_resenha INT AUTO_INCREMENT PRIMARY KEY,
    id_livro INT NOT NULL,
    nome_aluno VARCHAR(50) NOT NULL,
    turma_aluno VARCHAR(10) NOT NULL, 
    texto_resenha TEXT NOT NULL,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_livro) REFERENCES livro(id_livro) ON DELETE CASCADE
);

select * from livro;