<?php

namespace App\Controller;

use App\Repository\StoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    public function __construct(private readonly StoreRepository $storeRepository)
    {
    }

    #[Route('/', name: 'home_page')]
    public function index(): Response
    {
        $stores = $this->storeRepository->findAll();

        return $this->render('store/index.html.twig', [
            'stores' => $stores,
        ]);
    }

    #[Route('/stores/{storeId}', name: 'store_detail')]
    public function storeDetail(int $storeId): Response
    {
        $store = $this->storeRepository->find($storeId);
        $products = $store->getProducts();

        dd($products);

        return $this->render('store/index.html.twig', [
            'store' => $store,
        ]);
    }
}
