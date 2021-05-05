<?php

namespace App\Model;

class StercketManager extends AbstractManager
{
    public const TABLE = 'stercket';

    /**
     * Insert a new stercket in database
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

    /**
     * Update all fields except id of a stercket in the database
     */
    public function updateAllFields(Stercket $stercket): void
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . "
            SET `name`=:name,
            `specie`=:specie,
            `type`=:type,
            `attack`=:attack,
            `defense`=:defense,
            `health`=:health,
            `owner`=:owner
            WHERE `id`=:id;");
        $statement->bindValue('name', $stercket->getName(), \PDO::PARAM_STR);
        $statement->bindValue('specie', $stercket->getSpecie(), \PDO::PARAM_STR);
        $statement->bindValue('type', $stercket->getType(), \PDO::PARAM_STR);
        $statement->bindValue('attack', $stercket->getAttack(), \PDO::PARAM_INT);
        $statement->bindValue('defense', $stercket->getDefense(), \PDO::PARAM_INT);
        $statement->bindValue('health', $stercket->getHealth(), \PDO::PARAM_INT);
        $statement->bindValue('owner', $stercket->getOwner(), \PDO::PARAM_STR);
        $statement->bindValue('id', $stercket->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * Update name, health and owner fields of a stercket in the database
     */
    public function update(Stercket $stercket): void
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . "
            SET `name`=:name,
            `health`=:health,
            `owner`=:owner
            WHERE `id`=:id;");
        $statement->bindValue('name', $stercket->getName(), \PDO::PARAM_STR);
        $statement->bindValue('health', $stercket->getHealth(), \PDO::PARAM_INT);
        $statement->bindValue('owner', $stercket->getOwner(), \PDO::PARAM_STR);
        $statement->bindValue('id', $stercket->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * Get all row from database as stercket object.
     */
    public function selectAllAsObject(string $orderBy = '', string $direction = 'ASC'): array
    {
        $collection = [];
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        $statement = $this->pdo->query($query);
        while ($stercket = $statement->fetchObject('\App\Model\Stercket')) {
            $collection[] = $stercket;
        }
        return $collection;
    }

    public function deleteAllSterckets(): void
    {
        $query = 'TRUNCATE TABLE ' . static::TABLE;
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }
}
