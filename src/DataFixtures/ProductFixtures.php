<?php

namespace App\DataFixtures;

use App\Entity\Good;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $goods = [
            [
                'name'  => 'Apple iPhone 14',
                'price' => '1400',
                'shop_name' => 'Amazon',
            ],
            [
                'name'  => 'Case for Apple iPhone 14',
                'price' => '100',
                'shop_name' => 'Amazon',
            ],
            [
                'name'  => 'Apple MacBook Pro 14',
                'price' => '3000',
                'shop_name' => 'Amazon',
            ],
            [
                'name'  => 'Keychron K3',
                'price' => '700',
                'shop_name' => 'Alibaba',
            ],
            [
                'name'  => 'HyperX Alloy Origins Core',
                'price' => '800',
                'shop_name' => 'Alibaba',
            ],

        ];

        foreach ($goods as $goodDetail) {
            $good = new Good();
            $good->setShop($this->getReference($goodDetail['shop_name']));
            $good->setName($goodDetail['name']);
            $good->setPrice($goodDetail['price']);

            $manager->persist($good);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ShopFixtures::class,
        ];
    }
}
