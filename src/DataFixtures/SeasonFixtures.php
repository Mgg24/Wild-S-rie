<?php

    namespace App\DataFixtures;
    use App\Entity\Season;

    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Persistence\ObjectManager;
    use Faker\Factory;

    class SeasonFixtures extends Fixture implements DependentFixtureInterface
    {
        public function load(ObjectManager $manager): void
        {
            $faker = Factory::create();

            for ($i = 0; $i < 5; $i++) {
                $season = new Season();
                $season->setNumber($faker->numberBetween($i +1));
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraph(3, true));
                $season->setProgram($this->getReference('program_' . $i));

                $manager->persist($season);
                $this->addReference('season_' . $i, $season);

            }

            $manager->flush();
        }

        public function getDependencies(): array
        {
            return [
                ProgramFixtures::class,
            ];
        }
    }
