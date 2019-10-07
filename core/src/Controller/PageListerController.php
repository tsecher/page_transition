<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageListerController extends AbstractController
{
    /**
     * @Route("/", name="page_lister")
     */
    public function index()
    {
        return $this->render('page_lister/index.html.twig', [
            'controller_name' => 'PageListerController',
            'pages' => $this->getPages(),
        ]);
    }

    protected function getPages(){
        $rootPath = __DIR__.'/../../../pages/';
        $files = glob($rootPath.'*');

        return $files;
    }
}
