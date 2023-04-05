<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $countries = [
            [
                'name' => 'Germany',
                'code' => 'DE',
            ],
            [
                'name' => 'Italy',
                'code' => 'IT',
            ],
            [
                'name' => 'Greece',
                'code' => 'GR',
            ],
        ];

        foreach ($countries as $countryDetail) {
            $country = new Country();
            $country->setName($countryDetail['name']);
            $country->setCode($countryDetail['code']);
            $manager->persist($country);

            $this->addReference($countryDetail['code'], $country);
        }

        $manager->flush();
    }
}
