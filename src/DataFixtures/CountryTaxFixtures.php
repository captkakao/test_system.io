<?php

namespace App\DataFixtures;

use App\Entity\CoutryTax;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CountryTaxFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $countryTaxes = [
            [
                'code'           => 'DE',
                'tax_percentage' => 19,
            ],
            [
                'code'           => 'IT',
                'tax_percentage' => 22,
            ],
            [
                'code'           => 'GR',
                'tax_percentage' => 24,
            ],
        ];

        foreach ($countryTaxes as $countryTaxDetail) {
            $countryTax = new CoutryTax();
            $countryTax->setCountry($this->getReference($countryTaxDetail['code']));
            $countryTax->setTaxPercentage($countryTaxDetail['tax_percentage']);
            $manager->persist($countryTax);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CountryFixtures::class,
        ];
    }
}
