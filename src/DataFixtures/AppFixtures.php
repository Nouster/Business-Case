<?php

namespace App\DataFixtures;

use App\Entity\Nft;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private const NB_NFT = 50;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::NB_NFT; $i++) {
            $nft = new Nft();
            $nft->setTitle($faker->realText(20))
                ->setImg($faker->url())
                ->setStock($faker->numberBetween(1, 50))
                ->setLaunchDate($faker->dateTimeBetween('2', 'now'));
            $manager->persist($nft);
        }
        $manager->flush();
    }
}
