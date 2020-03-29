<?php

namespace App\Repository;

use App\Entity\CourtRepresentative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CourtRepresentative|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourtRepresentative|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourtRepresentative[]    findAll()
 * @method CourtRepresentative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourtRepresentativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourtRepresentative::class);
    }

    // /**
    //  * @return CourtRepresentative[] Returns an array of CourtRepresentative objects
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
    public function findOneBySomeField($value): ?CourtRepresentative
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
