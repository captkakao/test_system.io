<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $users = [
            [
                'email'        => 'test@gmail.com',
                'password'     => 'qweqwe123',
                'tax_number'   => 'DE80661680693894',
                'country_code' => 'DE',
            ],
            [
                'email'        => 'test2@gmail.com',
                'password'     => 'qweqwe123',
                'tax_number'   => 'GR32161680694567',
                'country_code' => 'GR',
            ],
        ];

        foreach ($users as $userDetail) {
            $user = new User();
            $user->setEmail($userDetail['email']);

            $password = $this->hasher->hashPassword($user, $userDetail['password']);
            $user->setPassword($password);
            $user->setTaxNumber($userDetail['tax_number']);
            $user->setCountry($this->getReference($userDetail['country_code']));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
