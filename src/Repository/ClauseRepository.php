<?php

namespace App\Repository;

use App\Entity\Clause;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Clause|null find($id, $lockMode = null, $lockVersion = null)
 * @method Clause|null findOneBy(array $criteria, array $orderBy = null)
 * @method Clause[]    findAll()
 * @method Clause[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClauseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clause::class);
    }

    // /**
    //  * @return Clauses[] Returns an array of Clauses objects
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
    public function findOneBySomeField($value): ?Clauses
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
