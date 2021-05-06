<?php

namespace App\Controller;

use App\Model\Stercket;
use App\Model\StercketManager;

class GameController extends AbstractController
{
    private StercketManager $manager;

    public function __construct()
    {
        parent::__construct();
        $this->manager = new StercketManager();
    }

    /**
     * Display game page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function play()
    {
        $stercketUser = new Stercket();
        $stercketEnnemy = new Stercket();
        $stercketUser->initialise('player');
        $stercketEnnemy->initialise('wood');
        return $this->twig->render('Game/play.html.twig', [
            "stercketUser" => $stercketUser,
            "stercketEnnemy" => $stercketEnnemy,
        ]);
    }

    public function attack(int $id): string
    {
        $attacker = $this->manager->selectOneByIdAdObject($id);
        if (null === $attacker || $attacker->getOwner() !== Stercket::OWNERS[1]) {
            // This should never happens : attack from a non existing stercket or from a stercket not from the player
            header("Location: /");
            return "";
        }
        $target = $this->manager->selectRandomFromWood();
        $attacker->combat($target);
        // $log = $attacker->combat($target);
        if (!$target->isAlive()) {
            $target->setOwner(Stercket::OWNERS[1]);
        }
        $this->manager->update($target);
        $this->manager->update($attacker);

        // Redirect to the game state page
        header("Location: /");
        return "";
        // Or display the fight result
        /*
        return $this->twig->render("Game/battle.html.twig", [
            "stercketUser" => $attacker,
            "stercketEnnemy" => $target,
            'log' => $log
            ]);
        */
    }
}
