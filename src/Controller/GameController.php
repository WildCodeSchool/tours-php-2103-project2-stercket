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
        $playerSterckets = [];
        $woodSterckets = [];
        foreach ($collection as $stercket) {
            if ($stercket->getOwner() == "player") {
                $playerSterckets[] = $stercket;
            } else {
                $woodSterckets[] = $stercket;
            }
        }
        return $this->twig->render('Game/play.html.twig', [
            "stercketUser" => $playerSterckets[0],
            "stercketEnnemy" => $woodSterckets[0],
            "collection" => $playerSterckets,
            "woodSterckets" => $woodSterckets
        ]);
    }




    //heal stercket
    public function rest()
    {
        $stercket = new Stercket();
        $stercketManager = new StercketManager();

        $stercket->setHealth(Stercket::MAX_HEALT);
        $stercketManager->updateHP($stercket);

        header("Location: /Game/play");
    }
}
