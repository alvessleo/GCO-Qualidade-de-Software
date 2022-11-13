SET autocommit = 0;

START TRANSACTION;

USE conformity;

-- Usuários
INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES ('João das Couves', 'joao_couves', '$2a$04$NNMRRIeaD..X2DoYtiTJP.M4VAa0KsBMpTK9ehV7WWNoSEb7cAKw.');
INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES ('Fulano Torres', 'fulano_torres', '$2a$04$NNMRRIeaD..X2DoYtiTJP.M4VAa0KsBMpTK9ehV7WWNoSEb7cAKw.');
INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES ('José Gamer', 'jose_gamer', '$2a$04$NNMRRIeaD..X2DoYtiTJP.M4VAa0KsBMpTK9ehV7WWNoSEb7cAKw.');
INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES ('Rosimar Fernandes', 'rosi_fernandes', '$2a$04$NNMRRIeaD..X2DoYtiTJP.M4VAa0KsBMpTK9ehV7WWNoSEb7cAKw.');
INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES ('Doutor Regra', 'dr_regra', '$2a$04$NNMRRIeaD..X2DoYtiTJP.M4VAa0KsBMpTK9ehV7WWNoSEb7cAKw.');
INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES ('Mister Amnésia', 'mr_amnesia', '$2a$04$NNMRRIeaD..X2DoYtiTJP.M4VAa0KsBMpTK9ehV7WWNoSEb7cAKw.');
INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES ('Senhor Barriga', 'sr_barriga', '$2a$04$NNMRRIeaD..X2DoYtiTJP.M4VAa0KsBMpTK9ehV7WWNoSEb7cAKw.');
INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES ('Tadalafellas da Silva', 'tadala_silva', '$2a$04$NNMRRIeaD..X2DoYtiTJP.M4VAa0KsBMpTK9ehV7WWNoSEb7cAKw.');

-- Empresas
INSERT INTO `empresa` (`nome`, `codigo_criador`) VALUES ('Sigma', 3);
INSERT INTO `empresa` (`nome`, `codigo_criador`) VALUES ('LigmaCorp', 5);
INSERT INTO `empresa` (`nome`, `codigo_criador`) VALUES ('Electronic Arts', 6);

-- Funcionários
-- João das Couves Desenvolvedor em Sigma
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `cargo`) VALUES (1, 1, "Desenvolvedor");
-- Fulano Torres Gerente de projeto em Sigma
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `cargo`) VALUES (2, 1, "Gerente de projeto");
-- José Gamer Analista de requisitos e auditor em Sigma
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `cargo`, `auditor`) VALUES (3, 1, "Analista de requisitos", TRUE);

-- Rosimar Fernandes Desenvolvedor em LigmaCorp
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `cargo`) VALUES (4, 2, "Desenvolvedor");
-- Doutor Regra Gerente geral em LigmaCorp
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `cargo`) VALUES (5, 2, "Gerente geral");

-- João das Couves Desenvolvedor em Electronic Arts
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `cargo`) VALUES (1, 3, "Desenvolvedor");
-- Mister Amnésia Analista de requisitos e auditor em Electronic Arts
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `cargo`, `auditor`) VALUES (6, 3, "Analista de requisitos", TRUE);

-- Auditores
-- Senhor Barriga auditor em Sigma
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `auditor`) VALUES (7, 1, TRUE);

-- Senhor Barriga auditor em LigmaCorp
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `auditor`) VALUES (7, 2, TRUE);
-- Tadalafellas da Silva auditor em LigmaCorp
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `auditor`) VALUES (8, 2, TRUE);

-- Tadalafellas da Silva auditor em Electronic Arts
INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `auditor`) VALUES (8, 3, TRUE);

-- Estados itens checklist
INSERT INTO `estadoItemChecklist` (`estado`, `descricao`) VALUES ("Não avaliado", "Item não avaliado por auditor.");
INSERT INTO `estadoItemChecklist` (`estado`, `descricao`) VALUES ("Atende", "Item atendido inteiramente no artefato.");
INSERT INTO `estadoItemChecklist` (`estado`, `descricao`) VALUES ("Não atende", "Item não atendido ou parcialmente atendido no artefato.");
INSERT INTO `estadoItemChecklist` (`estado`, `descricao`) VALUES ("Não se aplica", "Item não se aplica ao artefato.");
 
COMMIT;
