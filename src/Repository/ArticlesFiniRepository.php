<?php

namespace App\Repository;

use App\Entity\ArticlesFini;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticlesFini|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlesFini|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlesFini[]    findAll()
 * @method ArticlesFini[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesFiniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticlesFini::class);
    }

    // /**
    //  * @return ArticlesFini[] Returns an array of ArticlesFini objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticlesFini
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
