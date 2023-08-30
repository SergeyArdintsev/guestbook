<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return new Response(
            '<html lang="en">
                        <body>
                            <h1>Hello World!</h1>
                            <img src="/images/under-construction.gif"  alt=""/>
                        </body>
                     </html>'
        );
    }
}
