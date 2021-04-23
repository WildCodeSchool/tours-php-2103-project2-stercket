<?php

namespace App\Controller;

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
        return $this->twig->render('Game/play.html.twig');
    }
}
