<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Animal;
use App\Entity\User;
use App\Entity\Observation;

use \DateTime;


class BasedataFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        // Ajout d'utilisateurs
        $user1 = new User();
        $user1->setEmail("user1@example.com");
        $user1->setRoles(["ROLE_USER"]);
        $user1->setPassword('12345');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail("user2@example.com");
        $user2->setRoles(["ROLE_ADMIN"]);
        $user2->setPassword('678910');
        $manager->persist($user2);

        $manager->flush();

        // // Template
        // $animal = new Animal();
        // $animal->setNomCommun("");
        // $animal->setNomSavant("");
        // $animal->setEmbranchement("");
        // $animal->setClasse("");
        // $animal->setOrdre("");
        // $animal->setSousOrdre("");
        // $animal->setFamille("");
        // $animal->setGenre("");
        // $animal->setStatusConservation("");
        // $animal->setDescription("");
        // $manager->persist($animal);

        $liste = [];

        // Animal1
        $animal1 = new Animal();
        $animal1->setNomCommun("Fouine");
        $animal1->setNomSavant("Martes foina");
        $animal1->setEmbranchement("Chordata");
        $animal1->setClasse("Mammalia");
        $animal1->setOrdre("Carnivora");
        $animal1->setSousOrdre("Caniformia");
        $animal1->setFamille("Mustelidae");
        $animal1->setGenre("Martes");
        $animal1->setStatusConservation("LC");
        $animal1->setDescription("La Fouine (Martes foina) est une espèce de mammifère carnivore d'Europe et d'Asie, au pelage gris-brun, courte sur pattes et de mœurs nocturnes.");
        $manager->persist($animal1);
        $liste[] = $animal1;

        // Template
        $animal2 = new Animal();
        $animal2->setNomCommun("Canard pilet");
        $animal2->setNomSavant("Anas acuta");
        $animal2->setEmbranchement("Chordata");
        $animal2->setClasse("Aves");
        $animal2->setOrdre("Anseriformes");
        $animal2->setSousOrdre("Anseriformes");
        $animal2->setFamille("Anatidae");
        $animal2->setGenre("Anas");
        $animal2->setStatusConservation("LC");
        $animal2->setDescription("Le Canard pilet (Anas acuta) est une espèce de canards barboteurs relativement commune et répandue dans les zones nordiques de l'Europe, de l'Asie et d'une grande partie du Canada, de l'Alaska et de la moitié ouest des États-Unis.");
        $manager->persist($animal2);
        $liste[] = $animal2;

        // Animal3
        $animal3 = new Animal();
        $animal3->setNomCommun("Dodo");
        $animal3->setNomSavant("Raphus cucullatus");
        $animal3->setEmbranchement("Chordata");
        $animal3->setClasse("Aves");
        $animal3->setOrdre("Columbiformes");
        $animal3->setSousOrdre("Columbiformes");
        $animal3->setFamille("Columbidae");
        $animal3->setGenre("Raphus");
        $animal3->setStatusConservation("EX");
        $animal3->setDescription("Le Dronte de Maurice (Raphus cucullatus) est une espèce d'oiseaux de l'ordre des Columbiformes, endémique de l'île Maurice, disparue depuis la fin du XVIIe siècle.");
        $manager->persist($animal3);
        $liste[] = $animal3;

        // Animal4
        $animal4 = new Animal();
        $animal4->setNomCommun("Taupe des montagnes du Japon");
        $animal4->setNomSavant("Urotrichus talpoides");
        $animal4->setEmbranchement("Chordata");
        $animal4->setClasse("Mammalia");
        $animal4->setOrdre("Soricomorpha");
        $animal4->setSousOrdre("Soricomorpha");
        $animal4->setFamille("Talpidae");
        $animal4->setGenre("Urotrichus");
        $animal4->setStatusConservation("LC");
        $animal4->setDescription("La Taupe des montagnes du Japon (Urotrichus talpoides) est une espèce de mammifères insectivores de la famille des Talpidae. Cette taupe japonaise est la seule espèce actuelle du genre Urotrichus. ");
        $manager->persist($animal4);
        $liste[] = $animal4;

        // Animal5
        $animal5 = new Animal();
        $animal5->setNomCommun("Fennec");
        $animal5->setNomSavant("Vulpes zerda");
        $animal5->setEmbranchement("Chordata");
        $animal5->setClasse("Mammalia");
        $animal5->setOrdre("Carnivora");
        $animal5->setSousOrdre("Caniformia");
        $animal5->setFamille("Canidae");
        $animal5->setGenre("Vulpes");
        $animal5->setStatusConservation("LC");
        $animal5->setDescription("Le fennec (Vulpes zerda)[1], nommé aussi renard des sables ou renard des sables du Sahara[2] est un petit renard (donc du genre Vulpes et de la famille des Canidés) qui vit dans le désert du Sahara et la péninsule du Sinaï[3].");
        $manager->persist($animal5);
        $liste[] = $animal5;

        // Animal6
        $animal6 = new Animal();
        $animal6->setNomCommun("Éléphant de forêt d'Afrique");
        $animal6->setNomSavant("Loxodonta cyclotis");
        $animal6->setEmbranchement("Chordata");
        $animal6->setClasse("Mammalia");
        $animal6->setOrdre("Proboscidea");
        $animal6->setSousOrdre("Proboscidea");
        $animal6->setFamille("Elephantidae");
        $animal6->setGenre("Loxodonta");
        $animal6->setStatusConservation("CR");
        $animal6->setDescription("L'éléphant de forêt d'Afrique (Loxodonta cyclotis) est un mammifère mégaherbivore de la famille des Éléphantidés, plus petit que les autres éléphants d'Afrique et typiquement forestier (bien qu'épisodiquement aussi présent en zone de transition vers la savane[1])");
        $manager->persist($animal6);
        $liste[] = $animal6;

        // Animal7
        $animal7 = new Animal();
        $animal7->setNomCommun("Girafe");
        $animal7->setNomSavant("Giraffa camelopardalis");
        $animal7->setEmbranchement("Chordata");
        $animal7->setClasse("Mammalia");
        $animal7->setOrdre("Artiodactyla");
        $animal7->setSousOrdre("Artiodactyla");
        $animal7->setFamille("Giraffidae");
        $animal7->setGenre("Giraffa");
        $animal7->setStatusConservation("VU");
        $animal7->setDescription("La Girafe (Giraffa camelopardalis) est une espèce de mammifères ongulés artiodactyles, du groupe des ruminants, vivant dans les savanes africaines et répandue du Tchad jusqu'en Afrique du Sud.");
        $manager->persist($animal7);
        $liste[] = $animal7;

        // Animal8
        $animal8 = new Animal();
        $animal8->setNomCommun("Diable de Tasmanie");
        $animal8->setNomSavant("Sarcophilus harrisii");
        $animal8->setEmbranchement("Chordata");
        $animal8->setClasse("Mammalia");
        $animal8->setOrdre("Dasyuromorphia");
        $animal8->setSousOrdre("Dasyuromorphia");
        $animal8->setFamille("Dasyuridae");
        $animal8->setGenre("Sarcophilus");
        $animal8->setStatusConservation("EN");
        $animal8->setDescription("Le diable de Tasmanie[1] (palawa kani : purinina, nom scientifique : Sarcophilus harrisii) est une espèce de marsupiaux carnivores ne vivant qu'en Tasmanie, au sud de l'Australie.");
        $manager->persist($animal8);
        $liste[] = $animal8;

        // Animal9
        $animal9 = new Animal();
        $animal9->setNomCommun("Hérisson d'Algérie");
        $animal9->setNomSavant("Atelerix algirus");
        $animal9->setEmbranchement("Chordata");
        $animal9->setClasse("Mammalia");
        $animal9->setOrdre("Erinaceomorpha");
        $animal9->setSousOrdre("Erinaceomorpha");
        $animal9->setFamille("Erinaceidae");
        $animal9->setGenre("Atelerix");
        $animal9->setStatusConservation("LC");
        $animal9->setDescription("Le Hérisson d'Algérie (Atelerix algirus), est une espèce de mammifères appartenant à la famille des Erinaceidés. Ce hérisson à ventre blanc est originaire des régions côtières d'Afrique du nord. ");
        $manager->persist($animal9);
        $liste[] = $animal9;

        // Animal10
        $animal10 = new Animal();
        $animal10->setNomCommun("Cobra royal");
        $animal10->setNomSavant("Ophiophagus hannah");
        $animal10->setEmbranchement("Chordata");
        $animal10->setClasse("Reptilia");
        $animal10->setOrdre("Squamata");
        $animal10->setSousOrdre("Squamata");
        $animal10->setFamille("Elapidae");
        $animal10->setGenre("Ophiophagus");
        $animal10->setStatusConservation("VU");
        $animal10->setDescription("Ophiophagus hannah, le Cobra royal[1], unique représentant du genre Ophiophagus, est une espèce de serpents de la famille des Elapidae[2]. ");
        $manager->persist($animal10);
        $liste[] = $animal10;

        $manager->flush();

        function randomDT(): DateTime {
            $startTimestamp = 0;
            $endTimestamp = strtotime('2020-01-01 00:00:00');
        
            $randomTimestamp = random_int($startTimestamp, $endTimestamp);
        
            return (new DateTime())->setTimestamp($randomTimestamp);
        }

        $nb_max = 50;
        $nb_actuel = 0;
        while ($nb_actuel < $nb_max) {
            foreach ($liste as $animal){
                if (rand(1,10)%2==0){    
                    $observation = new Observation();

                    $observation->setDate(randomDT());
                    $observation->setLatitude(round(rand(-9000, 9000) / 100, 6));
                    $observation->setLongitude(round(rand(-18000, 18000) / 100, 6));
                    $observation->setDescription("Observation $nb_actuel pour l'animal " . $animal->getNomCommun());
                    $observation->setIdAnimal($animal);

                    $manager->persist($observation);
                    $nb_actuel++;
                }

                if ($nb_actuel >= $nb_max) {
                    break;
                }
            }
        }

        $manager->flush();
    }
}
