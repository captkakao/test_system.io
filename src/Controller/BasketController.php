<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\Good;
use App\Repository\BasketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly BasketRepository $basketRepository)
    {
    }

    #[Route('/basket/add/{goodId}', name: 'basket_add_good')]
    public function addGood(Request $request, int $goodId): Response
    {
        $goodRepository = $this->entityManager->getRepository(Good::class);
        $good = $goodRepository->find($goodId);
        $basket = new Basket($this->getUser(), $good);

        $this->basketRepository->save($basket, true);

        $this->addFlash('success', $good->getName() . ' added to basket!');
        $route = $request->headers->get('referer');

        return $this->redirect($route);
    }

    #[Route('/basket/proceed-checkout', name: 'basket_proceed_checkout')]
    public function proceedCheckout(): Response
    {
        $basketRepository = $this->entityManager->getRepository(Basket::class);
        $products = $basketRepository->findProductsByUserId($this->getUser()->getId());

        $totalSum = 0;
        foreach ($products as $product) {
            $totalSum += $product['price'];
        }

        $viewData = [
            'products' => $products,
            'totalSum' => $totalSum,
        ];

        return $this->render('basket/proceed_checkout.html.twig', $viewData);
    }
}
