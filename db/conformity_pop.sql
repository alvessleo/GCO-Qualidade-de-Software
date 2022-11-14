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

-- Populacao dos Artefatos
INSERT INTO `artefato` (`codigo_empresa`, `nome_artefato`, `recurso`) VALUES (1, "Repositório ferramenta X", "http://www.github.com/sigma/ferramentax");

INSERT INTO `artefato`(`codigo_empresa`, `nome_artefato`, `recurso`) VALUES (2, "Ligma Corpe", "http://www.github.com/ligmacorp/Ligma_Corpe");
INSERT INTO `artefato`(`codigo_empresa`, `nome_artefato`, `recurso`) VALUES (2, "Ligma System", "http://www.github.com/ligmasys/Ligma_System");

INSERT INTO `artefato` (`codigo_empresa`, `nome_artefato`, `recurso`) VALUES (3, "Battlefield 2042", "http://www.github.com/EA/bf2042");
INSERT INTO `artefato` (`codigo_empresa`, `nome_artefato`, `recurso`) VALUES (3, "FIFA 2022", "http://www.github.com/EA/fifa22");
 
-- Checklists   
--  José Gamer autor 'Checklist Repo Ferramenta X' (Sigma)
INSERT INTO `checklist` (`codigo_autor`, `codigo_artefato`, `nome`) VALUES (3, 1, "Checklist Repo Ferramenta X");

--  Senhor Barriga autor 'Checklist Ligma Corpe' (LigmaCorp)
INSERT INTO `checklist` (`codigo_autor`, `codigo_artefato`, `nome`) VALUES (7, 2, "Checklist Ligma Corpe");

-- Tadalafellas da Silva autor 'Checklist Ligma System' (LigmaCorp)
INSERT INTO `checklist` (`codigo_autor`, `codigo_artefato`, `nome`) VALUES (8, 3, "Checklist Ligma System");

-- Tadalafellas da Silva autor 'Checklist Eletronic Arts Battlefield' (EA)
INSERT INTO `checklist` (`codigo_autor`, `codigo_artefato`, `nome`) VALUES (8, 4, "Checklist Eletronic Arts Battlefield");

-- Mister Amnésia autor 'Checklist Eletronic Arts Fifa' (EA)
INSERT INTO `checklist` (`codigo_autor`, `codigo_artefato`, `nome`) VALUES (6, 5, "Checklist Eletronic Arts Fifa");

-- Itens checklist (meu Deus)
-- Itens 'Checklist Repo Ferramenta X'
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`, `comentario`) VALUES (1, 2, "Repositório contém mais de um branch ativamente utilizado.", "4 branches utilizados.");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`, `comentario`) VALUES (1, 3, "Repositório não possuí arquivos binários (executáveis)", "Arquivos binários presentes em /out/x64/bin");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`) VALUES (1, 1, "Repositório possuí commits documentados.");

-- Itens 'Checklist Ligma Corpe'
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`) VALUES (2, 2, "Todas as versões do projeto estão documentadas");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`) VALUES (2, 2, "Existe uma branch 'baseline' robusta para ser usada como fallback");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`, `comentario`) VALUES (2, 3, "O repositório possuí um nome maneiro" , "O nome do repositório é tosco.");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`) VALUES (2, 4, "A numeração da versão do projeto possuí signficancia em cada dígito");

-- Itens 'Checklist Ligma System'
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`) VALUES (3, 2, "O repositório possui uma branch para cada nova função");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`, `comentario`) VALUES (3, 3, "O repositório possui algum 'releases'", "Nenhum release existe no repositório.");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`) VALUES (3, 1, "Os itens de configuração para versionamento estão completos");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`) VALUES (3, 1, "O repositorio possui nome");

-- Itens 'Checklist Eletronic Arts Battlefield'
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`, `comentario`) VALUES (4, 3, "A versão inicial do jogo foi lançada em estado funcional", "O jogo saiu todo lascado, vacilaram...");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`, `comentario`) VALUES (4, 3, "Todos os colaboradores possui o repositorio em suas máquinas pessoais", "Tem gente sem o repo local... :/");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`) VALUES (4, 4, "Repositorio possui alguma Tags");

-- Itens 'Checklist Eletronic Arts Fifa'
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`) VALUES (5, 2, "Repositório possui todos os colaboradores do projeto");
INSERT INTO `itemChecklist` (`codigo_checklist`, `codigo_estado`, `item`) VALUES (5, 2, "Repositório possui um Readme");

-- Não conformidades
-- NC 'Checklist Repo Ferramenta X'
INSERT INTO `itemNC`(`codigo_itemChecklist`, `codigo_responsavel`, `descricao`, `sugestao`, `prazo`) VALUES (2, 2, "Arquivos binários no repo", "Adicionar binários ao .gitignore", "2022-11-20");

-- NC 'Checklist Ligma Corpe'
INSERT INTO `itemNC`(`codigo_itemChecklist`, `codigo_responsavel`, `descricao`, `sugestao`, `prazo`) VALUES (6, 4, "O repositorio possui um nome tosco", "Mudar o nome do respositório", "2022-11-18");

-- NC 'Checklist Ligma System'
INSERT INTO `itemNC`(`codigo_itemChecklist`, `codigo_responsavel`, `descricao`, `sugestao`, `prazo`) VALUES (9, 5, "Não há releases no repositório", "Gerar release estável com base na baseline", "2022-11-19");

-- NC 'Checklist Eletronic Arts Battlefield'
INSERT INTO `itemNC`(`codigo_itemChecklist`, `codigo_responsavel`, `descricao`, `sugestao`, `prazo`) VALUES (12, 1, "Estado da versão inicial do jogo muito ruim", "Fechar a empresa, pois não possuí salvação", "2023-01-01");
INSERT INTO `itemNC`(`codigo_itemChecklist`, `codigo_responsavel`, `descricao`, `sugestao`, `prazo`) VALUES (13, 6, "Nem todos os colaboradores possui o repositorio em suas máquinas pessoais", "Todos os colaboradores do projeto baixarem em sua máquina o repositório", "2022-11-18");

COMMIT;
