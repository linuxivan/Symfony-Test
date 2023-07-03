<?php

namespace App\Controller;

use App\Entity\Cursos;
use App\Entity\CursosUsuarios;
use App\Entity\Usuarios;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CursosUsuariosController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/ws/cursousuarios/{id}", name="cursousuarios", methods={"GET"})
     */
    public function getUsuariosCurso($id): JsonResponse
    {
        $cursosUsuarios = $this->doctrine->getRepository(CursosUsuarios::class)->findByCursoId($id);

        //recorro los alumnos y creo un json con los datos
        $json = [];
        foreach ($cursosUsuarios as $cursoUsuario) {
            $usuario = $cursoUsuario->getAlumno();
            $json[] = [
                'id' => $usuario->getId(),
                'username' => $usuario->getUsername(),
                'fotoPerfil' => $usuario->getFotoperfil(),
            ];
        }
        return $this->json([
            'alumnos' => $json,
        ]);
    }

    /**
     * @Route("/ws/cursosusuariosadd", name="addcursousuarios", methods={"PUT"})
     */
    public function addUsuariosCurso(HttpFoundationRequest $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $cursoId = $data['curso'];
        $usuarioId = $data['usuario'];
        $nota = $data['nota'];
        $curso = $this->doctrine->getRepository(Cursos::class)->find($cursoId);
        if (!$curso) {
            return $this->json([
                'error' => 'El curso no existe.'
            ]);
        }
        $usuario = $this->doctrine->getRepository(Usuarios::class)->find($usuarioId);
        if (!$usuario) {
            return $this->json([
                'error' => 'El usuario no existe.'
            ]);
        }
        $cursosUsuarios = new CursosUsuarios();
        $cursosUsuarios->setCurso($curso);
        $cursosUsuarios->setAlumno($usuario);
        $cursosUsuarios->setNota($nota);
        $em = $this->doctrine->getManager();
        $em->persist($cursosUsuarios);
        $em->flush();
        return $this->json([
            'success' => 'El usuario se ha añadido al curso correctamente.',
            'id' => $cursosUsuarios->getId(),
            'cursoId' => $cursosUsuarios->getCurso(),
            'usuarioId' => $cursosUsuarios->getAlumno(),
            'nota' => $cursosUsuarios->getNota()
        ]);
    }

    /**
     * @Route("/ws/getnotacurso/{usuario}/{curso}", name="notausuario", methods={"GET"})
     */
    public function getNotaCurso($usuario, $curso): JsonResponse
    {
        $datos = $this->doctrine->getRepository(CursosUsuarios::class)->findOneBy(['alumno' => $usuario, 'curso' => $curso]);
        if ($datos) {
            return $this->json([
                'nota' => $datos->getNota()
            ]);
        } else {
            return $this->json([
                'error' => 'No existe la nota'
            ]);
        }
    }
}
