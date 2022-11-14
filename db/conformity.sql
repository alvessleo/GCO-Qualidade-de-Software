SET autocommit = 0;

START TRANSACTION;

DROP DATABASE IF EXISTS conformity;
CREATE DATABASE conformity;

USE conformity;

DROP USER IF EXISTS 'conformity_admin';
CREATE USER 'conformity_admin' IDENTIFIED BY '123';
GRANT ALL PRIVILEGES ON conformity.* TO 'conformity_admin'@'%';

-- Tabelas entidade
CREATE TABLE usuario
(
    codigo_usuario INT UNSIGNED AUTO_INCREMENT NOT NULL,
    nome VARCHAR(64) NOT NULL,
    usuario VARCHAR(64) NOT NULL UNIQUE,
    senha VARCHAR(256),

    PRIMARY KEY(codigo_usuario)
);

CREATE TABLE empresa
(
    codigo_empresa INT UNSIGNED AUTO_INCREMENT NOT NULL,
    codigo_criador INT UNSIGNED NOT NULL,
    nome VARCHAR(64) NOT NULL,

    FOREIGN KEY(codigo_criador) REFERENCES usuario(codigo_usuario),

    PRIMARY KEY(codigo_empresa)
);

CREATE TABLE artefato
(
    codigo_artefato INT UNSIGNED AUTO_INCREMENT NOT NULL,
    codigo_empresa INT UNSIGNED NOT NULL,
    nome_artefato VARCHAR(64) NOT NULL,
    recurso VARCHAR(256) NOT NULL,
    ultimaModificacao DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,

    FOREIGN KEY(codigo_empresa) REFERENCES empresa(codigo_empresa),

    PRIMARY KEY(codigo_artefato)   
);

CREATE TABLE checklist
(
    codigo_checklist INT UNSIGNED AUTO_INCREMENT NOT NULL,
    codigo_autor INT UNSIGNED NOT NULL,
    codigo_artefato INT UNSIGNED NOT NULL,
    nome VARCHAR(128) NOT NULL,
    
    FOREIGN KEY(codigo_autor) REFERENCES usuario(codigo_usuario),
    FOREIGN KEY(codigo_artefato) REFERENCES artefato(codigo_artefato),

    PRIMARY KEY(codigo_checklist)
);

CREATE TABLE estadoItemChecklist
(
    codigo_estadoItemChecklist INT UNSIGNED AUTO_INCREMENT NOT NULL,
    estado VARCHAR(64),
    descricao VARCHAR(128),
    
    PRIMARY KEY(codigo_estadoItemChecklist)
);

CREATE TABLE itemChecklist
(
    codigo_itemChecklist INT UNSIGNED AUTO_INCREMENT NOT NULL,
    codigo_checklist INT UNSIGNED NOT NULL,
    codigo_estado INT UNSIGNED NOT NULL,
    item VARCHAR(256) NOT NULL,
    comentario VARCHAR(1024) DEFAULT '',

    FOREIGN KEY(codigo_checklist) REFERENCES checklist(codigo_checklist),
    FOREIGN KEY(codigo_estado) REFERENCES estadoItemChecklist(codigo_estadoItemChecklist),

    PRIMARY KEY(codigo_itemChecklist)
);

CREATE TABLE itemNC
(
    codigo_itemNC INT UNSIGNED AUTO_INCREMENT NOT NULL,
    codigo_itemChecklist INT UNSIGNED NOT NULL,
    codigo_responsavel INT UNSIGNED NOT NULL,
    descricao VARCHAR(128) NOT NULL,
    sugestao VARCHAR(256),
    prazo DATETIME NOT NULL,

    FOREIGN KEY(codigo_itemChecklist) REFERENCES itemChecklist(codigo_itemChecklist),
    FOREIGN KEY(codigo_responsavel) REFERENCES usuario(codigo_usuario),

    PRIMARY KEY(codigo_itemNC)
);

-- Tabelas relacionais
CREATE TABLE usuario_empresa
(
    codigo_usuario INT UNSIGNED NOT NULL,
    codigo_empresa INT UNSIGNED NOT NULL,

    cargo VARCHAR(64) DEFAULT NULL,
    auditor BOOLEAN DEFAULT FALSE NOT NULL,

    FOREIGN KEY(codigo_usuario) REFERENCES usuario(codigo_usuario),
	FOREIGN KEY(codigo_empresa) REFERENCES empresa(codigo_empresa),
    
    PRIMARY KEY(codigo_usuario, codigo_empresa)
);

COMMIT;