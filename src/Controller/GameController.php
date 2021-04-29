<?php

namespace App\Controller;

use App\Model\Stercket;

class GameController extends AbstractController
{
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
}
