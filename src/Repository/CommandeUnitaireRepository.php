<?php

namespace App\Repository;

use App\Entity\CommandeUnitaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry ;

/**
 * @method CommandeUnitaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeUnitaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeUnitaire[]    findAll()
 * @method CommandeUnitaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeUnitaireRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * CommandeUnitaireRepository constructor.
     * @param ManagerRegistry $registry
     * @param EntityManagerInterface $manager
     */
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, CommandeUnitaire::class);
        $this->manager = $manager;
    }

    public function updateCustomer(CommandeUnitaire $commande): CommandeUnitaire
    {
        $this->manager->persist($commande);
        $this->manager->flush();

        return $commande;
    }
    /**
     * @return CommandeUnitaire[]
     */
    public function findAllNewCommande()
    {
        return $this->createQueryBuilder('c')
            ->where('c.etat = 0')
            ->getQuery()
            ->getResult();
    }
    /**
     * @return CommandeUnitaire[]
     */
    public function findAllConfirmedCommande()
    {
        return $this->createQueryBuilder('c')
            ->where('c.etat = 1')
            ->getQuery()
            ->getResult();
    }
    /**
     * @return CommandeUnitaire[]
     */
    public function findAllSentCommande()
    {
        return $this->createQueryBuilder('c')
            ->where('c.etat = 2')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return CommandeUnitaire[] Returns an array of CommandeUnitaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommandeUnitaire
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
