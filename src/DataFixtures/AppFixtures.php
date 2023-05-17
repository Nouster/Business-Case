<?php

namespace App\DataFixtures;

use App\Entity\Nft;
use App\Entity\NftPrice;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private const NB_NFT = 50;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $regularUser = new User();
        $regularUser
            ->setEmail("regularuser@test.com")
            ->setPassword('test');

        $manager->persist($regularUser);
        
        for ($i = 0; $i < self::NB_NFT; $i++) {
            $nft = new Nft();
            $nft->setTitle($faker->realText(20))
                ->setImg($faker->url())
                ->setStock($faker->numberBetween(1, 50))
                ->setLaunchDate($faker->dateTimeBetween('-2 years', 'now'));
            $manager->persist($nft);
        }

        for ($i = 0; $i < self::NB_NFT; $i++) {
            $nftPrice = new NftPrice();
            $nftPrice->setPriceDate($faker->dateTimeBetween())
                ->setPriceEthValue($faker->randomNumber(2));
        }

        $manager->flush();
    }
}
