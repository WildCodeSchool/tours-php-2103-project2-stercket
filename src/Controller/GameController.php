<?php

namespace App\Controller;

use App\Model\Stercket;
use App\Model\StercketManager;

use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

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
