<?php
namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * @return Response
     */
    public function homepage()
    {
        return $this->render('article/home.html.twig');
    }

    /**
     * @Route("/news/{slug}", name="app_article_show")
     * @return Response
     */
    public function show($slug, Environment $twig)
    {
        $comments = [
            'Hello, Juyal! You have 10 unread messages',
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'Ab deserunt distinctio dolore dolorem facilis fugiat minima nemo nihil, nostrum.',
            'Ipsam perspiciatis recusandae sapiente sequi voluptatem? At cum distinctio quam vero.'
        ];

        $html = $twig->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'comments' => $comments
        ]);

        return new Response($html);
    }

    /**
     * @Route("news/{slug}/heart", name="app_article_toggle_heart", methods={"POST"})
     * @return Response
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        //TODO: actually heart / unheart the article!

        $logger->info('Article is being hearted!');

        return new JsonResponse(['hearts'=>rand(5,100)]);
    }
}
