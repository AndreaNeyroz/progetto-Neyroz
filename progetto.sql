DROP DATABASE IF EXISTS recruiting_db;
CREATE DATABASE recruiting_db;
USE recruiting_db;

CREATE TABLE Candidati (
    codF VARCHAR(16) PRIMARY KEY,
    link_CV VARCHAR(200) NOT NULL,
	nome VARCHAR (20) NOT NULL,
	cognome VARCHAR (20) NOT NULL,
	dataNascita DATE NOT NULL,
	genere ENUM ("m","f"),
    esperienze TEXT
);

CREATE TABLE Candidature (
    stato ENUM ("inviati","in_revisione","colloquio","accettata") DEFAULT NULL,
	codCand INT PRIMARY KEY AUTO_INCREMENT,
    codF VARCHAR(16) NOT NULL,
    codAnl VARCHAR(16) NOT NULL,
    dataCandidatura DATE NOT NULL,
    FOREIGN KEY (codF) REFERENCES Candidati(codF)
        ON DELETE CASCADE
		ON UPDATE CASCADE
	
	
	
);

CREATE TABLE Categorie_Competenze (
    codCat INT PRIMARY KEY AUTO_INCREMENT,
    nomeCat VARCHAR(200) NOT NULL UNIQUE
);

CREATE TABLE Competenze (
    codCr INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    codCat INT NOT NULL,
    FOREIGN KEY (codCat) REFERENCES Categorie_Competenze(codCat)
        ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE Aziende (
    codA INT PRIMARY KEY AUTO_INCREMENT,
    ragioneSociale VARCHAR(150) NOT NULL,
    ind_via VARCHAR(100),
    ind_civ INT,
    ind_citta VARCHAR(100),
    email VARCHAR(150)
);

CREATE TABLE Settori (
    codSett INT PRIMARY KEY AUTO_INCREMENT,
    nomeSettore VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Contratti (
    codC INT PRIMARY KEY AUTO_INCREMENT,
    gFerie INT UNSIGNED,
    nOre_settimanali INT UNSIGNED,
    nomeContratto VARCHAR(100) NOT NULL
);

CREATE TABLE Annunci_lavoro (
    codAnl VARCHAR(10) PRIMARY KEY,
    Ral VARCHAR(50),
    requisiti TEXT,
    descrizione TEXT,
    durataContratto INT,
    codA INT NOT NULL,
    codSett INT NOT NULL,
    codC INT NOT NULL,
    FOREIGN KEY (codA) REFERENCES Aziende(codA)
	    ON DELETE CASCADE
		ON UPDATE CASCADE,
    FOREIGN KEY (codSett) REFERENCES Settori(codSett)
	    ON DELETE CASCADE
		ON UPDATE CASCADE,
    FOREIGN KEY (codC) REFERENCES Contratti(codC)
	    ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE Colloqui (
    codQ INT PRIMARY KEY AUTO_INCREMENT,
    codCand INT NOT NULL,
    esito BOOLEAN,
    FOREIGN KEY (codCand) REFERENCES Candidature(codCand)
        ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE Messaggio (
    codM INT PRIMARY KEY AUTO_INCREMENT,
    codQ INT NOT NULL,
    contenuto TEXT NOT NULL,
    dataOra_invio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    utente BOOLEAN NOT NULL,
    FOREIGN KEY (codQ) REFERENCES Colloqui(codQ)
        ON DELETE CASCADE
		ON UPDATE CASCADE
);