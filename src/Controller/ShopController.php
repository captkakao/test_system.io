<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Repository\ShopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ShopRepository $shopRepository
    ) {
    }

    #[Route('/', name: 'home_page')]
    public function index(): Response
    {
        $shops = $this->shopRepository->findAll();

        return $this->render('shop/index.html.twig', [
            'shops' => $shops,
        ]);
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/shops/{shopId}', name: 'shop_detail')]
    public function shopDetail(int $shopId): Response
    {
        $shopWithGoods = $this->shopRepository->findOneByIdJoinedToGood($shopId);

        $viewData['shopWithGoods'] = $shopWithGoods;

        if ($currentUser = $this->getUser()) {
            $basketRepository = $this->entityManager->getRepository(Basket::class);
            $basketItemCount  = $basketRepository->getCount($currentUser->getId());
            if ($basketItemCount) {
                $viewData['basketItemCount'] = $basketItemCount;
            }
        }

        return $this->render('shop/detail.html.twig', $viewData);
    }
}
