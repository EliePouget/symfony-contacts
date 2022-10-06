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
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }

    #[Route('/hello/{name}/{time}', name: 'app_hello_manytimes', requirements: ['time' => '\d+'])]
    public function manyTimes(string $name, int $time = 3)
    {
        if (!($time > 0 && $time <= 10)) {
            $res = $this->redirectToRoute('app_hello_manytimes', ['name' => $name, 'time' => 3]);
        } else {
            $res = $this->render('hello/many_times.html.twig', ['name' => $name, 'time' => $time]);
        }

        return $res;
    }

    #[Route('/hello/{name}', name: 'app_hello_world')]
    public function world(string $name): Response
    {
        return $this->render('hello/world.html.twig', ['name' => $name]);
    }
}