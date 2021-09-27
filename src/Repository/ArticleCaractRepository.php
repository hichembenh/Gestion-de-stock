<?php

namespace App\Repository;

use App\Entity\ArticleCaract;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleCaract|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleCaract|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleCaract[]    findAll()
 * @method ArticleCaract[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleCaractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleCaract::class);
    }

    // /**
    //  * @return ArticleCaract[] Returns an array of ArticleCaract objects
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
    public function findOneBySomeField($value): ?ArticleCaract
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
