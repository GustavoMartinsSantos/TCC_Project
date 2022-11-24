USE TCC_DB;

INSERT INTO tbl_Materia (Nome) VALUES
('Matemática'), ('Física'), ('TI'), ('Português'), ('Filosofia');

INSERT INTO tbl_Imagem (Nome) VALUES
('4a148a3ff52ba3f32d507883311f9b75.png'),
('001a3c8070bba2bdb3215211d0cfceep.png'),
('32d24c40e7ed9532daPd889c87ea2068.png'),
('39652ba7e29fe2a29152a3ue7afd34d5.png'),
('731f04196fcb0e29o2d550fcf689bfe3.png');

INSERT INTO tbl_Usuario (Nome, Sobrenome, Email, Senha, ID_Imagem) VALUES
('Gustavo', 'Martins dos Santos', 'gustavo_mts2005@hotmail.com', '1234567890', 1),
('Carlos', 'Alberto Silva', 'carlinhos123@gmail.com', 'C4arL0S03', NULL),
('Jorge', 'Silva Santos', 'profjorgeetec@gmail.com', '12345Jorge', 3),
('Theo', 'Silva Marques', 'theoprof@gmail.com', 'k4n6nPU32B', NULL),
('Michele', '', 'michelefisica@gmail.com', 'NewtonPoc', NULL);

INSERT INTO tbl_Questao (Pergunta, ID_Imagem) VALUES
(NULL, 2),
('(Fuvest) A lei de conservação da carga elétrica pode ser enunciada como segue:', NULL),
(NULL, 5);

INSERT INTO tbl_Task (Nome, HTML_Text) VALUES
('Exercícios de Eletrostática', ''),
('Avaliação sobre Funções', '<img src="IMG/Tasks/39652ba7e29fe2a29152a3ue7afd34d5.png">');

INSERT INTO tbl_Alternativa (Opcao, Status, Descricao, ID_Questao) VALUES
('a', 0, 'par', 1),
('b', 0, 'ímpar', 1),
('c', 0, 'não inteiro', 1),
('d', 1, 'inteiro', 1),
('e', 0, 'infinito', 1),
('a', 1, 'A soma algébrica dos valores das cargas positivas e negativas em um sistema isolado é constante', 2),
('b', 0, 'Um objeto eletrizado positivamente ganha elétrons ao ser aterrado', 2),
('c', 0, 'A carga elétrica de um corpo eletrizado é igual a um número inteiro multiplicado pela carga do elétron', 2),
('d', 0, 'O número de átomos existentes no Universo é constante', 2),
('e', 0, 'As cargas elétricas do próton e do elétron são, em módulo, iguais', 2);

SELECT * FROM tbl_Usuario
LEFT JOIN tbl_imagem
ON ID_Imagem = tbl_imagem.ID;

SELECT Q.ID, Pergunta, I.Nome AS 'Imagem', Opcao, Status, Descricao
FROM tbl_Questao Q
LEFT JOIN tbl_Imagem I
ON ID_Imagem = I.ID
LEFT JOIN tbl_Alternativa A
ON ID_Questao = Q.ID;

select * FROM tbl_Imagem;

SELECT * FROM tbl_Questao;