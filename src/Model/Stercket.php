<?php

namespace App\Model;

class Stercket
{
    public const MAX_WOOD_SIZE = 3;
    public const SPECIES = [
        'mage' => ['firebill', 'frostblob'],
        'knight' =>  ['lightnight', 'darknight'],
        'archer' => ['furarchy', 'lazarcha'],
        'lancer' => ['waterlance', 'branchia'],
        'horseman' => ['ferida', 'godlir']
    ];
    public const TYPES = ['mage', 'knight', 'archer', 'lancer', 'horseman'];
    public const OWNERS = ['wood', 'player'];
    public const MAX_HEALT = 20;
    private int $id;
    private string $name;
    private string $specie;
    private string $type;
    private int $attack;
    private int $defense;
    private int $health = 20;
    private string $owner;
    private string $image;


    public function __construct(string $owner = "")
    {
        if ($owner != "") {
            $this->initialise($owner);
        }
        if (isset($this->specie)) {
            $this->image = "/assets/images/sterckets/" . $this->specie . ".png";
        }
    }
    /*
     * Initialise the stercket datas with the args and random attack and defense
     */
    public function initialise(string $owner)
    {
        if (in_array($owner, self::OWNERS)) {
            $this->type = self::TYPES[rand(0, 4)];
            $this->specie = self::SPECIES[$this->type][rand(0, 1)];
            $this->name = $this->specie;
            $this->owner = $owner;
            $this->attack = $this->nrand(5, 0.5);
            $this->defense = $this->nrand(2, 0.5);
        }
    }

    //Getters and setters
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

    public function getImage(): string
    {
        return $this->image;
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
    public function combat(Stercket $woodsStercket): array
    {
        $logs = [];
        while ($this->isAlive() && $woodsStercket->isAlive()) {
            $this->fight($woodsStercket);
            $woodsStercket->fight($this);
            $logs[] = $this->name . " have now " . $this->getHealth() . " health points";
            $logs[] = $woodsStercket->name . " have now " . $woodsStercket->getHealth() . " health points";
        }
        $this->capture($woodsStercket);
        return $logs;
    }

    private function nrand($mean, $standardDeviation): int
    {
        $xValue = mt_rand() / mt_getrandmax();
        $yValue = mt_rand() / mt_getrandmax();
        $number = sqrt(-2 * log($xValue)) * cos(2 * pi() * $yValue) * $standardDeviation + $mean;
        return intval($number);
    }

    public function capture(Stercket $stercketEnnemy)
    {
        if ($stercketEnnemy->getHealth() === 0) {
            $stercketEnnemy->setOwner(self::OWNERS[1]);
        }
    }
}
