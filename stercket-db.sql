--
-- Structure de la table `stercket`
--

CREATE TABLE `stercket` (
    `id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `specie` VARCHAR(100) NOT NULL,
    `type` VARCHAR(100) NOT NULL,
    `attack` INT UNSIGNED NOT NULL,
    `defense` INT UNSIGNED NOT NULL,
    `health` INT UNSIGNED NOT NULL,
    `owner` VARCHAR(100) NOT NULL
);
