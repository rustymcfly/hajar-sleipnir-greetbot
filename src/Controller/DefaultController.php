<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    // Todo: implement hwiOauth (login with discord) for users of associated servers

    /**
     * @Route ("/")
     * @return Response
     */
    public function index()
    {

        return $this->render('Default\\index.html.twig');
    }

    /**
     * @Route ("/robots.txt")
     * @return Response
     */
    public function robots()
    {

        return new Response('User-agent: * Disallow: /',
            Response::HTTP_OK,
            ['content-type' => 'text/plain']
        );
    }

}
