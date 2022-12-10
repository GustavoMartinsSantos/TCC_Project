DROP DATABASE  IF EXISTS TCC_DB;
CREATE DATABASE TCC_DB;
USE TCC_DB;

CREATE TABLE tbl_Usuario (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(30) NOT NULL,
    Sobrenome VARCHAR(100),
    Email VARCHAR(100) NOT NULL UNIQUE,
    Senha VARCHAR(10) NOT NULL,
    RecSenhaToken VARCHAR(220),
    ADM INT NOT NULL,
    ID_Imagem INT
);

CREATE TABLE tbl_Imagem (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE tbl_Grupo (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL
);

CREATE TABLE tbl_Classificacao (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(50) NOT NULL
);

CREATE TABLE tbl_Evento (
    Cod INT PRIMARY KEY AUTO_INCREMENT,
    Titulo VARCHAR(200) NOT NULL,
    DataHora_Inicio DATETIME,
    DataHora_Venc DATETIME,
    Descricao TEXT,
    ID_Imagem INT
);

CREATE TABLE tbl_UsuarioXGrupo (
    ID_Usuario INT,
    ID_Grupo INT,
    Permissao INT NOT NULL,
    PRIMARY KEY (ID_Usuario, ID_Grupo)
);

CREATE TABLE tbl_EventoXGrupo (
    Cod_Evento INT,
    ID_Grupo INT,
    PRIMARY KEY (Cod_Evento, ID_Grupo)
);

CREATE TABLE tbl_Classifica (
    ID_Classificacao INT,
    Cod_Evento INT,
    PRIMARY KEY (Cod_Evento, ID_Classificacao)
);

CREATE TABLE tbl_Favorita (
    ID_Usuario INT,
    Cod_Evento INT,
    PRIMARY KEY (Cod_Evento, ID_Usuario)
);

ALTER TABLE tbl_Usuario ADD CONSTRAINT FK_Imagem_Usuario
FOREIGN KEY (ID_Imagem)
REFERENCES tbl_Imagem (ID)
ON UPDATE CASCADE
ON DELETE SET NULL;
 
ALTER TABLE tbl_Evento ADD CONSTRAINT FK_Imagem_Evento
FOREIGN KEY (ID_Imagem)
REFERENCES tbl_Imagem (ID)
ON UPDATE CASCADE
ON DELETE SET NULL;
 
ALTER TABLE tbl_UsuarioXGrupo ADD CONSTRAINT FK_UsuarioXGrupo
FOREIGN KEY (ID_Usuario)
REFERENCES tbl_Usuario (ID)
ON UPDATE CASCADE
ON DELETE CASCADE;
 
ALTER TABLE tbl_UsuarioXGrupo ADD CONSTRAINT FK_GrupoXUsuario
FOREIGN KEY (ID_Grupo)
REFERENCES tbl_Grupo (ID)
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE tbl_EventoXGrupo ADD CONSTRAINT FK_EventoXGrupo
FOREIGN KEY (Cod_Evento)
REFERENCES tbl_Evento (Cod)
ON UPDATE CASCADE
ON DELETE CASCADE;
 
ALTER TABLE tbl_EventoXGrupo ADD CONSTRAINT FK_GrupoXEvento
FOREIGN KEY (ID_Grupo)
REFERENCES tbl_Grupo (ID)
ON UPDATE CASCADE
ON DELETE CASCADE;
 
ALTER TABLE tbl_Classifica ADD CONSTRAINT FK_EventoXClassificacao
FOREIGN KEY (Cod_Evento)
REFERENCES tbl_Evento (Cod)
ON UPDATE CASCADE
ON DELETE CASCADE;
 
ALTER TABLE tbl_Classifica ADD CONSTRAINT FK_ClassificacaoXEvento
FOREIGN KEY (ID_Classificacao)
REFERENCES tbl_Classificacao (ID)
ON UPDATE CASCADE
ON DELETE CASCADE;
 
ALTER TABLE tbl_Favorita ADD CONSTRAINT FK_UsuarioXFavorita
FOREIGN KEY (ID_Usuario)
REFERENCES tbl_Usuario (ID)
ON UPDATE CASCADE
ON DELETE CASCADE;
 
ALTER TABLE tbl_Favorita ADD CONSTRAINT FK_FavoritaXUsuario
FOREIGN KEY (Cod_Evento)
REFERENCES tbl_Evento (Cod)
ON UPDATE CASCADE
ON DELETE CASCADE;

INSERT INTO tbl_Imagem (Nome) VALUES
('user_pad.png'),
('4a148a3ff52ba3f32d507883311f9b75.png'),
('32d24c40e7ed9532daPd889c87ea2068.png'),
('4a148a3ff52ba3f32d507883311f9b74.png'),
('0ec214e9f9d82bbe3c42d1a0739b8307.jpg');

INSERT INTO tbl_Usuario (Nome, Sobrenome, Email, Senha, ADM, ID_Imagem) VALUES
('Gustavo', 'Martins dos Santos', 'gustavo_mts2005@hotmail.com', '1234567890', 0, 2),
('Carlos', 'Alberto Silva', 'carlinhos123@gmail.com', 'C4arL0S03', 1, NULL),
('Jorge', 'Silva', 'profjorgeetec@gmail.com', '12345Jorge', 1, 3),
('Theo', 'Silva Marques', 'theoprof@gmail.com', 'k4n6nPU32B', 0, NULL),
('Michele', '', 'michelefisica@gmail.com', 'NewtonPoc', 0, NULL);

INSERT INTO tbl_Classificacao (Nome) VALUES
('Festa'), ('Provas'), ('Feira'), ('Apresentação');

INSERT INTO tbl_Grupo (Nome) VALUES
('3ºB'), ('3ºC/B'), ('Monitoria');

INSERT INTO tbl_UsuarioXGrupo (ID_Grupo, ID_Usuario, Permissao) VALUES
(1, 1, 0), (1, 2, 1), (1, 3, 0), (1, 4, 0),
(2, 3, 1), (2, 5, 0),
(3, 2, 0), (3, 3, 1);

INSERT INTO tbl_Evento (Titulo, DataHora_Inicio, DataHora_Venc, Descricao, ID_Imagem) VALUES
('3º CGetec', '2022-11-05 07:00', '2022-11-05 13:30', null, null),
('Formatura', '2022-12-20 12:00', '2023-05-23 21:00', 'Esta será a cerimônia de encerramento do ensino médio dos terceiros anos', 4),
('Pré-Banca', '2022-11-25 10:40', '2022-11-25 16:00', 'A pré-banca tem por função avaliar o desenvolvimento do trabalho e fazer recomendações para o seu desenvolvimento final. Ela avaliará se o estágio de desenvolvimento demonstra a possibilidade ou não.', 5),
('Banca de TCC', '2022-12-07 07:00', '2022-12-07 16:00', 'A banca do TCC é formada por uma comissão de professores avaliadores. Seu papel consiste em determinar se o aluno atingiu um desempenho satisfatório na elaboração da pesquisa.', null);

INSERT INTO tbl_Classifica (Cod_Evento, ID_Classificacao) VALUES
(1, 3), (1, 1), (2, 1),(3, 4), (4, 4);

INSERT INTO tbl_EventoXGrupo (ID_Grupo, Cod_Evento) VALUES
(1, 1), (1, 2), (2, 1), (2, 2), (3, 1), (1, 3), (1, 4);

INSERT INTO tbl_Favorita (ID_Usuario, Cod_Evento) VALUES
(2, 1), (4, 1), (3, 2);