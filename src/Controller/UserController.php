<?php

namespace App\Controller;

use App\Entity\Usuarios;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine) {
        $this->doctrine = $doctrine;
    }


    /**
     * @Route("/ws/users", name="getUsers", methods={"GET"})
     */
    public function getUsers(): JsonResponse
    {
        $user = $this->doctrine->getRepository(Usuarios::class)->findAll();
        return $this->json($user);
    }

    /**
     * @Route("/ws/users/login", name="checkLogin", methods={"POST"})
     */
    public function checkLogin(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent());
        $username = $data->username;
        $password = $data->password;
        
        $user = $this->doctrine->getRepository(Usuarios::class)->findOneBy(['username' => $username, 'password' => $password]);
        if ($user) {
            return $this->json([
                'status' => 'ok',
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'admin' => $user->getAdmin(),
                'fotoPerfil' => $user->getFotoperfil()
            ]);
        } else {
            return $this->json([
                'status' => 'error',
                'error' => 'Usuario o contraseña incorrectos'
            ]);
        }
    }

    /**
     * @Route("/ws/updateuser/{id}", name="users", methods={"PUT"})
     */
    public function updateUser($id, Request $request): JsonResponse
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $fotoperfil = $request->get('fotoperfil');
        $user = $this->doctrine->getRepository(Usuarios::class)->find($id);
        if ($user) {
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setFotoperfil($fotoperfil);
            $manager = $this->doctrine->getManager();
            $manager->flush();
            return $this->json("Editado");
        } else {
            return $this->json([
                'error' => 'No se encontro el usuario'
            ]);
        }
    }

    /**
     * @Route("/ws/fotoperfil", name="uploadimage", methods={"POST"})
     */
    public function uploadImage(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent());
        $foto = $data->fotoPerfil;
        $id = $data->iduser;
        $user = $this->doctrine->getRepository(Usuarios::class)->find($id);
        if ($user) {
            $user->setFotoperfil($foto);

            $manager = $this->doctrine->getManager();
            $manager->flush();
            return $this->json([
                'status' => 'ok',
                'foto' => $foto
            ]);
        } else {
            return $this->json([
                'error' => 'No se encontro el usuario'
            ]);
        }
    }
}
    