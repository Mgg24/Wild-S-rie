<?php

    namespace App\DataFixtures;

    use App\Entity\Episode;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Persistence\ObjectManager;
    use Faker\Factory;

    class EpisodeFixtures extends Fixture implements DependentFixtureInterface
    {
        public function load(ObjectManager $manager): void
        /*{
            $episode = new Episode();
            $episode->setTitle('1299');
            $episode->setNumber(1);
            $episode->setSeason($this->getReference('season1_Arcane'));
            $episode->setSynopsis('c/est l/episode 1');
            $manager->persist($episode);
            $manager->flush();

            $episode = new Episode();
            $episode->setTitle('1299');
            $episode->setNumber(2);
            $episode->setSeason($this->getReference('season1_Arcane'));
            $episode->setSynopsis('c/est l/episode 2');
            $manager->persist($episode);
            $manager->flush();

            $episode = new Episode();
            $episode->setTitle('1299');
            $episode->setNumber(3);
            $episode->setSeason($this->getReference('season1_Arcane'));
            $episode->setSynopsis('c/est l/episode 3');
            $manager->persist($episode);
            $manager->flush();


        }*/
        {
            /*$faker=Factory::create();
            for($i = 0; $i < 10; $i++){
                $episode = new Episode();
                $episode->setNumber($i+1);
                $episode->setTitle($faker->title());
                $episode->setSeason($this->getReference('season_'.$i));
                $episode->setSynopsis($faker->paragraph(3, true));
                $manager->persist($episode);
            }
            $manager->flush();
        }*/
            $faker = Factory::create();


            for ($i = 0; $i < 11; $i++) {
                $episode = new Episode();
                $seasonReference= $this->getReference('season_' . $faker->numberBetween(0,5));
                $episode->setSeason($seasonReference);
                $episode->setTitle($faker->sentence);
                $episode->setNumber($i + 1);
                $episode->setSynopsis($faker->paragraph);
                $manager->persist($episode);
            }



            $manager->flush();
        }



        public function getDependencies(): array
        {
            // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
            return [
                SeasonFixtures::class,
            ];
        }
    }