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

        //just to begin with, changes will come
        $stercketUser = null;
        $stercketEnnemy = null;
        foreach ($collection as $stercket) {
            if ($stercket->getOwner() === 'player') {
                $stercketUser = $stercket;
            } elseif ($stercket->getOwner() === 'wood') {
                $stercketEnnemy = $stercket;
            }
        }
        return $this->twig->render('Game/play.html.twig', [
            "stercketUser" => $stercketUser,
            "stercketEnnemy" => $stercketEnnemy
        ]);
    }
}
