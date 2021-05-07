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

    public function play(string $action = "")
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
        if ($action === "battle" && isset($_POST["userStercket"]) && isset($_POST["woodStercket"])) {
            $userStercket = $stercketManager->selectOneByIdAsObject($_POST["userStercket"]);
            $woodStercket = $stercketManager->selectOneByIdAsObject($_POST["woodStercket"]);
            return $this->twig->render('Game/play.html.twig', [
                "action" => "battle",
                "stercketUser" => $userStercket,
                "stercketEnnemy" => $woodStercket,
                "collection" => $playerSterckets,
                "woodSterckets" => $woodSterckets
            ]);
        }
        return $this->twig->render('Game/play.html.twig', [
            "collection" => $playerSterckets,
            "woodSterckets" => $woodSterckets
        ]);
    }
}
