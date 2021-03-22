<?php

namespace App\Repository;

use App\Entity\CommandeGros;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeGros|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeGros|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeGros[]    findAll()
 * @method CommandeGros[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeGrosRepository extends ServiceEntityRepository
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
        parent::__construct($registry, CommandeGros::class);
        $this->manager = $manager;
    }

    public function updateCustomer(CommandeGros $commande): CommandeGros
    {
        $this->manager->persist($commande);
        $this->manager->flush();

        return $commande;
    }
    /**
     * @return CommandeGros[]
     */
    public function findAllNewCommande()
    {
        return $this->createQueryBuilder('c')
            ->where('c.etat = 0')
            ->getQuery()
            ->getResult();
    }
    /**
     * @return CommandeGros[]
     */
    public function findAllConfirmedCommande()
    {
        return $this->createQueryBuilder('c')
            ->where('c.etat = 1')
            ->getQuery()
            ->getResult();
    }
    /**
     * @return CommandeGros[]
     */
    public function findAllSentCommande()
    {
        return $this->createQueryBuilder('c')
            ->where('c.etat = 2')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return CommandeGros[] Returns an array of CommandeGros objects
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
    public function findOneBySomeField($value): ?CommandeGros
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
