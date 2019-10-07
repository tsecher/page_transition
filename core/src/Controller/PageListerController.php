<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PageListerController extends AbstractController
{
    const QUERY_FIELD = 'p';

    /**
     * @Route("/", name="page_lister")
     */
    public function index(Request $request)
    {
        return $this->render('page_lister/index.html.twig', [
            'query_field' => static::QUERY_FIELD,
            'content' => $this->getPageContent($request->query->get(static::QUERY_FIELD)),
            'pages' => $this->getPages(),
        ]);
    }

    /**
     * Get the available pages.
     * 
     * @return array
     */
    protected function getPages()
    {
        $files = glob($this->getPagesRepoPath() . '*');

        return array_map(
            function ($item) {
                return basename($item);
            },
            $files);
    }

    /**
     * Get the content according to the queried page.
     */
    protected function getPageContent($page){
        $pagePath = $this->getPagesRepoPath().$page;
        if( file_exists($pagePath) && !is_dir($pagePath) ){
            return file_get_contents( $pagePath );    
        }
        return '';
    }

    /**
     * Get the page repo path.
     */
    protected function getPagesRepoPath(){
        return __DIR__ . '/../../../pages/';
    }
}
