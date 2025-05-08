<?php
namespace App\Controller;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;



#[AsController]
class RegistrationController extends AbstractController
{

    public function __invoke(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, JWTTokenManagerInterface $jwtManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['email']) || !isset($data['password']) || !isset($data['roles'])) {
            return new JsonResponse(['error' => 'Email, password, and roles are required'], 400);
        }

        // Create and configure the new user entity
        $user = new User();
        $user->setEmail($data['email']);
        
        // Hash the password
        $hashedPassword = $passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        $user->setRoles($data['roles']);

        // Persist the user entity in the database
        $entityManager->persist($user);
        $entityManager->flush();

        // Générer un JWT pour l'utilisateur
        $token = $jwtManager->create($user);

        return new JsonResponse([
            'message' => 'User created successfully',
            'token' => $token, // Retourne le JWT
            'userid' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles()
        ], 201);

    }
}