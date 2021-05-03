<?php

namespace App\Controller;

use App\Model\Stercket;
use App\Model\StercketManager;

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
        $stercketManager = new StercketManager();
        $collection = $stercketManager->selectAllAsObject();
        $stercketUser = new Stercket('player');
        $stercketEnnemy = new Stercket('wood');
        return $this->twig->render('Game/play.html.twig', [
            "stercketUser" => $stercketUser,
            "stercketEnnemy" => $stercketEnnemy,
            "collection" => $collection
        ]);
    }
}
