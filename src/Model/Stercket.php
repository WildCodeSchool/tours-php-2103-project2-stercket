<?php

namespace App\Model;

class Stercket
{
    private static $collection = [];
    private int $id;
    private string $name;
    private string $specie;
    private string $type;
    private int $attack;
    private int $defense;
    private int $health = 30;
    private string $owner;

    /*
     * Initialise the stercket datas with the args and random attack and defense
     */
    public function initialisation(string $name, string $specie, string $type, string $owner)
    {
        $this->name = $name;
        $this->specie = $specie;
        $this->type = $type;
        $this->owner = $owner;
        $this->attack = $this->nrand(5, 0.5);
        $this->defense = $this->nrand(2, 0.5);
    }

    //Getters and setters
    public static function getCollection()
    {
        return self::$collection;
    }

    public static function setCollection(array $newCollection)
    {
        self::$collection = $newCollection;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Stercket
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Stercket
    {
        $this->name = $name;
        return $this;
    }

    public function getSpecie(): string
    {
        return $this->specie;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): Stercket
    {
        $this->owner = $owner;
        return $this;
    }

    public function getAttack(): int
    {
        return $this->attack;
    }

    public function getDefense(): int
    {
        return $this->defense;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setHealth(int $health): Stercket
    {
        if ($health < 0) {
            $this->health = 0;
        } else {
            $this->health = $health;
        }
        return $this;
    }

    //function for a shot
    public function fight(Stercket $opponent): void
    {
        $damage = $this->attack - $opponent->getDefense();
        if ($damage < 0) {
            $damage = 0;
        }
        $opponent->setHealth($opponent->getHealth() - $damage);
    }

    //function who verify the health status to check if the sterket is alive or not
    public function isAlive(): bool
    {
        return $this->getHealth() > 0;
    }

    //function for entire combat
    public function combat(Stercket $forestStercket): array
    {
        $logs = [];
        while ($this->isAlive() && $forestStercket->isAlive()) {
            $this->fight($forestStercket);
            $forestStercket->fight($this);
            $logs[] = "Your stercket have now " . $this->getHealth() . " health points";
            $logs[] = "Enemie's stercket have now " . $forestStercket->getHealth() . " health points";
        }
        return $logs;
    }

    //function to generate random normal number
    private function nrand($mean, $standardDeviation): int
    {
        $xValue = mt_rand() / mt_getrandmax();
        $yValue = mt_rand() / mt_getrandmax();
        $number = sqrt(-2 * log($xValue)) * cos(2 * pi() * $yValue) * $standardDeviation + $mean;
        return intval($number);
    }

    //function that add the stercket in the collection
    public function addToCollection()
    {
        if ($this->id) {
            if (!self::searchStercketById($this->id)) {
                self::$collection[] = $this;
            }
        }
    }

    //function that search a stercket in the collection by id
    public static function searchStercketById(int $id)
    {
        foreach (self::$collection as $index => $stercket) {
            if ($stercket->id === $id) {
                return $index;
            }
        }
        return false;
    }
}
