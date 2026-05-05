SET NAMES 'utf8mb4';
SET CHARACTER SET utf8mb4;

CREATE DATABASE foodswipe CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE foodswipe;

CREATE TABLE users (
    id_users INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE plats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    emoji VARCHAR(10),
    image VARCHAR(255),
    id_category INT, 
    time INT,
    calorie INT,
    rating INT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_category FOREIGN KEY (id_category) REFERENCES categories(id) ON DELETE SET NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO categories (id, nom) VALUES
(1, 'Japonais'), (2, 'Italien'), (3, 'Mexicain'), (4, 'Thaïlandais'),
(5, 'Américain'), (6, 'Oriental'), (7, 'Français'), (8, 'Indien'),
(9, 'Hawaïen'), (10, 'Maghrébin'), (11, 'Dessert');

SET NAMES utf8mb4;
INSERT INTO plats (id, nom, emoji, image, id_category, time, calorie, rating, description) VALUES
(1, 'Ramen Tonkotsu', '🍜', 'ramen.jpg', 1, 45, 620, 5, 'Bouillon de porc riche, nouilles fraîches, œuf mollet et chashu.'),
(2, 'Pizza Margherita', '🍕', 'pizza.jpg', 2, 30, 540, 5, 'Tomate San Marzano, mozzarella di bufala, basilic frais.'),
(3, 'Tacos al Pastor', '🌮', 'tacos.jpg', 3, 20, 480, 5, 'Porc mariné aux épices, ananas, coriandre et salsa verde.'),
(4, 'Pad Thaï', '🍝', 'padthai.jpg', 4, 25, 550, 5, 'Nouilles de riz sautées, crevettes, cacahuètes et citron vert.'),
(5, 'Burger Smash', '🍔', 'burger.jpg', 5, 15, 750, 5, 'Double galette beurrée, cheddar fondu, pickles maison.'),
(6, 'Sushi Omakase', '🍣', 'sushi.jpg', 1, 60, 420, 5, 'Sélection du chef : thon, saumon, oursin et bar de ligne.'),
(7, 'Shakshuka', '🍳', 'shakshuka.jpg', 6, 20, 390, 4, 'Œufs pochés dans une sauce tomate épicée aux poivrons.'),
(8, 'Crêpe Suzette', '🥞', 'crepes.jpg', 7, 15, 310, 5, 'Crêpes au beurre d''agrumes flambées au Grand Marnier.'),
(9, 'Biryani d''agneau', '🍚', 'biryani.jpg', 8, 90, 680, 5, 'Riz basmati parfumé, agneau tendre, safran et raïta.'),
(10, 'Poke Bowl Saumon', '🥗', 'pokebowl.jpg', 9, 10, 490, 5, 'Riz sushi, saumon frais, avocat, edamame et sauce ponzu.'),
(11, 'Couscous Royal', '🍲', 'couscous.jpg', 10, 75, 720, 5, 'Semoule fine, merguez, poulet, légumes et bouillon parfumé.'),
(12, 'Tiramisu', '🍮', 'tiramisu.jpg', 11, 20, 380, 5, 'Mascarpone aérien, biscuits imbibés d''espresso et cacao.');