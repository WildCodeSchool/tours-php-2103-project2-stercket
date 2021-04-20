<?php

namespace App\Model;

class StercketManager extends AbstractManager
{
    public const TABLE = 'stercket';

     /**
     * Insert new stercket in database
     */
    public function insert(Stercket $newStercket): void
    {
        $statement = $this->pdo->prepare("INSERT 
            INTO " . self::TABLE . " (`name`, `specie`, `type`, `attack`, `defense`, `health`, `owner`)
            VALUES (:name, :specie, :type, :attack, :defense, :health, :owner)");
        $statement->bindValue('name', $newStercket->getName(), \PDO::PARAM_STR);
        $statement->bindValue('specie', $newStercket->getSpecie(), \PDO::PARAM_STR);
        $statement->bindValue('type', $newStercket->getType(), \PDO::PARAM_STR);
        $statement->bindValue('attack', $newStercket->getAttack(), \PDO::PARAM_INT);
        $statement->bindValue('defense', $newStercket->getDefense(), \PDO::PARAM_INT);
        $statement->bindValue('health', $newStercket->getHealth(), \PDO::PARAM_INT);
        $statement->bindValue('owner', $newStercket->getOwner(), \PDO::PARAM_STR);
        $statement->execute();

        $statement = $this->pdo->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();
        $id = intval($statement->fetch()["LAST_INSERT_ID()"]);
        $newStercket->setId($id);
    }
}
