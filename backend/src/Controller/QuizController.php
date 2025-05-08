<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    #[Route('/api/quiz-question', name: 'api_quiz_question', methods: ['GET'])]
    public function generateQuiz(AnimalRepository $animalRepository): JsonResponse
    {   
        // Génération aléatoire des éléments de questions
        $animals = $animalRepository->findAll();
        $randomAnimal = $animals[array_rand($animals)];
        
        $attributes = ['nomSavant', 'classe', 'famille', 'genre', 'statusConservation']; // Attributs susceptibles d'êtres choisis par la question
        $randomAttribute = $attributes[array_rand($attributes)];

        $correctValue = $randomAnimal->{'get' . ucfirst($randomAttribute)}();

        // Obtention des réponses fausses
        $choices = [$correctValue];
        foreach ($animals as $animal) {
            $value = $animal->{'get' . ucfirst($randomAttribute)}(); // Créer l'appel du getter adapté (ucfirst -> upper case first car pour un attribut att,le getter est getAtt)
            if ($value !== $correctValue && !in_array($value, $choices, true)) {
                $choices[] = $value;
            }
            if (count($choices) >= 4) break;
        }

        // Fix: Shuffle la liste des choix pour éviter qu'on ai toujours la bonne réponse en position 1
        shuffle($choices);

        return $this->json([
            'question' => "Quel est le/la {$randomAttribute} de l'animal: {$randomAnimal->getNomCommun()} ?",
            'choices' => $choices,
            'correct' => $correctValue
        ]);
    }
}
