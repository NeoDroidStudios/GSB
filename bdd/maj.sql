#--drop
ALTER TABLE visiteur
DROP CONSTRAINT fk_VISITEUR_to_LABO;

ALTER TABLE visiteur
DROP LAB_CODE;

DROP TABLE labo;

DROP TABLE switchboard;

#--add new

INSERT INTO praticien(PRA_NUM, PRA_NOM, PRA_PRENOM, TYP_CODE) VALUES (0, "Aucun", "Aucun", "PO");

ALTER TABLE rapport_visite
ADD COLUMN REMP_NUM INT NOT NULL DEFAULT 0;

ALTER TABLE rapport_visite
ADD CONSTRAINT fk_remplacent FOREIGN KEY (REMP_NUM) REFERENCES praticien(PRA_NUM);

#--presenter
CREATE TABLE PRESENTER (
  `VIS_MATRICULE` VARCHAR(10) NOT NULL, 
  `RAP_NUM` INT NOT NULL, 
  `MED_DEPOTLEGAL` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`VIS_MATRICULE`, `RAP_NUM`, `MED_DEPOTLEGAL`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

ALTER TABLE PRESENTER ADD CONSTRAINT `fk_PRESENTER_to_MEDICAMENT` FOREIGN KEY (`MED_DEPOTLEGAL` ) REFERENCES `MEDICAMENT`(`MED_DEPOTLEGAL` );
ALTER TABLE PRESENTER ADD CONSTRAINT `fk_PRESENTER_to_RAPPORT_VISITE` FOREIGN KEY (`VIS_MATRICULE` ,`RAP_NUM` ) REFERENCES `RAPPORT_VISITE`(`VIS_MATRICULE` ,`RAP_NUM` );

#--
CREATE TABLE ETAT_RAPPORT (
  ETAT_ID CHAR(1) NOT NULL,
  ETAT_LIB VARCHAR(60) NOT NULL,
  PRIMARY KEY (ETAT_ID)
) ENGINE=innodb DEFAULT CHARSET=utf8;

CREATE TABLE MOTIF_VISITE (
  MOT_ID CHAR(3) NOT NULL,
  MOT_LIB VARCHAR(60) NOT NULL,
  PRIMARY KEY (MOT_ID)
) ENGINE=innodb DEFAULT CHARSET=utf8;


INSERT INTO ETAT_RAPPORT(ETAT_ID, ETAT_LIB) VALUES
('V', 'Rapport Validé'),
('C', 'En cours de saisie'),
('D', 'Consulté par le délégué');

INSERT INTO MOTIF_VISITE(MOT_ID, MOT_LIB) VALUES
('OTH', 'Autre'),
('PER', 'Périodicité'),
('NVT', 'Nouveauté'),
('ACT', 'Actualité'),
('REM', 'Remontage'),
('SOL', 'Solicitation');



ALTER TABLE rapport_visite
ADD COLUMN MOT_ID CHAR(3) NOT NULL DEFAULT 'OTH';

ALTER TABLE rapport_visite
ADD COLUMN ETAT_ID CHAR(1) NOT NULL DEFAULT 'V';


ALTER TABLE RAPPORT_VISITE ADD CONSTRAINT `fk_RAP_to_MOT` FOREIGN KEY (MOT_ID) 
REFERENCES MOTIF_VISITE(MOT_ID);

ALTER TABLE RAPPORT_VISITE ADD CONSTRAINT `fk_RAP_to_ETAT` FOREIGN KEY (ETAT_ID) 
REFERENCES ETAT_RAPPORT(ETAT_ID);

#--
RENAME TABLE visiteur TO collaborateur;