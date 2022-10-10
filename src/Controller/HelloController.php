<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_hello')]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig');
    }

    #[Route('/hello/{name}/{times}', name: 'app_hello_manytimes', requirements: ['times' => '\d+'])]
    public function manyTimes(string $name, int $times = 3)
    {
        if (!($times > 0 && $times <= 10)) {
            $res = $this->redirectToRoute('app_hello_manytimes', ['name' => $name, 'times' => 3]);
        } else {
            $res = $this->render('hello/many_times.html.twig', ['name' => $name, 'times' => $times]);
        }

        return $res;
    }

    #[Route('/hello/{name}', name: 'app_hello_world')]
    public function world(string $name): Response
    {
        return $this->render('hello/world.html.twig', ['name' => $name]);
    }
}
