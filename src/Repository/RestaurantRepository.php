<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Restaurant>
 */
class RestaurantRepository extends ServiceEntityRepository
{
    
    public function searchByQuery(string $query): array
    {
        $normalizedQuery = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', strtolower($query));

        return $this->createQueryBuilder('r')
            ->leftJoin('r.province', 'p')
            ->where('r.searchName LIKE :query')
            ->orWhere('r.searchAddress LIKE :query')
            ->orWhere('p.searchName LIKE :query')
            ->setParameter('query', '%' . $normalizedQuery . '%')
            ->getQuery()
            ->getResult();
    }
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

    //    /**
    //     * @return Restaurant[] Returns an array of Restaurant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Restaurant
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
