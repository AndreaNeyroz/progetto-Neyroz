DROP DATABASE IF EXISTS recruiting_db;
CREATE DATABASE recruiting_db;
USE recruiting_db;

CREATE TABLE utenti(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(128) NOT NULL,
    cognome VARCHAR(128) NOT NULL,
    username VARCHAR(32) NOT NULL UNIQUE,
    email VARCHAR(30) NOT NULL UNIQUE,
    password CHAR(64) NOT NULL,
    salt CHAR(64) NOT NULL
);

CREATE TABLE Candidati (
    codF VARCHAR(16) NOT NULL PRIMARY KEY,
    link_CV VARCHAR(50) NOT NULL,
	nome VARCHAR (20) NOT NULL,
	cognome VARCHAR (20) NOT NULL,
	dataNascita DATE NOT NULL,
	genere ENUM ("m","f"),
    esperienze TEXT,
	numeroTelefono VARCHAR(11) NULL,
	email VARCHAR(30) NOT NULL,
	FkidUtenti INT NOT NULL,
	FOREIGN KEY(FkidUtenti) REFERENCES utenti(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE

);

CREATE TABLE Candidature (
    stato ENUM ("inviata","in_revisione","colloquio","accettata") DEFAULT "inviata",
	codCand INT(2) UNSIGNED ZEROFILL PRIMARY KEY NOT NULL AUTO_INCREMENT,
    codAnl INT(5) UNSIGNED ZEROFILL NOT NULL,
    dataCandidatura TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	FKcodF VARCHAR(16) NOT NULL,
    FOREIGN KEY (FKcodF) REFERENCES Candidati(codF)
        ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE Categorie_Competenze (
    codCat INT(2) UNSIGNED ZEROFILL PRIMARY KEY AUTO_INCREMENT,
    nomeCat VARCHAR(20) NOT NULL UNIQUE
);

CREATE TABLE Competenze (
    codCr INT(2) UNSIGNED ZEROFILL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(20) NOT NULL,
    FKcodCat INT UNSIGNED ZEROFILL NOT NULL,
    FOREIGN KEY (FKcodCat) REFERENCES Categorie_Competenze(codCat)
        ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE Aziende (
    codA INT(2) UNSIGNED ZEROFILL NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nomeAzienda VARCHAR (25) NOT NULL,
	ragioneSociale VARCHAR(30) NOT NULL,
    ind_via VARCHAR(20) NOT NULL,
    ind_civ VARCHAR(15) NOT NULL,
    ind_citta VARCHAR(20) NOT NULL,
    email VARCHAR(30) NOT NULL,
	cap INT (5) UNSIGNED ZEROFILL NOT NULL,
	FkidUtenti INT NOT NULL,
	FOREIGN KEY(FkidUtenti) REFERENCES utenti(id)
	ON DELETE CASCADE
	ON UPDATE CASCADE

);

CREATE TABLE Settori (
    codSett INT(2) UNSIGNED ZEROFILL PRIMARY KEY AUTO_INCREMENT,
    nomeSettore VARCHAR(20) NOT NULL UNIQUE
);

CREATE TABLE Contratti (
    codC INT(3) UNSIGNED ZEROFILL PRIMARY KEY AUTO_INCREMENT,
    gFerie INT UNSIGNED,
    nOre_settimanali INT(2) UNSIGNED ZEROFILL,
    nomeContratto VARCHAR(20) NOT NULL
);

CREATE TABLE Annunci_lavoro (
    codAnl INT(5) PRIMARY KEY,
    titolo VARCHAR (30) NOT NULL,
    requisiti TEXT,
    descrizione TEXT,
	durataContrattoGiorni INT(3),
    Ral int(6) UNSIGNED NOT NULL,
	FKcodA INT(2) UNSIGNED ZEROFILL NOT NULL,
    FKcodSett INT(2) UNSIGNED ZEROFILL NOT NULL,
    FKcodC INT(3) UNSIGNED ZEROFILL NOT NULL,
    FOREIGN KEY (FKcodA) REFERENCES Aziende(codA)
	    ON DELETE CASCADE
		ON UPDATE CASCADE,
    FOREIGN KEY (FKcodSett) REFERENCES Settori(codSett)
	    ON DELETE CASCADE
		ON UPDATE CASCADE,
    FOREIGN KEY (FKcodC) REFERENCES Contratti(codC)
	    ON DELETE RESTRICT
		ON UPDATE CASCADE 
);

CREATE TABLE Colloqui (
    codQ INT(2) UNSIGNED ZEROFILL PRIMARY KEY AUTO_INCREMENT,
    FKcodCand INT(2) UNSIGNED ZEROFILL NOT NULL,
    esito BOOLEAN,
	dataColloquio DATETIME,
    FOREIGN KEY (FKcodCand) REFERENCES Candidature(codCand)
        ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE Messaggio (
    codM INT(2) UNSIGNED ZEROFILL NOT NULL PRIMARY KEY AUTO_INCREMENT,
    FKcodQ INT(2) UNSIGNED ZEROFILL NOT NULL,
    contenuto TEXT NOT NULL,
    dataOra_invio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    utente BOOLEAN NOT NULL,
    FOREIGN KEY (FKcodQ) REFERENCES Colloqui(codQ)
        ON DELETE CASCADE
		ON UPDATE CASCADE
);

INSERT INTO utenti (nome, cognome, username, email, password, salt) VALUES
-- Utenti per Aziende
('Marco', 'Rossi', 'tech_hub_admin', 'admin@techhub.it', 'hash_pwd_1', 'salt_1'),
('Laura', 'Bianchi', 'green_energy_hr', 'hr@greenenergy.com', 'hash_pwd_2', 'salt_2'),
('Giuseppe', 'Verdi', 'food_logistics', 'info@foodlog.it', 'hash_pwd_3', 'salt_3'),
('Elena', 'Neri', 'fashion_style', 'recruitment@fashionstyle.com', 'hash_pwd_4', 'salt_4'),
('Roberto', 'Bruni', 'auto_parts_ceo', 'direzione@autoparts.it', 'hash_pwd_5', 'salt_5'),
-- Utenti per Candidati
('Luca', 'Ferrari', 'luca_f', 'luca.ferrari@email.it', 'pwd_c1', 's_c1'),
('Sara', 'Gallo', 'sara_g', 'sara.gallo@email.it', 'pwd_c2', 's_c2'),
('Matteo', 'Rizzo', 'matteo_r', 'm.rizzo@email.it', 'pwd_c3', 's_c3'),
('Anna', 'Vitali', 'anna_v', 'a.vitali@email.it', 'pwd_c4', 's_c4'),
('Paolo', 'Mani', 'paolo_m', 'p.mani@email.it', 'pwd_c5', 's_c5'),
('Giulia', 'Serra', 'giulia_s', 'g.serra@email.it', 'pwd_c6', 's_c6'),
('Federico', 'Riva', 'fede_riva', 'f.riva@email.it', 'pwd_c7', 's_c7'),
('Marta', 'Costa', 'marta_c', 'm.costa@email.it', 'pwd_c8', 's_c8'),
('Davide', 'Longo', 'davide_l', 'd.longo@email.it', 'pwd_c9', 's_c9'),
('Chiara', 'Gatti', 'chiara_g', 'c.gatti@email.it', 'pwd_c10', 's_c10');

INSERT INTO Aziende (nomeAzienda, ragioneSociale, ind_via, ind_civ, ind_citta, email, cap, FkidUtenti) VALUES
('Tech Hub', 'Tech Hub S.r.l.', 'Via Roma', '10', 'Milano', 'contact@techhub.it', 20100, 1),
('Green Energy', 'Green Energy S.p.A.', 'Corso Sole', '45', 'Torino', 'job@greenenergy.com', 10100, 2),
('Food Logistics', 'Food Logistics S.r.l.', 'Via del Grano', '102', 'Bologna', 'hr@foodlog.it', 40100, 3),
('Fashion Style', 'Fashion Style Group', 'Via della Moda', '5', 'Firenze', 'work@fashionstyle.com', 50100, 4),
('Auto Parts', 'Auto Parts Italia', 'Viale Motori', '22', 'Modena', 'info@autoparts.it', 41100, 5);