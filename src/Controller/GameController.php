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
        if ($action === "battle" && isset($_POST["userStercket"]) && isset($_POST["woodStercket"])) {
            $userStercket = $stercketManager->selectOneByIdAsObject($_POST["userStercket"]);
            $woodStercket = $stercketManager->selectOneByIdAsObject($_POST["woodStercket"]);
            $logs = $userStercket->combat($woodStercket);
            $stercketManager->update($userStercket);
            $stercketManager->update($woodStercket);
            $this->twig->addGlobal("action", "battle");
            $this->twig->addGlobal("stercketUser", $userStercket);
            $this->twig->addGlobal("stercketEnnemy", $woodStercket);
            $this->twig->addGlobal("logs", $logs);
        }
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
        for (
            $nbWoodStercket = count($woodSterckets);
            $nbWoodStercket < Stercket::MAX_WOOD_SIZE;
            $nbWoodStercket++
        ) {
            $woodStercket = new Stercket();
            $woodStercket->initialise('wood');
            $stercketManager->insert($woodStercket);
            $woodSterckets[] = $stercketManager->selectOneByIdAsObject($woodStercket->getId());
        }
        return $this->twig->render('Game/play.html.twig', [
            "collection" => $playerSterckets,
            "woodSterckets" => $woodSterckets
        ]);
    }




     //heal stercket
    public function rest()
    {
        $stercketManager = new StercketManager();
        $stercketManager->updateHP();

        header("Location: /Game/play");
    }
}
