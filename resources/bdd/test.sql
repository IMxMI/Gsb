CREATE TABLE IF NOT EXISTS login (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  login CHAR(20) DEFAULT NULL,
  mdp CHAR(20) DEFAULT NULL
) ENGINE=InnoDB;
 
INSERT INTO login (login, mdp)
SELECT login, mdp
FROM visiteur;

ALTER TABLE visiteur
ADD idlogin int;

ALTER TABLE visiteur
ADD FOREIGN KEY FK_visiteur_login (idlogin) REFERENCES login (id);

UPDATE visiteur v
JOIN login l ON v.mdp = l.mdp
SET v.idlogin = l.id;

select * from visiteur;

ALTER TABLE login
ADD metier char(2) DEFAULT 'VI' NOT NULL;

CREATE TABLE IF NOT EXISTS comptable (
  id char(5) PRIMARY KEY NOT NULL,
  nom char(30) DEFAULT NULL,
  prenom char(30)  DEFAULT NULL,
  ville char(30) DEFAULT NULL,
  dateembauche date DEFAULT NULL,
  idlogin int not null
) ENGINE=InnoDB;

ALTER TABLE comptable
ADD FOREIGN KEY FK_comptable_login (idlogin) REFERENCES login (id);

INSERT INTO login(login, mdp, metier) values('testcompta', 'test', 'CO');
INSERT INTO comptable(id, nom, prenom, ville, idlogin) values('t321c','TestNom','TestPrenom','ToulonTest','1024');

ALTER TABLE login
MODIFY mdp CHAR(64);

UPDATE login
	SET mdp = sha2(mdp,256);
    
ALTER TABLE visiteur
DROP mdp;

ALTER TABLE visiteur
DROP login;