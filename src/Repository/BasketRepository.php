<?php

namespace App\Repository;

use App\Entity\Basket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Basket>
 *
 * @method Basket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Basket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Basket[]    findAll()
 * @method Basket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Basket::class);
    }

    public function save(Basket $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Basket $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getCount(int $buserId)
    {
        $query = $this->getEntityManager()->createQuery("SELECT SUM(b.count) FROM App\Entity\Basket b WHERE b.buser = ?1");
        $query->setParameter(1, $buserId);

        return $query->getSingleScalarResult();
    }

    public function findProductsByUserId(int $buserId)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('g.id, g.name, g.price, b.count')
            ->from('App\Entity\Basket', 'b')
            ->leftJoin('b.good', 'g')
            ->where('b.buser = :userId')
            ->setParameters([':userId' => $buserId])
            ->getQuery()
            ->getResult();
    }
}
