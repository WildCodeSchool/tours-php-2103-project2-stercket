<?php

namespace App\Model;

class Stercket
{
    private int $id;
    private string $name;
    private string $specie;
    private string $type;
    private int $attack;
    private int $defense;
    private int $health = 30;
    private string $owner;

    public function __construct(string $name, string $specie, string $type, string $owner)
    {
        $this->name = $name;
        $this->specie = $specie;
        $this->type = $type;
        $this->owner = $owner;
        $this->attack = $this->nrand(5, 0.5);
        $this->defense = $this->nrand(2, 0.5);
    }

    //Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
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
    //Setter for health
    public function setHealth(int $health): void
    {
        if ($health < 0) {
            $this->health = 0;
        } else {
            $this->health = $health;
        }
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

    private function nrand($mean, $standardDeviation): int
    {
        $xValue = mt_rand() / mt_getrandmax();
        $yValue = mt_rand() / mt_getrandmax();
        $number = sqrt(-2 * log($xValue)) * cos(2 * pi() * $yValue) * $standardDeviation + $mean;
        return intval($number);
    }
}