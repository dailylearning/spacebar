<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
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
        $comments = [
            'Hello, Juyal! You have 10 unread messages',
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'Ab deserunt distinctio dolore dolorem facilis fugiat minima nemo nihil, nostrum.',
            'Ipsam perspiciatis recusandae sapiente sequi voluptatem? At cum distinctio quam vero.'
        ];

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments
        ]);
    }
}
