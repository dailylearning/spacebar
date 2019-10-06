<?php
namespace App\Controller;

use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
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
    public function show($slug, Environment $twig, MarkdownInterface $markdown, AdapterInterface $cache)
    {
        dump($markdown);
        die;
        $comments = [
            'Hello, Juyal! You have 10 unread messages',
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'Ab deserunt distinctio dolore dolorem facilis fugiat minima nemo nihil, nostrum.',
            'Ipsam perspiciatis recusandae sapiente sequi voluptatem? At cum distinctio quam vero.'
        ];

        $articleContent = <<<EOF
Spicy **jalapeno bacon ipsum dolor** amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident beef ribs aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
turkey shank eu pork belly meatball non cupim.

Laboris beef ribs fatback [fugiat eiusmod](http://phpfarmer.com) jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.

Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat.

Sausage tenderloin officia jerky nostrud. Laborum elit pastrami non, pig kevin buffalo minim ex quis. Pork belly
pork chop officia anim. Irure tempor leberkas kevin adipisicing cupidatat qui buffalo ham aliqua pork belly
exercitation eiusmod. Exercitation incididunt rump laborum, t-bone short ribs buffalo ut shankle pork chop
bresaola shoulder burgdoggen fugiat. Adipisicing nostrud chicken consequat beef ribs, quis filet mignon do.
Prosciutto capicola mollit shankle aliquip do dolore hamburger brisket turducken eu.

Do mollit deserunt **prosciutto** laborum. Duis sint tongue quis nisi. Capicola qui beef ribs dolore pariatur.
Minim strip steak fugiat nisi est, meatloaf pig aute. Swine rump turducken nulla sausage. Reprehenderit pork
belly tongue alcatra, shoulder excepteur in beef bresaola duis ham bacon eiusmod. Doner drumstick short loin,
adipisicing cow cillum tenderloin.
EOF;

        $item = $cache->getItem('markdown_' . md5($articleContent));
        if ( !$item->isHit() ) {
            $item->set($markdown->transform($articleContent));
            $cache->save($item);
        }

        $articleContent = $item->get();

        $html = $twig->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'articleContent' => $articleContent,
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
