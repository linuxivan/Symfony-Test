<?php

namespace App\Controller;

use App\Entity\Cursos;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CursosController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine) {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/ws/cursos", name="cursos", methods={"GET"})
     */
    public function getCursos(): JsonResponse
    {
        $cursos = $this->doctrine->getRepository(Cursos::class)->findAll();

        return $this->json($cursos);
    }
}
