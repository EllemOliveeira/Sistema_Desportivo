CREATE DATABASE trabalho_db;
USE trabalho_db;

CREATE TABLE Tecnico (
    idTecnico INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR (255) NOT NULL,
    senha VARCHAR (255) NOT NULL
);

CREATE TABLE Equipe (
    idEquipe INT PRIMARY KEY AUTO_INCREMENT,
    nomeEquipe VARCHAR(255) NOT NULL,
    idTecnico INT,
    FOREIGN KEY (idTecnico) REFERENCES Tecnico(idTecnico)
);

CREATE TABLE Atividade (
    idAtividade INT PRIMARY KEY AUTO_INCREMENT,
    nomeAtividade VARCHAR(255) NOT NULL,
    descricaoAtividade VARCHAR(255) NOT NULL ,
    idEquipe INT,
    FOREIGN KEY (idEquipe) REFERENCES Equipe(idEquipe)
);

DELIMITER //
Create procedure listarEquipe (in p_idTecnico int)
begin
Select * from equipe where idTecnico = p_idTecnico;
end;

// DELIMITER ;

DELIMITER //
CREATE PROCEDURE listarAtividades(IN idEquipe INT)
BEGIN
    SELECT atividade.idAtividade, atividade.descricaoAtividade, equipe.idEquipe
    FROM equipe
    INNER JOIN atividade ON atividade.idEquipe = equipe.idEquipe
    WHERE equipe.idEquipe = idEquipe;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE listarAtividadesEquipeEspecifica(IN idTecnico INT, IN idEquipe INT)
BEGIN
    SELECT atividade.idAtividade, atividade.nomeAtividade
    FROM equipe
    INNER JOIN atividade ON atividade.idEquipe = equipe.idEquipe
    WHERE equipe.idTecnico = idTecnico AND equipe.idEquipe = idEquipe;
END //
DELIMITER ;


INSERT INTO Tecnico (nome, email, senha) VALUES
    ('Leticia Nogueira', 'let.nog_@hotmail.com', '123456'),
    ('Daiane Santana', 'dai.sant_@hotmail.com', '123456'),
    ('Gabriel Silva', 'biel.silva_@hotmail.com','123456'), 
    ('Ellem Oliveira', 'ellem.oliv_@hotmail.com','123456')
    ;
    drop database trabalho_db;