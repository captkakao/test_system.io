<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        AppCustomAuthenticator $authenticator,
        EntityManagerInterface $entityManager
    ): Response {
        $user = new User();

        $countries = $entityManager->getRepository(Country::class)->findAll();
        $countryChoices = [];
        foreach ($countries as $country) {
            $countryChoices[$country->getName()] = $country->getId();
        }

        $formOptions = [
            'countryChoices' => $countryChoices,
        ];

        $form = $this->createForm(RegistrationFormType::class, $formOptions);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEmail($form->get('email')->getData());
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $countryRepository = $entityManager->getRepository(Country::class);
            $country = $countryRepository->find($form->get('countryId')->getData());
            $user->setCountry($country);
            $taxNumber = $country->getCode() . $this->generateUniqueTaxNumber();
            $user->setTaxNumber($taxNumber);
            $entityManager->persist($user);
            $entityManager->flush();

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    private function generateUniqueTaxNumber(): string
    {
        return mt_rand(1000, 9999) . time();
    }
}
