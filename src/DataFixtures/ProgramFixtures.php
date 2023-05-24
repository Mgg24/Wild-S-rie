<?php

    namespace App\DataFixtures;

    use App\Entity\Program;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Persistence\ObjectManager;

    class ProgramFixtures extends Fixture implements DependentFixtureInterface
    {
        public function load(ObjectManager $manager)
        {
            $program = new Program();
            $program->setTitle('Walking dead');
            $program->setSynopsis('Des zombies envahissent la terre');
            $program->setCategory($this->getReference('category_Action'));
            $manager->persist($program);
            $manager->flush();

            $program = new Program();
            $program->setTitle('Les Anneaux de pouvoir');
            $program->setSynopsis('Prequel du Seigneur des anneaux');
            $program->setCategory($this->getReference('category_Aventure'));
            $manager->persist($program);
            $manager->flush();

            $program = new Program();
            $program->setTitle('Naruto');
            $program->setSynopsis('Un jeune Ninja orphelin ve devenir Hokage');
            $program->setCategory($this->getReference('category_Animation'));
            $manager->persist($program);
            $manager->flush();

            $program = new Program();
            $program->setTitle('His dark materials');
            $program->setSynopsis('Prequel de la boussole dor');
            $program->setCategory($this->getReference('category_Fantastique'));
            $manager->persist($program);
            $manager->flush();

            $program = new Program();
            $program->setTitle('Scream');
            $program->setSynopsis('Série d/horreur');
            $program->setCategory($this->getReference('category_Horreur'));
            $manager->persist($program);
            $manager->flush();
        }

        public function getDependencies()
        {
            // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
            return [
                CategoryFixtures::class,
            ];
        }


    }