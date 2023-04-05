<?php

namespace App\DataFixtures;

use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShopFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $shops = [
            [
                'name'        => 'Amazon',
                'description' => 'We ship to over 100 international destinations, right to your doorstep. Get deals on Amazon on Amazon.com.',
            ],
            [
                'name'        => 'Alibaba',
                'description' => 'Wholesale Marketplace. Contact Now & Get Live Quotes! Trade Assurance. Most Popular. Production Monitoring. Logistics Service.',
            ],
        ];

        foreach ($shops as $shopDetail) {
            $shop = new Shop();
            $shop->setName($shopDetail['name']);
            $shop->setDescription($shopDetail['description']);
            $manager->persist($shop);

            $this->addReference($shopDetail['name'], $shop);
        }

        $manager->flush();
    }
}
