<?php

namespace App\Repository;

use App\Entity\SocialStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SocialStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocialStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocialStatus[]    findAll()
 * @method SocialStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SocialStatus::class);
    }

    // /**
    //  * @return SocialStatus[] Returns an array of SocialStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SocialStatus
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
