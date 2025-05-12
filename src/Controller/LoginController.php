<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        return $this->json([
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
        ]);
    }
}
