<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * Get random blame end verdict.
     *
     * @return String[] Returns an array with random blame and verdict.
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getRandomBlame()
    {
        return $this->createQueryBuilder('p')
            ->select('p.id', 'p.blame', 'p.verdict')
            ->andWhere('p.blame IS NOT NULL')
            ->andWhere('LENGTH(p.blame) BETWEEN 128 and 512')
            ->andWhere('p.verdict IS NOT NULL')
            ->andWhere('p.verdict != \'\'')
            ->orderBy('RAND()')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * Get query builder.
     *
     * @param array $filter
     * @return QueryBuilder
     */
    public function getQueryBuilderForList(array $filter = []): QueryBuilder
    {
        $filterTypes = [
            'surname' => [
                'type' => 'like',
            ],
            'name' => [
                'type' => 'like',
            ],
            'patronymic' => [
                'type' => 'like',
            ],
            'birth_date' => [
                'type' => 'like',
            ],
            'place_of_birth' => [
                'type' => 'like',
            ],
            'dwelling_place' => [
                'type' => 'like',
            ],
            'education' => [
                'type' => 'relation',
                'condition' => Join::ON,
                'field' => 'id',
            ],
            'education_additional' => [
                'type' => 'relation',
                'condition' => Join::ON,
                'field' => 'id',
            ],
            'nationality' => [
                'type' => 'relation',
                'condition' => Join::ON,
                'field' => 'id',
            ],
            'social_status' => [
                'type' => 'relation',
                'condition' => Join::ON,
                'field' => 'id',
            ],
            'marital_status' => [
                'type' => 'relation',
                'condition' => Join::ON,
                'field' => 'id',
            ],
            'partying' => [
                'type' => 'like',
            ],
            'working_position' => [
                'type' => 'like',
            ],
            'conviction' => [
                'type' => 'like',
            ],
            'rank_in_past' => [
                'type' => 'like',
            ],
            'list' => [
                'type' => 'relation',
                'condition' => Join::ON,
                'field' => 'id',
            ],
            'blame' => [
                'type' => 'like',
            ],
            'clauses' => [
                'type' => 'relation',
                'condition' => Join::ON,
                'field' => 'id',
            ],
            'date_of_arrest' => [
                'type' => 'date',
            ],
            'investigator' => [
                'type' => 'like',
            ],
            'session_date' => [
                'type' => 'date',
            ],
            'presenter' => [
                'type' => 'relation',
                'condition' => Join::ON,
                'field' => 'id',
            ],
            'verdict' => [
                'type' => 'like',
            ],
            'verdict_date' => [
                'type' => 'date',
            ],
            'convict' => [
                'type' => 'relation',
                'condition' => Join::ON,
                'field' => 'id',
            ],
            'rehabilitation' => [
                'type' => 'like',
            ],
            'notes' => [
                'type' => 'like',
            ],
            'session_participants' => [
                'type' => 'multiple_relation',
                'condition' => Join::ON,
                'field' => 'id',
            ],
        ];

        $qb = $this->createQueryBuilder('p');

        foreach ($filter as $field => $value) {
            if (array_key_exists($field, $filterTypes) && !empty($value)) {
                $type = $filterTypes[$field];

                if ('like' === $type['type']) {
                    $qb->andWhere('p.'.Inflector::camelize($field).' like :'.$field);
                    $qb->setParameter($field, '%'.$value.'%');
                } elseif ('relation' === $type['type'] || 'multiple_relation' === $type['type']) {
                    $qb->join('p.'.Inflector::camelize($field), $field, $type['condition']);

                    if ('relation' === $type['type']) {
                        $qb->andWhere($field.'.'.$type['field'].' = :'.$field);
                    } elseif ('multiple_relation' === $type['type']) {
                        $qb->andWhere($field.'.'.$type['field'].' in (:'.$field.')');
                    }

                    $qb->setParameter($field, $value);
                } elseif ('date' === $type['type']) {
                    $qb->andWhere('p.'.Inflector::camelize($field).' = STR_TO_DATE(:'.$field.', \'%d/%m/%Y\')');
                    $qb->setParameter($field, $value);
                }
            }
        }

        return $qb;
    }

    // /**
    //  * @return Person[] Returns an array of Person objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Person
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
