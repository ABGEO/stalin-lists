<?php

/*
 * This file is part of the ABGEO/StalinList project.
 *
 * (c) Temuri Takalandze <me@abgeo.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repository;

use App\Entity\ConvictOrganization;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ConvictOrganizationRepository.
 *
 * @category Repository
 * @package  App
 *
 * @method ConvictOrganization|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConvictOrganization|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConvictOrganization[]    findAll()
 * @method ConvictOrganization[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConvictOrganizationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConvictOrganization::class);
    }

    // /**
    //  * @return ConvictOrganization[] Returns an array of ConvictOrganization objects
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
    public function findOneBySomeField($value): ?ConvictOrganization
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
