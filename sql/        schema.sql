
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
                          montant INT,
                          quantite INT,
                          description TEXT NULL
);

INSERT INTO articles (nom, montant, quantite, description) VALUES
                                                               ('Épée en bois', 150, 10, 'Pour commencer doucement'),
                                                               ('Potion de soin', 50, 25, NULL),
                                                               ('Bouclier basique', 300, 5, 'Simple mais utile');
