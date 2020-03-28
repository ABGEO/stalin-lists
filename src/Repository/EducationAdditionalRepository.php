<?php

namespace App\Repository;

use App\Entity\EducationAdditional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EducationAdditional|null find($id, $lockMode = null, $lockVersion = null)
 * @method EducationAdditional|null findOneBy(array $criteria, array $orderBy = null)
 * @method EducationAdditional[]    findAll()
 * @method EducationAdditional[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EducationAdditionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EducationAdditional::class);
    }

    // /**
    //  * @return EducationAdditional[] Returns an array of EducationAdditional objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EducationAdditional
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
