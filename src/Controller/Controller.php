<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {


        return $this->render('/index.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }
}
