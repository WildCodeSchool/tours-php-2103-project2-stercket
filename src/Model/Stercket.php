<?php

namespace App\Model;

class Stercket
{
    private int $id = 0;
    private string $name = "KoKo";
    private string $specie = "Grosse Vanne";
    private string $type = "Connerie";
    private int $attack = 13;
    private int $defense = 6;
    private int $health = 30;
    private string $owner = "Amanel";

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
    public function setHealth($health): void
    {
        if ($health < 0) {
            $health = 0;
        }
        $this->health = $health;
    }
    //function for a shot
    public function fight(Stercket $opponent): void
    {
        $damage = rand(1, $this->attack) - $opponent->getDefense();
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
    public function combat(Stercket $userStercket, Stercket $forestStercket): array
    {
        $logs = [];
        while ($userStercket->isAlive() && $forestStercket->isAlive()) {
            $userStercket->fight($forestStercket);
            $forestStercket->fight($userStercket);
            $logs[] = "Stercket 1 have now " . $userStercket->getHealth() . " health points";
            $logs[] = "Stercket 2 have now " . $forestStercket->getHealth() . " health points";
        }
        return $logs;
    }
}
