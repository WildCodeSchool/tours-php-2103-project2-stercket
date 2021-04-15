--
-- Drop old `strecket` table to import the new one
--

DROP Table IF EXISTS stercket;

--
-- Structure de la table `stercket`
--

CREATE TABLE `stercket` (
    `id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `specie` ENUM('firebill', 'frostblob',
        'lightnight', 'darknight',
        'furarchy', 'lazarcha',
        'waterlance', 'branchia',
        'ferida', 'godlir') NOT NULL,
    `type` ENUM('mage', 'knight', 'archer', 'lancer', 'horseman') NOT NULL,
    `attack` INT UNSIGNED NOT NULL,
    `defense` INT UNSIGNED NOT NULL,
    `health` INT UNSIGNED NOT NULL,
    `owner` ENUM('wood', 'player') NOT NULL
);