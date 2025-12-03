
CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       nom VARCHAR(100),
                       email VARCHAR(150) UNIQUE,
                       mdp VARCHAR(255)
);

CREATE TABLE wallet (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT,
                        solde INT DEFAULT 1000,
                        FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE articles (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          nom VARCHAR(100),
                          categorie VARCHAR(50) DEFAULT 'autre',
                          montant DECIMAL(10,2),
                          quantite INT,
                          description TEXT NULL,
                          date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE achats (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT NOT NULL,
                        article_id INT NOT NULL,
                        quantite INT DEFAULT 1,
                        date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (user_id) REFERENCES users(id),
                        FOREIGN KEY (article_id) REFERENCES articles(id)
);


INSERT INTO articles (nom, categorie, montant, quantite, description) VALUES
                                                                          ('Épée en bois', 'arme', 150, 10, 'Pour commencer doucement'),
                                                                          ('Potion de soin', 'potion', 50, 25, NULL),
                                                                          ('Bouclier basique', 'bouclier', 300, 5, 'Simple mais utile'),
                                                                          ('Casque de fer', 'armure', 200, 8, 'Protège bien la tête');
