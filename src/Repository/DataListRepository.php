<?php

namespace App\Repository;

use App\Entity\DataList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DataList|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataList|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataList[]    findAll()
 * @method DataList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataList::class);
    }

    // /**
    //  * @return DataList[] Returns an array of DataList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DataList
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
