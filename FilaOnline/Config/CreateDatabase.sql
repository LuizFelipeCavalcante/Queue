create database app_fila;

use app_fila;

create table conta (
    id INT AUTO_INCREMENT not null  PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone varchar(15) NOT NULL,
    senha VARCHAR(40) NOT NULL,
    foto text not null
);

create table users(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    numeroFila VARCHAR(10),
    tempoEspera float 
);
create table estabelecimento(
    id INT AUTO_INCREMENT not null PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cnpj INT NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    descricao VARCHAR(100) NOT NULL,
    logo VARCHAR(100) NOT NULL,
    senha VARCHAR(40) NOT NULL
);

create table funcionario(
    id INT AUTO_INCREMENT not null  PRIMARY KEY,
    idEstabelecimento INT not null,
    cargo varchar(20) not null,
    name VARCHAR(60) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone INT NOT NULL,
	FOREIGN KEY (idEstabelecimento) REFERENCES estabelecimento(id)
);

create table fila(
    id INT AUTO_INCREMENT not null PRIMARY KEY,
    idEstabelecimento INT not null,
    nome text not null,
    tempoMedio FLOAT NULL,
    qntPessoasFila INT  NULL,
    endereco text NOT NULL,
    img text NOT NULL,
    inicio time,
    termino time,
     FOREIGN KEY (idEstabelecimento) REFERENCES estabelcimento(id)
);

CREATE TABLE fila_usuario (
    idFila INT NOT NULL,
    idUsuario INT NOT NULL,
    PRIMARY KEY (idFila, idUsuario),
    FOREIGN KEY (idFila) REFERENCES fila(id),
    FOREIGN KEY (idUsuario) REFERENCES users(id)
);