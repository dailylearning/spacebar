<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function homepage()
    {
        return new Response("This is symfony4 homepage!");
    }

    /**
     * @Route("/news/{slug}")
     * @return Response
     */
    public function show($slug)
    {
        return new Response(sprintf(
            "Future pages to show the article: %s",
            $slug
        ));
    }
}
